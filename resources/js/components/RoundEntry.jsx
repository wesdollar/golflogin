import React, { Component } from "react";
import PropTypes from "prop-types";
import CourseSelect from "./round-entry/CourseSelect";
import TournamentRoundCheckbox from "./round-entry/TournamentRoundCheckbox";
import ScorecardNine from "./round-entry/ScorecardNine";
import { roundEntry, scorecard } from "../constants/round-entry";

class RoundEntry extends Component {
  constructor() {
    super();
    this.state = {
      rowLabels: [
        roundEntry.hole,
        roundEntry.par,
        roundEntry.strokes,
        roundEntry.putts,
        roundEntry.gir,
        roundEntry.fir,
        roundEntry.upAndDown,
        roundEntry.sandSave,
        roundEntry.penaltyStrokes
      ],
      courseData: [
        {
          number: "1",
          yardage: "234",
          par: "3"
        },
        {
          number: "2",
          yardage: "234",
          par: "3"
        },
        {
          number: "3",
          yardage: "234",
          par: "3"
        },
        {
          number: "4",
          yardage: "234",
          par: "3"
        },
        {
          number: "5",
          yardage: "234",
          par: "3"
        },
        {
          number: "6",
          yardage: "234",
          par: "3"
        },
        {
          number: "7",
          yardage: "234",
          par: "3"
        },
        {
          number: "8",
          yardage: "234",
          par: "3"
        },
        {
          number: "9",
          yardage: "234",
          par: "3"
        },
        {
          number: "10",
          yardage: "234",
          par: "3"
        },
        {
          number: "11",
          yardage: "234",
          par: "3"
        },
        {
          number: "12",
          yardage: "234",
          par: "3"
        },
        {
          number: "13",
          yardage: "234",
          par: "3"
        },
        {
          number: "14",
          yardage: "234",
          par: "3"
        },
        {
          number: "15",
          yardage: "234",
          par: "3"
        },
        {
          number: "16",
          yardage: "234",
          par: "3"
        },
        {
          number: "17",
          yardage: "234",
          par: "3"
        },
        {
          number: "18",
          yardage: "234",
          par: "3"
        }
      ]
    };

    this.getFrontOrBackNineData = this.getFrontOrBackNineData.bind(this);
  }

  getFrontOrBackNineData(side) {
    const { courseData } = this.state;

    switch (side) {
      case scorecard.frontNine:
        return courseData.slice(0, 9);
      case scorecard.backNine:
        return courseData.slice(9, 18);
    }

    return [];
  }

  render() {
    const { rowLabels } = this.state;
    const frontNineData = this.getFrontOrBackNineData(scorecard.frontNine);
    const backNineData = this.getFrontOrBackNineData(scorecard.backNine);

    return (
      <div className={"container-fluid half-gutter-top"}>
        <CourseSelect />
        <TournamentRoundCheckbox />
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

RoundEntry.propTypes = {};

export default RoundEntry;
