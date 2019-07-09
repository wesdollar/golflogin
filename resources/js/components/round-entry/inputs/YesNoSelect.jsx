import React, { Component } from "react";
import PropTypes from "prop-types";

class YesNoSelect extends Component {
  render() {
    const { label, hideLabel } = this.props;
    return (
      <div className={"row"}>
        <div className={"col"}>
          <div className="form-group">
            <label htmlFor="" className={`${hideLabel && "sr-only"}`}>
              {label}
            </label>
            <select className="form-control">
              <option value={""}>--</option>
              <option value={"yes"}>Yes</option>
              <option value={"no"}>No</option>
            </select>
          </div>
        </div>
      </div>
    );
  }
}

YesNoSelect.propTypes = {
  label: PropTypes.string.isRequired,
  hideLabel: PropTypes.bool
};

export default YesNoSelect;
