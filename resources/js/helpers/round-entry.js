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
  const roundEntryLabels = Object.values(roundEntry);
  const roundLabels = [];
  for (const label of roundEntryLabels) {
    roundLabels.push(label);
  }

  return roundLabels;
};
