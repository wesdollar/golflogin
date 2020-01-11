import React from "react";
import PropTypes from "prop-types";

const TextEntry = ({ label, id, value, name, handleOnChange, className }) => (
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

TextEntry.propTypes = {
  label: PropTypes.string.isRequired,
  id: PropTypes.string.isRequired,
  value: PropTypes.string.isRequired,
  name: PropTypes.string.isRequired,
  handleOnChange: PropTypes.func.isRequired,
  className: PropTypes.string
};

TextEntry.defaultProps = {
  className: ""
};

export default TextEntry;
