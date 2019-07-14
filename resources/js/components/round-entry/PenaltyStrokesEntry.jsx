import React, { Component } from "react";
import NumberField from "./inputs/NumberField";
import { roundEntry } from "../../constants/round-entry";
import { holeOnHandleChange } from "./prop-types/round-entry";

class PenaltyStrokesEntry extends Component {
  constructor() {
    super();
    this.setPenaltyStrokes = this.setPenaltyStrokes.bind(this);
  }

  setPenaltyStrokes(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.penaltyStrokes, value);
  }

  render() {
    return (
      <NumberField
        label={"Penalty Strokes"}
        onHandleChange={this.setPenaltyStrokes}
      />
    );
  }
}

PenaltyStrokesEntry.propTypes = holeOnHandleChange;

export default PenaltyStrokesEntry;
