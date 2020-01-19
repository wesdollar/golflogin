import React, { Component } from "react";
import PropTypes from "prop-types";
import EntryRowLabel from "./EntryRowLabel";
import { StyledEntryRow } from "./ScorecardNine/ScorecardNine.styled";

class RowLabels extends Component {
  render() {
    const { rowLabels } = this.props;

    return (
      <StyledEntryRow className={"col-md-2 text-right"}>
        {rowLabels.map((label, index) => (
          <EntryRowLabel key={`entryRow-${index}`} label={label} />
        ))}
      </StyledEntryRow>
    );
  }
}

RowLabels.propTypes = {
  rowLabels: PropTypes.array.isRequired
};

export default RowLabels;
