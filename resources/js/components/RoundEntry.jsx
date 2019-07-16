import React, { Component } from "react";
import CourseSelect from "./round-entry/CourseSelect";
import TournamentRoundCheckbox from "./round-entry/TournamentRoundCheckbox";
import ScorecardNine from "./round-entry/ScorecardNine";
import { scorecard } from "../constants/round-entry";
import { courseData } from "../mock-data/round-entry";
import { getScorecardLabels } from "../helpers/round-entry";
import "react-datepicker/dist/react-datepicker.css";
import DatePlayed from "./round-entry/DatePlayed";
import Button from "./elements/Button";
import CourseEntry from "./CourseEntry";

class RoundEntry extends Component {
  constructor() {
    super();
    this.state = {
      rowLabels: getScorecardLabels(),
      courseData,
      datePlayed: "",
      isTournamentRound: false,
      courseId: "",
      scorecardData: {}
    };

    this.getFrontOrBackNineData = this.getFrontOrBackNineData.bind(this);
    this.setIsTournamentRound = this.setIsTournamentRound.bind(this);
    this.setCourse = this.setCourse.bind(this);
    this.save = this.save.bind(this);
    this.setScorecardData = this.setScorecardData.bind(this);
    this.setDatePlayed = this.setDatePlayed.bind(this);
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
    this.setState({ isTournamentRound: value });
  }

  setCourse(value) {
    this.setState({ courseId: value });
  }

  setScorecardData(scorecardData) {
    this.setState({ scorecardData });
  }

  setDatePlayed(value) {
    this.setState({ datePlayed: value });
  }

  save() {
    const {
      courseId,
      isTournamentRound,
      scorecardData,
      datePlayed
    } = this.state;

    const payload = {
      datePlayed,
      courseId,
      isTournamentRound,
      ...scorecardData
    };

    console.log(payload);
  }

  render() {
    const { rowLabels } = this.state;
    const frontNineData = this.getFrontOrBackNineData(scorecard.frontNine);
    const backNineData = this.getFrontOrBackNineData(scorecard.backNine);

    return (
      <div className={"container-fluid half-gutter-top"}>
        <CourseEntry />
        <DatePlayed handleOnChange={this.setDatePlayed} />
        <CourseSelect onHandleChange={this.setCourse} />
        <TournamentRoundCheckbox onHandleChange={this.setIsTournamentRound} />
        <ScorecardNine
          nineData={frontNineData}
          rowLabels={rowLabels}
          setScorecardDataOnParent={this.setScorecardData}
        />
        <ScorecardNine
          nineData={backNineData}
          rowLabels={rowLabels}
          setScorecardDataOnParent={this.setScorecardData}
        />
        <Button className={`offset-md-2`} handleOnClick={this.save} />
      </div>
    );
  }
}

export default RoundEntry;
