import React, { Component } from "react";
import PropTypes from "prop-types";
import EntryRowLabel from "./EntryRowLabel";
import HoleLabel from "./HoleLabel";
import ParLabel from "./ParLabel";
import YardageLabel from "./YardageLabel";
import StrokesEntry from "./StrokesEntry";
import PuttsEntry from "./PuttsEntry";
import FirCheckbox from "./FirCheckbox";
import UpAndDownSelect from "./UpAndDownSelect";
import SandSaveSelect from "./SandSaveSelect";
import PenaltyStrokesEntry from "./PenaltyStrokesEntry";
import DisplayGirCheckbox from "./DisplayGirCheckbox";
import { getScorecardDataByKey } from "../../helpers/round-entry";
import { roundEntry } from "../../constants/round-entry";

class ScorecardNine extends Component {
  constructor() {
    super();

    this.state = {
      scorecardData: {}
    };

    this.setScorecardValue = this.setScorecardValue.bind(this);
    this.setupScorecardDataObject = this.setupScorecardDataObject.bind(this);
    this.setScorecardValue = this.setScorecardValue.bind(this);
  }

  componentDidMount() {
    this.setupScorecardDataObject();
  }

  isStatLabel(label) {
    return !(
      label === roundEntry.hole ||
      label === roundEntry.par ||
      label === roundEntry.yardage
    );
  }

  setupScorecardDataObject() {
    const { nineData, rowLabels } = this.props;
    const { scorecardData } = this.state;

    nineData.map(hole => {
      const { number } = hole;
      scorecardData[number] = {};

      rowLabels.map(label => {
        if (this.isStatLabel(label)) {
          scorecardData[number][label] = "";
        }
      });
    });

    this.setState({ scorecardData });
  }

  setScorecardValue(hole, property, value) {
    const { scorecardData } = this.state;
    scorecardData[hole][property] = value;

    this.setState({ scorecardData });
    // eslint-disable-next-line react/destructuring-assignment
    this.props.setScorecardDataOnParent({ scorecardData });
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
        {nineData.map((hole, index) => {
          const { par, number, yardage } = hole;
          const { scorecardData } = this.state;

          const strokes = getScorecardDataByKey(
            scorecardData,
            number,
            "strokes"
          );
          const putts = getScorecardDataByKey(scorecardData, number, "putts");

          return (
            <div
              key={`hole-${index}`}
              className={"col-md-1 scorecard-entry-row"}
            >
              <HoleLabel holeNumber={number} />
              <YardageLabel yardage={yardage} />
              <ParLabel strokes={par} />
              <StrokesEntry
                hole={number}
                onHandleChange={this.setScorecardValue}
              />
              <PuttsEntry
                hole={number}
                onHandleChange={this.setScorecardValue}
              />
              <DisplayGirCheckbox
                hole={number}
                onHandleChange={this.setScorecardValue}
                strokes={strokes}
                putts={putts}
                par={par}
              />
              <FirCheckbox
                hole={number}
                par={par}
                onHandleChange={this.setScorecardValue}
              />
              <UpAndDownSelect
                hole={number}
                onHandleChange={this.setScorecardValue}
              />
              <SandSaveSelect
                hole={number}
                onHandleChange={this.setScorecardValue}
              />
              <PenaltyStrokesEntry
                hole={number}
                onHandleChange={this.setScorecardValue}
              />
            </div>
          );
        })}
      </div>
    );
  }
}

ScorecardNine.propTypes = {
  nineData: PropTypes.array.isRequired,
  rowLabels: PropTypes.array.isRequired,
  setScorecardDataOnParent: PropTypes.func
};

ScorecardNine.defaultProps = {
  setScorecardDataOnParent: () => {}
};

export default ScorecardNine;
