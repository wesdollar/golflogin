import React, { Component } from "react";
import CourseSelect from "./round-entry/CourseSelect";
import TournamentRoundCheckbox from "./round-entry/TournamentRoundCheckbox";
import ScorecardNine from "./round-entry/ScorecardNine";
import { scorecard } from "../constants/round-entry";
import { courseData } from "../mock-data/round-entry";
import { getScorecardLabels } from "../helpers/round-entry";

class RoundEntry extends Component {
  constructor() {
    super();
    this.state = {
      rowLabels: getScorecardLabels(),
      courseData,
      isTournamentRound: false,
      courseId: "",
      scorecardData: {}
    };

    this.getFrontOrBackNineData = this.getFrontOrBackNineData.bind(this);
    this.setIsTournamentRound = this.setIsTournamentRound.bind(this);
    this.setCourse = this.setCourse.bind(this);
    this.save = this.save.bind(this);
    this.setScorecardData = this.setScorecardData.bind(this);
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

  save() {
    const { courseId, isTournamentRound, scorecardData } = this.state;
    const payload = {
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

        <div className={"row"}>
          <div className={"col offset-md-2"}>
            <button
              className={"btn btn-lg btn-primary half-gutter-top"}
              onClick={this.save}
            >
              Save
            </button>
          </div>
        </div>
      </div>
    );
  }
}

export default RoundEntry;
