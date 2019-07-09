import React, { Component } from "react";
import PropTypes from "prop-types";

class Checkbox extends Component {
  render() {
    const { label, hideLabel } = this.props;

    return (
      <div className="form-check">
        <input
          className="form-check-input"
          type="checkbox"
          value=""
          id="defaultCheck1"
        />
        <label
          className={`form-check-label ${hideLabel && "sr-only"}`}
          htmlFor="defaultCheck1"
        >
          {label}
        </label>
      </div>
    );
  }
}

Checkbox.propTypes = {
  label: PropTypes.string.isRequired,
  hideLabel: PropTypes.bool
};

export default Checkbox;
