import React, { Component } from "react";
import NumberField from "./inputs/NumberField";
import { holeOnHandleChange } from "./prop-types/round-entry";
import { roundEntry } from "../../constants/round-entry";

class StrokesEntry extends Component {
  constructor() {
    super();
    this.onSetStrokes = this.onSetStrokes.bind(this);
  }

  onSetStrokes(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.strokes, value);
  }

  render() {
    return (
      <NumberField
        label={roundEntry.strokes}
        onHandleChange={this.onSetStrokes}
      />
    );
  }
}

StrokesEntry.propTypes = holeOnHandleChange;

export default StrokesEntry;
