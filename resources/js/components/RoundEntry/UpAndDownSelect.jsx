import React, { Component } from "react";
import YesNoSelect from "./inputs/YesNoSelect";
import { roundEntry } from "../../constants/round-entry";
import PropTypes from "prop-types";

class UpAndDownSelect extends Component {
  constructor() {
    super();
    this.setUpAndDown = this.setUpAndDown.bind(this);
  }

  setUpAndDown(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.upAndDown, value);
  }

  render() {
    const { selectedValue } = this.props;

    return (
      <YesNoSelect
        label={"Up and Down Par Save"}
        hideLabel={true}
        onHandleChange={this.setUpAndDown}
        selectedValue={selectedValue}
      />
    );
  }
}

UpAndDownSelect.propTypes = {
  hole: PropTypes.number.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  selectedValue: PropTypes.string.isRequired
};

export default UpAndDownSelect;
