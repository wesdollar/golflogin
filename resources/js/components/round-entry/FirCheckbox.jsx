import React, { Component } from "react";
import PropTypes from "prop-types";
import Checkbox from "./inputs/Checkbox";

class FirCheckbox extends Component {
  render() {
    return <Checkbox label={"FIR"} hideLabel={true} />;
  }
}

FirCheckbox.propTypes = {};

export default FirCheckbox;
