import React from "react";
import PropTypes from "prop-types";
import ColumnLabel from "./ColumnLabel";

function ParLabel({ strokes }) {
  return <ColumnLabel label={strokes} />;
}

ParLabel.propTypes = {
  strokes: PropTypes.number.isRequired
};

export default ParLabel;
