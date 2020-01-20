import React from "react";
import PropTypes from "prop-types";
import EntryRowLabel from "./EntryRowLabel";
import { StyledEntryRow } from "./ScorecardNine/ScorecardNine.styled";

const RowLabels = ({ rowLabels, offsetRows }) => (
  <StyledEntryRow className={"col-md-2 text-right"} offsetRows={offsetRows}>
    {rowLabels.map((label, index) => (
      <EntryRowLabel key={`entryRow-${index}`} label={label} />
    ))}
  </StyledEntryRow>
);

RowLabels.propTypes = {
  rowLabels: PropTypes.array.isRequired,
  offsetRows: PropTypes.number
};

RowLabels.defaultProps = {
  offsetRows: 4
};

export default RowLabels;
