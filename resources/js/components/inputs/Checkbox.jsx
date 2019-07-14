import React, { Component } from "react";
import PropTypes from "prop-types";

class Checkbox extends Component {
  constructor(props) {
    super(props);
    const { checked } = this.props;
    this.state = {
      checked
    };

    this.handleChange = this.handleChange.bind(this);
  }

  handleChange(event) {
    const { checked } = event.target;
    this.setState({ checked });

    // eslint-disable-next-line react/destructuring-assignment
    this.props.onHandleChange(checked);
  }

  render() {
    const { label, hideLabel, id } = this.props;

    return (
      <div className="form-check">
        <input
          className="form-check-input"
          type="checkbox"
          checked={this.state.checked}
          id={id}
          onChange={this.handleChange}
        />
        <label
          className={`form-check-label ${hideLabel && "sr-only"}`}
          htmlFor={id}
        >
          {label}
        </label>
      </div>
    );
  }
}

Checkbox.propTypes = {
  label: PropTypes.string.isRequired,
  hideLabel: PropTypes.bool,
  onHandleChange: PropTypes.func.isRequired,
  id: PropTypes.string.isRequired,
  checked: PropTypes.bool
};

Checkbox.defaultProps = {
  checked: false
};

export default Checkbox;
