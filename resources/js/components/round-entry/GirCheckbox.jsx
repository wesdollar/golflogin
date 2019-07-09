import React, { Component } from "react";
import PropTypes from "prop-types";
import Checkbox from "./inputs/Checkbox";

class GirCheckbox extends Component {
  render() {
    return <Checkbox label={"GIR"} hideLabel={true} />;
  }
}

GirCheckbox.propTypes = {};

export default GirCheckbox;
