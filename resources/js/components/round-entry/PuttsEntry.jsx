import React, { Component } from "react";
import NumberField from "./inputs/NumberField";
import { holeOnHandleChange } from "./prop-types/hole-onHandleChange";
import { roundEntry } from "../../constants/round-entry";

class PuttsEntry extends Component {
  constructor() {
    super();
    this.onSetPutts = this.onSetPutts.bind(this);
  }

  onSetPutts(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.putts, value);
  }

  render() {
    return (
      <NumberField label={roundEntry.putts} onHandleChange={this.onSetPutts} />
    );
  }
}

PuttsEntry.propTypes = holeOnHandleChange;

export default PuttsEntry;
