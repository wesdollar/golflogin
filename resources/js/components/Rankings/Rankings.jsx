import React from "react";
import StatBox from "../StatBox/StatBox";
import PropTypes from "prop-types";

const rankingKeys = [
  "scoringAverage18",
  "fir",
  "gir",
  "ppg",
  "ppr",
  "parSaves",
  "sandSaves",
  "parOrBetter",
  "parBusters",
  "par3Avg",
  "par4Avg",
  "par5Avg"
];

const Rankings = ({ golferStats }) => {
  return rankingKeys.map((key, index) => (
    <StatBox key={`statBox-${index}`} golferStats={golferStats} statKey={key} />
  ));
};

Rankings.propTypes = {
  golferStats: PropTypes.array.isRequired
};

Rankings.defaultProps = {
  golferStats: []
};

export default Rankings;
