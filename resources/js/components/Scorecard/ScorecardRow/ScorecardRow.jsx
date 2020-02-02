/* eslint-disable no-magic-numbers */
import React from "react";
import PropTypes from "prop-types";

const renderYesNo = data => {
  if (data !== "n/a") {
    return data;
  } else {
    return " – ";
  }
};

const ScorecardRow = ({ rowLabel, roundData, dataKey }) => {
  let rowTotal = 0;

  roundData.forEach(data => {
    if (
      dataKey === "gir" ||
      dataKey === "fir" ||
      dataKey === "up_and_down" ||
      dataKey === "sand_save"
    ) {
      if (data[dataKey] === "yes") {
        rowTotal++;
      }
    } else {
      rowTotal = rowTotal + data[dataKey];
    }
  });

  return (
    <tr>
      <td>{rowLabel}</td>
      <td>{renderYesNo(roundData[0][dataKey])}</td>
      <td>{renderYesNo(roundData[1][dataKey])}</td>
      <td>{renderYesNo(roundData[2][dataKey])}</td>
      <td>{renderYesNo(roundData[3][dataKey])}</td>
      <td>{renderYesNo(roundData[4][dataKey])}</td>
      <td>{renderYesNo(roundData[5][dataKey])}</td>
      <td>{renderYesNo(roundData[6][dataKey])}</td>
      <td>{renderYesNo(roundData[7][dataKey])}</td>
      <td>{renderYesNo(roundData[8][dataKey])}</td>
      <td>{rowTotal}</td>
    </tr>
  );
};

ScorecardRow.propTypes = {
  rowLabel: PropTypes.string.isRequired,
  dataKey: PropTypes.string.isRequired,
  roundData: PropTypes.array.isRequired
};

ScorecardRow.defaultProps = {
  rowLabel: "",
  dataKey: "",
  roundData: []
};

export default ScorecardRow;
