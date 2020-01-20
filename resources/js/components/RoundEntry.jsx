import React, { Component } from "react";
import CourseSelect from "./RoundEntry/CourseSelect";
import TournamentRoundCheckbox from "./RoundEntry/TournamentRoundCheckbox";
import ScorecardNine from "./RoundEntry/ScorecardNine/ScorecardNine";
import { scorecard } from "../constants/round-entry";
import { getScorecardLabels } from "../helpers/round-entry";
import "react-datepicker/dist/react-datepicker.css";
import DatePlayed from "./RoundEntry/DatePlayed";
import Button from "./Button/Button";
import Header from "../Argon/components/Headers/Header";
import { Row, Col } from "reactstrap";
import ContentContainer from "../Argon/components/ContentContainer/ContentContainer";
import { buttonText } from "../constants/button-text";
import StatsRoundCheckbox from "./RoundEntry/StatsRoundCheckbox";
import HolesPlayed from "./RoundEntry/HolesPlayed";
import { roundTypes } from "./RoundEntry/constants/roundTypes";
import { mockRoundEntryData } from "../mock-data/round-entry";
import { app } from "../constants/app";
import moment from "moment";
import { handlePost } from "../helpers/fetch/handle-post";

class RoundEntry extends Component {
  constructor() {
    super();
    this.state = {
      courses: [],
      courseData: [],
      datePlayed: moment(),
      isTournamentRound: false,
      isStatsRound: true,
      courseId: "",
      scorecardData: {},
      roundType: roundTypes.all,
      isEditing: false,
      totals: {
        front: { strokes: 0, putts: 0 },
        back: { strokes: 0, putts: 0 }
      }
    };

    this.getFrontOrBackNineData = this.getFrontOrBackNineData.bind(this);
    this.setIsTournamentRound = this.setIsTournamentRound.bind(this);
    this.setIsStatsRound = this.setIsStatsRound.bind(this);
    this.setCourse = this.setCourse.bind(this);
    this.save = this.save.bind(this);
    this.setScorecardData = this.setScorecardData.bind(this);
    this.setDatePlayed = this.setDatePlayed.bind(this);
    this.setHolesPlayed = this.setHolesPlayed.bind(this);
    this.setDummyData = this.setDummyData.bind(this);
  }

  async componentDidMount() {
    try {
      const result = await fetch("/courses/get");
      const json = await result.json();

      this.setState({ courses: json.courses });
    } catch (error) {
      console.log(`fetch error: ${error}`);
    }
  }

  getFrontOrBackNineData(side) {
    const { courseData } = this.state;

    switch (side) {
      case scorecard.frontNine:
        // eslint-disable-next-line no-magic-numbers
        return courseData.slice(0, 9);
      case scorecard.backNine:
        // eslint-disable-next-line no-magic-numbers
        return courseData.slice(9, 18);
    }

    return [];
  }

  setIsTournamentRound(value) {
    this.setState({ isTournamentRound: value.target.checked });
  }

  setIsStatsRound(value) {
    this.setState({ isStatsRound: value.target.checked });
  }

  setHolesPlayed(value) {
    this.setState({ roundType: value });
  }

  async setCourse(courseId) {
    if (!courseId) {
      return this.setState({ courseData: [] });
    }

    this.setState({ courseId });

    const getCourseData = async courseId => {
      try {
        const response = await fetch(`/courses/get-course-data/${courseId}`);
        const json = await response.json();

        return json;
      } catch (error) {
        console.log(error);
      }
    };

    const courseData = await getCourseData(courseId);

    if (Object.keys(courseData).length) {
      this.setState({ courseData });
    }
  }

  getTotals(scorecardData) {
    /* eslint-disable no-magic-numbers */
    const front = {
      strokes: 0,
      putts: 0
    };
    const back = {
      strokes: 0,
      putts: 0
    };

    for (const hole in scorecardData) {
      const currentData = scorecardData[hole];

      if (parseInt(hole) <= 9) {
        front.strokes = front.strokes + (parseInt(currentData.Strokes) || 0);
        front.putts = front.putts + (parseInt(currentData.Putts) || 0);
      } else {
        back.strokes = back.strokes + (parseInt(currentData.Strokes) || 0);
        back.putts = back.putts + (parseInt(currentData.Putts) || 0);
      }
    }

    return {
      front,
      back
    };
    /* eslint-enable no-magic-numbers */
  }

