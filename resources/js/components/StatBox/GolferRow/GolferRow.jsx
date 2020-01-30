import React from "react";
import PropTypes from "prop-types";

const GolferRow = ({ rank, golferName, metric }) => {
  return (
    <tr>
      <th scope="row">{rank}</th>
      <td>{golferName}</td>
      <td>{metric}</td>
    </tr>
  );
};

GolferRow.propTypes = {
  rank: PropTypes.number.isRequired,
  golferName: PropTypes.string.isRequired,
  metric: PropTypes.oneOfType([PropTypes.string, PropTypes.number]).isRequired
};

GolferRow.defaultProps = {
  rank: 1,
  golferName: "Wes Dollar",
  metric: "99%"
};

export default GolferRow;
