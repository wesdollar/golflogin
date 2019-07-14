import React, { Component } from "react";
import YesNoSelect from "./inputs/YesNoSelect";
import { holeOnHandleChange } from "./prop-types/round-entry";
import { roundEntry } from "../../constants/round-entry";

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
    return (
      <YesNoSelect
        label={"Up and Down Par Save"}
        hideLabel={true}
        onHandleChange={this.setUpAndDown}
      />
    );
  }
}

UpAndDownSelect.propTypes = holeOnHandleChange;

export default UpAndDownSelect;
