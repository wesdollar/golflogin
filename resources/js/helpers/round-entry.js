import { roundEntry } from "../constants/round-entry";

export const getScorecardDataByKey = (scorecardData, holeNumber, key) => {
  const holeNumberAsInteger = parseInt(holeNumber);
  let entry = "";

  if (
    scorecardData &&
    scorecardData[holeNumberAsInteger] &&
    scorecardData[holeNumberAsInteger][roundEntry[key]]
  ) {
    entry = scorecardData[holeNumberAsInteger][roundEntry[key]];
  }

  return entry;
};

export const getScorecardLabels = () => {
  const roundLabels = [];
  for (const label in roundEntry) {
    roundLabels.push(roundEntry[label]);
  }

  return roundLabels;
};
