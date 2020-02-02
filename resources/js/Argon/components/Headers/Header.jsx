import React from "react";
import { Container } from "reactstrap";
import { StyledHeader } from "./Header.styled";

class Header extends React.Component {
  render() {
    return (
      <>
        <StyledHeader className="header bg-gradient-info pb-8 pt-6">
          <Container fluid>
            <div className="header-body">
              {/* Card stats */}
              {/*<Row>*/}
              {/*  <Col>*/}
              {/*    <h1>What Up</h1>*/}
              {/*  </Col>*/}
              {/*</Row>*/}
            </div>
          </Container>
        </StyledHeader>
      </>
    );
  }
}

export default Header;
