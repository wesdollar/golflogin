import React from "react";
import PropTypes from "prop-types";
import { gutters } from "../../constants/gutters";
import { StyledButton } from "./Button.styled";
import { buttonText } from "../../constants/button-text";

const Button = ({ className, label, handleOnClick, gutterTop }) => (
  <div className={"row"}>
    <div className={`col ${className}`}>
      <StyledButton
        gutterTop={gutterTop}
        className={`btn btn-lg btn-primary`}
        onClick={handleOnClick}
      >
        {label}
      </StyledButton>
    </div>
  </div>
);

Button.propTypes = {
  handleOnClick: PropTypes.func,
  label: PropTypes.string,
  className: PropTypes.string,
  gutterTop: PropTypes.number
};

Button.defaultProps = {
  handleOnClick: () => {},
  label: buttonText.continue,
  className: "",
  gutterTop: gutters.gutter
};

export default Button;
