import React, { Component } from "react";
import NumberField from "../inputs/NumberField";
import { roundEntry } from "../../constants/round-entry";
import PropTypes from "prop-types";

class StrokesEntry extends Component {
  constructor() {
    super();
    this.onSetStrokes = this.onSetStrokes.bind(this);
  }

  onSetStrokes(event) {
    const { hole, onHandleChange } = this.props;
    const { value } = event.target;

    onHandleChange(hole, roundEntry.strokes, value);
  }

  render() {
    const { strokes } = this.props;

    return (
      <NumberField
        label={roundEntry.strokes}
        handleOnChange={this.onSetStrokes}
        inputValue={strokes}
      />
    );
  }
}

StrokesEntry.propTypes = {
  hole: PropTypes.number.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  strokes: PropTypes.string
};

StrokesEntry.defaultProps = {
  strokes: ""
};

export default StrokesEntry;
