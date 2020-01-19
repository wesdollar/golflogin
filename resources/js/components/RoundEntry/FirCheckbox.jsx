import React, { Component } from "react";
import Checkbox from "./inputs/Checkbox";
import { roundEntry } from "../../constants/round-entry";
import ColumnLabel from "./ColumnLabel";
import PropTypes from "prop-types";

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
    const { hole, par, checked } = this.props;
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
        checked={!!checked}
      />
    );
  }
}

FirCheckbox.propTypes = {
  hole: PropTypes.number.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  par: PropTypes.number.isRequired,
  checked: PropTypes.oneOfType([PropTypes.bool, PropTypes.string])
};

export default FirCheckbox;
