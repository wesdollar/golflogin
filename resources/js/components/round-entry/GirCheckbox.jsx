import React, { Component } from "react";
import PropTypes from "prop-types";
import Checkbox from "./inputs/Checkbox";
import { holeOnHandleChange } from "./prop-types/round-entry";
import { roundEntry } from "../../constants/round-entry";

class GirCheckbox extends Component {
  constructor() {
    super();
    this.setGir = this.setGir.bind(this);
  }

  setGir(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.gir, value);
  }

  render() {
    return (
      <Checkbox
        onHandleChange={this.setGir}
        label={roundEntry.gir}
        hideLabel={true}
      />
    );
  }
}

GirCheckbox.propTypes = holeOnHandleChange;

export default GirCheckbox;
