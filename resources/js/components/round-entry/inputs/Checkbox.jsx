import React, { Component } from "react";
import PropTypes from "prop-types";
import StandardCheckbox from "../../inputs/Checkbox";

class Checkbox extends Component {
  render() {
    return (
      <div className={"row"}>
        <div className={"col text-center"}>
          <StandardCheckbox {...this.props} />
        </div>
      </div>
    );
  }
}

Checkbox.propTypes = {
  label: PropTypes.string.isRequired,
  hideLabel: PropTypes.bool,
  onHandleChange: PropTypes.func.isRequired,
  checked: PropTypes.bool,
  id: PropTypes.string.isRequired
};

export default Checkbox;
