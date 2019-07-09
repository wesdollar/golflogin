import React from "react";
import PropTypes from "prop-types";
import ColumnLabel from "./ColumnLabel";

function HoleLabel({ holeNumber }) {
  return <ColumnLabel label={holeNumber} />;
}

HoleLabel.propTypes = {
  holeNumber: PropTypes.string.isRequired
};

export default HoleLabel;
