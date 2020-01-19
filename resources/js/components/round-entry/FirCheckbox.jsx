import React, { Component } from "react";
import Checkbox from "./inputs/Checkbox";
import { roundEntry } from "../../constants/round-entry";
import { holeOnHandleChange } from "./prop-types/round-entry";
import ColumnLabel from "./ColumnLabel";

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
    const { hole, par } = this.props;
    const par3 = 3;

    if (parseInt(par) === par3) {
      return <ColumnLabel label={" "} />;
    }

    return (
      <Checkbox
        id={`fir-${hole}`}
        label={"FIR"}
        hideLabel={true}
        onHandleChange={this.setFir}
      />
    );
  }
}

FirCheckbox.propTypes = holeOnHandleChange;

export default FirCheckbox;
