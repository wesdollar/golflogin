import React from "react";
import PropTypes from "prop-types";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

const LoadingInline = ({ children, isLoading }) => {
  if (isLoading) {
    return (
      <p>
        <FontAwesomeIcon icon="spinner" spin /> Loading...
      </p>
    );
  }

  return children;
};

LoadingInline.propTypes = {
  isLoading: PropTypes.bool.isRequired
};

LoadingInline.defaultProps = {
  isLoading: false
};

export default LoadingInline;
