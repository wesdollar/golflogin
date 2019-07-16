import React, { Component } from "react";
import PropTypes from "prop-types";
import EntryRowLabel from "./EntryRowLabel";

class RowLabels extends Component {
  render() {
    const { rowLabels } = this.props;

    return (
      <div className={"col-md-2 scorecard-entry-row text-right"}>
        {rowLabels.map((label, index) => (
          <EntryRowLabel key={`entryRow-${index}`} label={label} />
        ))}
      </div>
    );
  }
}

RowLabels.propTypes = {
  rowLabels: PropTypes.array.isRequired
};

export default RowLabels;
