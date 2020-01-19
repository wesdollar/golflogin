import React, { Component } from "react";
import YesNoSelect from "./inputs/YesNoSelect";
import { roundEntry } from "../../constants/round-entry";
import PropTypes from "prop-types";

class SandSaveSelect extends Component {
  constructor() {
    super();
    this.setSandSave = this.setSandSave.bind(this);
  }

  setSandSave(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.sandSave, value);
  }

  render() {
    const { selectedValue } = this.props;

    return (
      <YesNoSelect
        label={"Sand Save for Par"}
        hideLabel={true}
        onHandleChange={this.setSandSave}
        selectedValue={selectedValue}
      />
    );
  }
}

SandSaveSelect.propTypes = {
  hole: PropTypes.number.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  selectedValue: PropTypes.string.isRequired
};

export default SandSaveSelect;
