import React, { Component } from "react";
import PropTypes from "prop-types";

class ColumnLabel extends Component {
  render() {
    const { className, label } = this.props;

    return (
      <div className="row">
        <div className={`col text-center ${className}`}>{label}</div>
      </div>
    );
  }
}

ColumnLabel.propTypes = {
  label: PropTypes.string.isRequired,
  className: PropTypes.string
};

ColumnLabel.defaultProps = {
  className: ""
};

export default ColumnLabel;
