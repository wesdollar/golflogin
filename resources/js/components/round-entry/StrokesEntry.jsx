import React, { Component } from "react";
import PropTypes from "prop-types";
import NumberField from "./inputs/NumberField";

class StrokesEntry extends Component {
  render() {
    return <NumberField label={"Number of Strokes"} />;
  }
}

StrokesEntry.propTypes = {};

export default StrokesEntry;
