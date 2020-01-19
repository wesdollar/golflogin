import React, { Component } from "react";
import NumberField from "../inputs/NumberField";
import { roundEntry } from "../../constants/round-entry";
import PropTypes from "prop-types";

class PuttsEntry extends Component {
  constructor() {
    super();
    this.onSetPutts = this.onSetPutts.bind(this);
  }

  onSetPutts(event) {
    const { hole, onHandleChange } = this.props;
    const { value } = event.target;

    onHandleChange(hole, roundEntry.putts, value);
  }

  render() {
    const { putts } = this.props;

    return (
      <NumberField
        inputValue={putts}
        label={roundEntry.putts}
        handleOnChange={this.onSetPutts}
      />
    );
  }
}

PuttsEntry.propTypes = {
  hole: PropTypes.number.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  putts: PropTypes.string
};

export default PuttsEntry;
