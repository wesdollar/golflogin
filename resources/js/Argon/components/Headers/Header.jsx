import React from "react";

// reactstrap components
import { Card, CardBody, CardTitle, Container, Row, Col } from "reactstrap";

class Header extends React.Component {
  render() {
    return (
      <>
        <div className="header bg-gradient-info pb-8 pt-6">
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
        </div>
      </>
    );
  }
}

export default Header;
