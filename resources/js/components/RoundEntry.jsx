import React, { Component } from "react";
import PropTypes from "prop-types";
import CourseSelect from "./round-entry/CourseSelect";
import TournamentRoundCheckbox from "./round-entry/TournamentRoundCheckbox";
import EntryRowLabel from "./round-entry/EntryRowLabel";
import HoleLabel from "./round-entry/HoleLabel";
import ParLabel from "./round-entry/ParLabel";
import StrokesEntry from "./round-entry/StrokesEntry";
import PuttsEntry from "./round-entry/PuttsEntry";
import GirCheckbox from "./round-entry/GirCheckbox";
import FirCheckbox from "./round-entry/FirCheckbox";
import SandSaveSelect from "./round-entry/SandSaveSelect";
import UpAndDownSelect from "./round-entry/UpAndDownSelect";
import PenaltyStrokesEntry from "./round-entry/PenaltyStrokesEntry";

class RoundEntry extends Component {
  constructor() {
    super();
    this.state = {
      rowLabels: [
        "Hole",
        "Par",
        "Stokes",
        "Putts",
        "GIR",
        "FIR",
        "Up & Down",
        "Sand Save",
        "Penalty Strokes"
      ],
      frontNine: [
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
        }
      ]
    };
  }

  render() {
    const { rowLabels, frontNine } = this.state;
    return (
      <div className={"container-fluid half-gutter-top"}>
        <CourseSelect />
        <TournamentRoundCheckbox />

        <div className={"row gutter-top"}>
          <div className={"col-md-2 scorecard-entry-row"}>
            {rowLabels.map((label, index) => (
              <EntryRowLabel key={`entryRow-${index}`} label={label} />
            ))}
          </div>
          {frontNine.map((hole, index) => (
            <div
              key={`hole-${index}`}
              className={"col-md-1 scorecard-entry-row"}
            >
              <HoleLabel holeNumber={hole.number} />
              <ParLabel strokes={hole.par} />
              <StrokesEntry />
              <PuttsEntry />
              <GirCheckbox />
              <FirCheckbox />
              <UpAndDownSelect />
              <SandSaveSelect />
              <PenaltyStrokesEntry />
            </div>
          ))}
        </div>
      </div>
    );
  }
}

RoundEntry.propTypes = {};

export default RoundEntry;
