import React, { Component } from "react";
import PropTypes from "prop-types";

class Button extends Component {
  render() {
    const { className, label, handleOnClick, gutter } = this.props;
    return (
      <div className={"row"}>
        <div className={`col ${className}`}>
          <button
            className={`btn btn-lg btn-primary ${gutter}`}
            onClick={handleOnClick}
          >
            {label}
          </button>
        </div>
      </div>
    );
  }
}

Button.propTypes = {
  handleOnClick: PropTypes.func,
  label: PropTypes.string,
  className: PropTypes.string,
  gutter: PropTypes.string
};

Button.defaultProps = {
  handleOnClick: () => {},
  label: "Save",
  className: "",
  gutter: "half-gutter-top"
};

export default Button;
