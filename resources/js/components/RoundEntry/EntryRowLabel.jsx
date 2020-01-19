import React from "react";
import PropTypes from "prop-types";

function EntryRowLabel({ label }) {
  return (
    <div className="row">
      <div className={"col"}>{label}</div>
    </div>
  );
}

EntryRowLabel.propTypes = {
  label: PropTypes.string.isRequired
};

export default EntryRowLabel;
