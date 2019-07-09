import React, { Component } from "react";
import PropTypes from "prop-types";
import NumberField from "./inputs/NumberField";

class PuttsEntry extends Component {
  render() {
    return <NumberField label={"Number of Putts"} />;
  }
}

PuttsEntry.propTypes = {};

export default PuttsEntry;
