import React, { Component } from "react";
import PropTypes from "prop-types";
import EntryRowLabel from "./EntryRowLabel";
import HoleLabel from "./HoleLabel";
import ParLabel from "./ParLabel";
import StrokesEntry from "./StrokesEntry";
import PuttsEntry from "./PuttsEntry";
import GirCheckbox from "./GirCheckbox";
import FirCheckbox from "./FirCheckbox";
import UpAndDownSelect from "./UpAndDownSelect";
import SandSaveSelect from "./SandSaveSelect";
import PenaltyStrokesEntry from "./PenaltyStrokesEntry";

class ScorecardNine extends Component {
  constructor() {
    super();

    this.state = {
      scorecardData: {}
    };

    this.setScorecardValue = this.setScorecardValue.bind(this);
    this.setupScorecardDataObject = this.setupScorecardDataObject.bind(this);
  }

  componentDidMount() {
    this.setupScorecardDataObject();
  }

  setupScorecardDataObject() {
    const { nineData, rowLabels } = this.props;
    let scorecardData = { ...this.state.scorecardData };

    nineData.map(hole => {
      const { number } = hole;
      scorecardData[number] = {};

      rowLabels.map(label => {
        scorecardData[number][label] = "";
      });
    });

    this.setState({ scorecardData });
  }

  setScorecardValue(hole, property, value) {
    const scorecardData = { ...this.state.scorecardData };
    scorecardData[hole][property] = value;

    this.setState({ scorecardData });
  }

  render() {
    const { nineData, rowLabels } = this.props;

    if (!nineData.length) {
      return null;
    }

    return (
      <div className={"row gutter-top"}>
        <div className={"col-md-2 scorecard-entry-row text-right"}>
          {rowLabels.map((label, index) => (
            <EntryRowLabel key={`entryRow-${index}`} label={label} />
          ))}
        </div>
        {nineData.map((hole, index) => (
          <div key={`hole-${index}`} className={"col-md-1 scorecard-entry-row"}>
            <HoleLabel holeNumber={hole.number} />
            <ParLabel strokes={hole.par} />
            <StrokesEntry
              hole={hole.number}
              onHandleChange={this.setScorecardValue}
            />
            <PuttsEntry
              hole={hole.number}
              onHandleChange={this.setScorecardValue}
            />
            <GirCheckbox
              hole={hole.number}
              onHandleChange={this.setScorecardValue}
            />
            <FirCheckbox hole={hole.number} />
            <UpAndDownSelect hole={hole.number} />
            <SandSaveSelect hole={hole.number} />
            <PenaltyStrokesEntry hole={hole.number} />
          </div>
        ))}
      </div>
    );
  }
}

ScorecardNine.propTypes = {
  nineData: PropTypes.array.isRequired,
  rowLabels: PropTypes.array.isRequired
};

export default ScorecardNine;