  setScorecardData(scorecardData) {
    // eslint-disable-next-line react/destructuring-assignment
    const existingScorecardData = { ...this.state.scorecardData };

    const { front, back } = this.getTotals(scorecardData);

    this.setState({
      scorecardData: { ...existingScorecardData, ...scorecardData },
      totals: {
        front,
        back
      }
    });
  }

  setDatePlayed(value) {
    this.setState({ datePlayed: value });
  }

  save() {
    const {
      courseId,
      isTournamentRound,
      isStatsRound,
      scorecardData,
      datePlayed,
      roundType
    } = this.state;

    const payload = {
      datePlayed: datePlayed.toString(),
      courseId,
      isTournamentRound,
      isStatsRound,
      roundType,
      scorecardData
    };

    const request = {
      url: "/rounds/create",
      payload
    };

    try {
      handlePost(request);
    } catch (error) {
      console.log(error);
    }
  }

  setDummyData() {
    // eslint-disable-next-line no-undef
    if (process.env.MIX_ENV === app.env.develop) {
      this.setState({
        isEditing: true,
        scorecardData: { ...mockRoundEntryData.scorecardData },
        datePlayed: mockRoundEntryData.datePlayed,
        isTournamentRound: mockRoundEntryData.isTournamentRound,
        isStatsRound: mockRoundEntryData.isStatsRound,
        roundType: mockRoundEntryData.roundType
      });
    }
  }

  render() {
    const {
      courses,
      courseData,
      isStatsRound,
      isTournamentRound,
      roundType,
      isEditing,
      datePlayed,
      scorecardData,
      totals
    } = this.state;
    const frontNineData = this.getFrontOrBackNineData(scorecard.frontNine);
    const backNineData = this.getFrontOrBackNineData(scorecard.backNine);
    const hasHoleData = courseData.length || false;
    const rowLabels = getScorecardLabels(isStatsRound);

    const showFrontNine =
      roundType === roundTypes.all || roundType === roundTypes.frontNine;
    const showBackNine =
      roundType === roundTypes.all || roundType === roundTypes.backNine;

    return (
      <React.Fragment>
        <Header />
        <ContentContainer>
          <Row>
            <Col md={{ offset: 2, size: 5 }}>
              <DatePlayed
                selectedDate={moment(datePlayed)}
                handleOnChange={this.setDatePlayed}
              />
              <HolesPlayed
                handleOnChange={this.setHolesPlayed}
                roundType={roundType}
                isEditing={isEditing}
              />
              <CourseSelect courses={courses} handleOnChange={this.setCourse} />
              <StatsRoundCheckbox
                defaultChecked={isStatsRound}
                onHandleChange={this.setIsStatsRound}
              />
              <TournamentRoundCheckbox
                onHandleChange={this.setIsTournamentRound}
                isChecked={isTournamentRound}
              />
            </Col>
          </Row>
          <Row onDoubleClick={this.setDummyData}>
            <Col>
              {hasHoleData && (
                <>
                  {showFrontNine && (
                    <ScorecardNine
                      nineData={frontNineData}
                      rowLabels={rowLabels}
                      setScorecardDataOnParent={this.setScorecardData}
                      isStatsRound={isStatsRound}
                      courseData={courseData}
                      scorecardData={scorecardData}
                      totals={totals}
                    />
                  )}
                  {showBackNine && (
                    <ScorecardNine
                      nineData={backNineData}
                      rowLabels={rowLabels}
                      setScorecardDataOnParent={this.setScorecardData}
                      isStatsRound={isStatsRound}
                      courseData={courseData}
                      setDummyData={this.setDummyData}
                      scorecardData={scorecardData}
                      totals={totals}
                    />
                  )}
                  <Button
                    label={buttonText.save}
                    className={`offset-md-2`}
                    handleOnClick={this.save}
                  />
                </>
              )}
            </Col>
          </Row>
        </ContentContainer>
      </React.Fragment>
    );
  }
}

export default RoundEntry;
