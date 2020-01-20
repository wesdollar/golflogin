import styled from "styled-components";

export const StyledEntryRow = styled.div`
  > .row {
    height: 35px;
  }

  > .row:nth-child(n + ${({ offsetRows }) => offsetRows}) {
    height: 65px;
    align-items: center;

    .form-group {
      margin-bottom: 0;
    }

    .custom-control.custom-checkbox {
      top: -10px;
    }
  }
`;
