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
      isTournamentRound: false
    };

    this.getFrontOrBackNineData = this.getFrontOrBackNineData.bind(this);
    this.setIsTournamentRound = this.setIsTournamentRound.bind(this);
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

  render() {
    const { rowLabels } = this.state;
    const frontNineData = this.getFrontOrBackNineData(scorecard.frontNine);
    const backNineData = this.getFrontOrBackNineData(scorecard.backNine);

    return (
      <div className={"container-fluid half-gutter-top"}>
        <CourseSelect />
        <TournamentRoundCheckbox onHandleChange={this.setIsTournamentRound} />
        <ScorecardNine nineData={frontNineData} rowLabels={rowLabels} />
        <ScorecardNine nineData={backNineData} rowLabels={rowLabels} />

        <div className={"row"}>
          <div className={"col offset-md-2"}>
            <button className={"btn btn-lg btn-primary half-gutter-top"}>
              Save
            </button>
          </div>
        </div>
      </div>
    );
  }
}

export default RoundEntry;
