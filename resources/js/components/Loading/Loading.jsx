import React from "react";
import PropTypes from "prop-types";
import { StyledLoadingContainer } from "./Loading.styled";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";

const Loading = ({ children, isLoading, iconSize, fullHeight, alignItems }) => {
  if (isLoading) {
    return (
      <StyledLoadingContainer alignItems={alignItems} fullHeight={fullHeight}>
        <FontAwesomeIcon icon="spinner" size={`${iconSize}`} spin />
      </StyledLoadingContainer>
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
