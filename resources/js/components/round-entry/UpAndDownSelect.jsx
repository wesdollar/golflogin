import React, { Component } from "react";
import PropTypes from "prop-types";
import YesNoSelect from "./inputs/YesNoSelect";

class UpAndDownSelect extends Component {
  render() {
    return <YesNoSelect label={"Up and Down Par Save"} hideLabel={true} />;
  }
}

UpAndDownSelect.propTypes = {};

export default UpAndDownSelect;
