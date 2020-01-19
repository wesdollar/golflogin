import React from "react";
import PropTypes from "prop-types";
import ToggleButton from "../../Argon/components/ToggleButton/ToggleButton";

const TournamentRoundCheckbox = ({ onHandleChange, isChecked }) => (
  <ToggleButton
    label={"Tournament Round"}
    id={"isTournamentRound"}
    handleOnChange={onHandleChange}
    defaultChecked={isChecked}
  />
);

TournamentRoundCheckbox.propTypes = {
  onHandleChange: PropTypes.func.isRequired,
  isChecked: PropTypes.bool.isRequired
};

export default TournamentRoundCheckbox;
