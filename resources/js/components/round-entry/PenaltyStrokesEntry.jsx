import React, { Component } from "react";
import PropTypes from "prop-types";
import NumberField from "./inputs/NumberField";

class PenaltyStrokesEntry extends Component {
  render() {
    return <NumberField label={"Number of Penalty Strokes"} />;
  }
}

PenaltyStrokesEntry.propTypes = {};

export default PenaltyStrokesEntry;
