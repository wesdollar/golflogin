import React, { Component } from "react";
import YesNoSelect from "./inputs/YesNoSelect";
import { roundEntry } from "../../constants/round-entry";
import { holeOnHandleChange } from "./prop-types/round-entry";

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
    return (
      <YesNoSelect
        label={"Sand Save for Par"}
        hideLabel={true}
        onHandleChange={this.setSandSave}
      />
    );
  }
}

SandSaveSelect.propTypes = holeOnHandleChange;

export default SandSaveSelect;
