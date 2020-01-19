import React from "react";
import PropTypes from "prop-types";
import ToggleButton from "../../Argon/components/ToggleButton/ToggleButton";

const StatsRoundCheckbox = ({ onHandleChange, defaultChecked }) => (
  <ToggleButton
    label={"Stats Round"}
    id={"isStatsRound"}
    handleOnChange={onHandleChange}
    defaultChecked={defaultChecked}
  />
);

StatsRoundCheckbox.propTypes = {
  onHandleChange: PropTypes.func.isRequired,
  defaultChecked: PropTypes.bool
};

StatsRoundCheckbox.defaultProps = {
  defaultChecked: false
};

export default StatsRoundCheckbox;
