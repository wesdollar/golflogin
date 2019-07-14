import React, { Component } from "react";
import Checkbox from "../inputs/Checkbox";
import PropTypes from "prop-types";

class TournamentRoundCheckbox extends Component {
  render() {
    const { onHandleChange } = this.props;

    return (
      <Checkbox
        label={"Tournament Round"}
        id={"isTournamentRound"}
        onHandleChange={onHandleChange}
      />
    );
  }
}

TournamentRoundCheckbox.propTypes = {
  onHandleChange: PropTypes.func.isRequired
};

export default TournamentRoundCheckbox;
