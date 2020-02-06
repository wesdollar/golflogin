import styled, { css } from "styled-components";

export const StyledLoadingContainer = styled.div`
  display: flex;
  width: 100%;
  height: calc(100vh - 200px);
  justify-content: center;
  align-items: ${({ alignItems }) => alignItems};

  ${({ fullHeight }) =>
    !fullHeight &&
    css`
      height: 100px;
    `}
`;
