import React from "react";
import PropTypes from "prop-types";
import { LoadingContainer } from "./Loading.styled";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

const Loading = ({ children, isLoading, iconSize, fullHeight, alignItems }) => {
  if (isLoading) {
    return (
      <LoadingContainer alignItems={alignItems} fullHeight={fullHeight}>
        <FontAwesomeIcon icon="spinner" size={`${iconSize}`} spin />
      </LoadingContainer>
    );
  }

  return children;
};

Loading.propTypes = {
  isLoading: PropTypes.bool.isRequired,
  iconSize: PropTypes.string,
  fullHeight: PropTypes.bool,
  alignItems: PropTypes.string
};

Loading.defaultProps = {
  isLoading: true,
  iconSize: "5x",
  fullHeight: true,
  alignItems: "center"
};

export default Loading;
