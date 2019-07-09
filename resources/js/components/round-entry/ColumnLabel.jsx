import React, { Component } from "react";
import PropTypes from "prop-types";

class ColumnLabel extends Component {
  render() {
    return (
      <div className="row">
        <div className="col text-center">{this.props.label}</div>
      </div>
    );
  }
}

ColumnLabel.propTypes = {
  label: PropTypes.string.isRequired
};

export default ColumnLabel;
