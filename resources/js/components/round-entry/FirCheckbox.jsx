import React, { Component } from "react";
import PropTypes from "prop-types";
import Checkbox from "./inputs/Checkbox";
import {roundEntry} from "../../constants/round-entry"
import {holeOnHandleChange} from "./prop-types/round-entry"

class FirCheckbox extends Component {
  constructor() {
    super();
    this.setFir = this.setFir.bind(this);
  }

  setFir(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.fir, value);
  }

  render() {
    return <Checkbox label={"FIR"} hideLabel={true} onHandleChange={this.setFir} />;
  }
}

FirCheckbox.propTypes = holeOnHandleChange;

export default FirCheckbox;
