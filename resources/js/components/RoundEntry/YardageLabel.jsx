import React from "react";
import PropTypes from "prop-types";
import ColumnLabel from "./ColumnLabel";

function YardageLabel({ yardage }) {
  return <ColumnLabel label={yardage} />;
}

YardageLabel.propTypes = {
  yardage: PropTypes.number.isRequired
};

export default YardageLabel;
