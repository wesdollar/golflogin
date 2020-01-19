import React, { Component } from "react";
import NumberField from "../inputs/NumberField";
import { roundEntry } from "../../constants/round-entry";
import PropTypes from "prop-types";

class PenaltyStrokesEntry extends Component {
  constructor() {
    super();
    this.setPenaltyStrokes = this.setPenaltyStrokes.bind(this);
  }

  setPenaltyStrokes(event) {
    const { hole, onHandleChange } = this.props;
    const { value } = event.target;

    onHandleChange(hole, roundEntry.penaltyStrokes, value);
  }

  render() {
    const { penaltyStrokes } = this.props;

    return (
      <NumberField
        label={"Penalty Strokes"}
        handleOnChange={this.setPenaltyStrokes}
        inputValue={penaltyStrokes}
      />
    );
  }
}

PenaltyStrokesEntry.propTypes = {
  hole: PropTypes.number.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  penaltyStrokes: PropTypes.string.isRequired
};

export default PenaltyStrokesEntry;
