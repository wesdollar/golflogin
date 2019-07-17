import React, { Component } from "react";
import PropTypes from "prop-types";

class NumberField extends Component {
  constructor() {
    super();

    this.state = {
      value: ""
    };

    this.handleChange = this.handleChange.bind(this);
  }

  handleChange(event) {
    const { value } = event.target;
    this.setState({ value });
    // eslint-disable-next-line react/destructuring-assignment
    this.props.onHandleChange(value);
  }

  render() {
    const { label } = this.props;
    const { value } = this.state;

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
              value={value}
              onChange={this.handleChange}
            />
          </div>
        </div>
      </div>
    );
  }
}

NumberField.propTypes = {
  label: PropTypes.string.isRequired,
  onHandleChange: PropTypes.func.isRequired
};

export default NumberField;
