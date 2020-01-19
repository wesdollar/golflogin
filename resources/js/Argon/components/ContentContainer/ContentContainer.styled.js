import styled from "styled-components";
import { CardBody } from "reactstrap";
import { gutters } from "../../../constants/gutters";

export const StyledCardBody = styled(CardBody)`
  padding-top: ${gutters.doubleGutter}px;
  padding-bottom: ${gutters.doubleGutter}px;
`;
