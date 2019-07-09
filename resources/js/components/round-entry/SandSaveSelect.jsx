import React, { Component } from "react";
import PropTypes from "prop-types";
import YesNoSelect from "./inputs/YesNoSelect";

class SandSaveSelect extends Component {
  render() {
    return <YesNoSelect label={"Sand Save for Par"} hideLabel={true} />;
  }
}

SandSaveSelect.propTypes = {};

export default SandSaveSelect;
