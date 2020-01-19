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

  static getDerivedStateFromProps(props) {
    return {
      checked: props.checked
    };
  }

  handleChange() {
    // eslint-disable-next-line react/destructuring-assignment
    const checked = !this.state.checked;
    this.setState({ checked });

    // eslint-disable-next-line react/destructuring-assignment
    this.props.onHandleChange(checked);
  }

  render() {
    const { label, hideLabel, id } = this.props;
    const { checked } = this.state;

    return (
      <div className="custom-control custom-checkbox mb-3">
        <input
          className="custom-control-input"
          type="checkbox"
          checked={checked}
          id={id}
          onChange={() => {}}
        />
        <label
          onClick={this.handleChange}
          className={`custom-control-label`}
          htmlFor={id}
        >
          {!hideLabel && label}
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
