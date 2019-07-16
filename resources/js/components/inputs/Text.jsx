import React, { Component } from "react";
import PropTypes from "prop-types";

class Text extends Component {
  render() {
    const { label, id, value, name, handleOnChange, className } = this.props;

    return (
      <div className={`form-group`}>
        <label htmlFor="course-title">{label}</label>
        <input
          type="text"
          id={id}
          value={value}
          name={name}
          onChange={handleOnChange}
          className={`form-control ${className}`}
        />
      </div>
    );
  }
}

Text.propTypes = {
  label: PropTypes.string.isRequired,
  id: PropTypes.string.isRequired,
  value: PropTypes.string.isRequired,
  name: PropTypes.string.isRequired,
  handleOnChange: PropTypes.func.isRequired,
  className: PropTypes.string
};

Text.defaultProps = {
  className: ""
};

export default Text;
