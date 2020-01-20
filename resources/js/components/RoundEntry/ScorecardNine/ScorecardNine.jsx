import React, { Component } from "react";
import PropTypes from "prop-types";
import HoleLabel from "../HoleLabel";
import ParLabel from "../ParLabel";
import YardageLabel from "../YardageLabel";
import StrokesEntry from "../StrokesEntry";
import PuttsEntry from "../PuttsEntry";
import FirCheckbox from "../FirCheckbox";
import UpAndDownSelect from "../UpAndDownSelect";
import SandSaveSelect from "../SandSaveSelect";
import PenaltyStrokesEntry from "../PenaltyStrokesEntry";
import DisplayGirCheckbox from "../DisplayGirCheckbox";
import { getScorecardDataByKey } from "../../../helpers/round-entry";
import { roundEntry } from "../../../constants/round-entry";
import RowLabels from "../RowLabels";
import { StyledEntryRow } from "./ScorecardNine.styled";
import ColumnLabel from "../ColumnLabel";

class ScorecardNine extends Component {
  constructor(props) {
    super(props);

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

  static getDerivedStateFromProps(props) {
    return {
      scorecardData: props.scorecardData
    };
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
    const { courseData, setScorecardDataOnParent } = this.props;
    scorecardData[hole][property] = value;

    // eslint-disable-next-line no-magic-numbers
    const holeId = courseData[hole - 1].id;
    scorecardData[hole].holeId = holeId;

    this.setState({ scorecardData }, setScorecardDataOnParent(scorecardData));
  }

  render() {
    const { nineData, rowLabels, isStatsRound, totals } = this.props;

    if (!nineData.length) {
      return null;
    }

    // eslint-disable-next-line no-magic-numbers
    const isFrontNine = parseInt(nineData[0].number) === 1;

    return (
      <div className={"row mt-5"}>
        <RowLabels rowLabels={rowLabels} />
        {nineData.map((hole, index) => {
          const { par, number, yardage } = hole;
          const { scorecardData } = this.state;
          // eslint-disable-next-line no-magic-numbers
          const indexOffset = nineData[0].number;
          const currentHoleData = scorecardData[index + indexOffset] || false;

          const strokes = getScorecardDataByKey(
            scorecardData,
            number,
            "strokes"
          );
          const putts = getScorecardDataByKey(scorecardData, number, "putts");

          return (
            <StyledEntryRow
              offsetRows={4}
              key={`hole-${index}`}
              className={"col-md-1"}
            >
              <HoleLabel holeNumber={number} />
              <YardageLabel yardage={yardage} />
              <ParLabel strokes={par} />
              <StrokesEntry
                hole={number}
                onHandleChange={this.setScorecardValue}
                strokes={currentHoleData.Strokes || ""}
              />
              <PuttsEntry
                hole={number}
                onHandleChange={this.setScorecardValue}
                putts={currentHoleData.Putts || ""}
              />
              {isStatsRound && (
                <>
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
                    checked={currentHoleData.FIR || ""}
                  />
                  <UpAndDownSelect
                    hole={number}
                    onHandleChange={this.setScorecardValue}
                    selectedValue={currentHoleData["Up & Down"] || ""}
                  />
                  <SandSaveSelect
                    hole={number}
                    onHandleChange={this.setScorecardValue}
                    selectedValue={currentHoleData["Sand Save"] || ""}
                  />
                  <PenaltyStrokesEntry
                    hole={number}
                    onHandleChange={this.setScorecardValue}
                    penaltyStrokes={currentHoleData["Penalty Strokes"] || ""}
                  />
                </>
              )}
            </StyledEntryRow>
          );
        })}
        <StyledEntryRow className={"col"}>
          <ColumnLabel label={" "} />
          <ColumnLabel label={" "} />
          <ColumnLabel label={" "} />
          <ColumnLabel
            label={isFrontNine ? totals.front.strokes : totals.back.strokes}
          />
          <ColumnLabel
            label={isFrontNine ? totals.front.putts : totals.back.putts}
          />
        </StyledEntryRow>
      </div>
    );
  }
}

ScorecardNine.propTypes = {
  nineData: PropTypes.array.isRequired,
  rowLabels: PropTypes.array.isRequired,
  setScorecardDataOnParent: PropTypes.func,
  isStatsRound: PropTypes.bool.isRequired,
  courseData: PropTypes.array.isRequired,
  scorecardData: PropTypes.object.isRequired,
  totals: PropTypes.object.isRequired
};

ScorecardNine.defaultProps = {
  setScorecardDataOnParent: () => {},
  courseData: []
};

export default ScorecardNine;
