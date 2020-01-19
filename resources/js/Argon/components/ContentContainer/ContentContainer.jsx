import React from "react";
import { Card, Col, Row, Container } from "reactstrap";
import { StyledCardBody } from "./ContentContainer.styled";

// eslint-disable-next-line react/prop-types
const ContentContainer = ({ children }) => (
  <Container className="mt--7" fluid>
    <Row>
      <Col>
        <Card className={"shadow"}>
          <StyledCardBody>{children}</StyledCardBody>
        </Card>
      </Col>
    </Row>
  </Container>
);

export default ContentContainer;
