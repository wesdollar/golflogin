import React, { Component } from "react";
import PropTypes from "prop-types";

class NumberField extends Component {
  render() {
    const { label } = this.props;

    return (
      <div className="row">
        <div className={"col"}>
          <div className="form-group">
            <label htmlFor="" className={"sr-only"}>
              {label}
            </label>
            <input
              type="text"
              className={`form-control text-center`}
              name=""
              id=""
            />
          </div>
        </div>
      </div>
    );
  }
}

NumberField.propTypes = {
  label: PropTypes.string.isRequired
};

export default NumberField;
