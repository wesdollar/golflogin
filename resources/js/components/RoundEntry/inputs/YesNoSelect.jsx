import React, { Component } from "react";
import PropTypes from "prop-types";

class YesNoSelect extends Component {
  constructor(props) {
    super(props);
    this.state = { selectValue: props.selectedValue };

    this.handleChange = this.handleChange.bind(this);
  }

  static getDerivedStateFromProps(props) {
    return {
      selectValue: props.selectedValue
    };
  }

  handleChange(event) {
    const { value } = event.target;
    this.setState({ selectValue: value });

    // eslint-disable-next-line react/destructuring-assignment
    this.props.onHandleChange(value);
  }

  render() {
    const { label, hideLabel } = this.props;
    const { selectValue } = this.state;

    return (
      <div className={"row"}>
        <div className={"col"}>
          <div className="form-group">
            <label htmlFor="" className={`${hideLabel && "sr-only"}`}>
              {label}
            </label>
            <select
              value={selectValue}
              className="form-control"
              onChange={this.handleChange}
            >
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
  hideLabel: PropTypes.bool,
  onHandleChange: PropTypes.func.isRequired,
  selectedValue: PropTypes.string.isRequired
};

YesNoSelect.defaultProps = {
  selectedValue: ""
};

export default YesNoSelect;
