/*!

=========================================================
* Argon Dashboard React - v1.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-react
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard-react/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
import React from "react";
import {
  Button,
  Card,
  CardHeader,
  CardBody,
  NavItem,
  NavLink,
  Nav,
  Progress,
  Table,
  Container,
  Row,
  Col
} from "reactstrap";

import Header from "../components/Headers/Header.jsx";
import Rankings from "../../components/Rankings/Rankings";

class Index extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      golferStats: []
    };
  }

  async componentDidMount() {
    try {
      const response = await fetch("/stats/get");
      const json = await response.json();

      this.setState({ golferStats: json });
    } catch (error) {
      console.error(`Fetch failed: ${error}`);
    }
  }

  render() {
    return (
      <>
        <Header />
        {/* Page content */}
        <Container className="mt--7" fluid>
          {/*<Row>*/}
          {/*  <Col className="mb-5 mb-xl-0" xl="8">*/}
          {/*    <Card className="bg-gradient-default shadow">*/}
          {/*      <CardHeader className="bg-transparent">*/}
          {/*        <Row className="align-items-center">*/}
          {/*          <div className="col">*/}
          {/*            <h6 className="text-uppercase text-light ls-1 mb-1">*/}
          {/*              Overview*/}
          {/*            </h6>*/}
          {/*            <h2 className="text-white mb-0">Sales value</h2>*/}
          {/*          </div>*/}
          {/*          <div className="col">*/}
          {/*            <Nav className="justify-content-end" pills>*/}
          {/*              <NavItem>*/}
          {/*                <NavLink*/}
          {/*                  className={classnames("py-2 px-3", {*/}
          {/*                    active: this.state.activeNav === 1*/}
          {/*                  })}*/}
          {/*                  href="#pablo"*/}
          {/*                  onClick={e => this.toggleNavs(e, 1)}*/}
          {/*                >*/}
          {/*                  <span className="d-none d-md-block">Month</span>*/}
          {/*                  <span className="d-md-none">M</span>*/}
          {/*                </NavLink>*/}
          {/*              </NavItem>*/}
          {/*              <NavItem>*/}
          {/*                <NavLink*/}
          {/*                  className={classnames("py-2 px-3", {*/}
          {/*                    active: this.state.activeNav === 2*/}
          {/*                  })}*/}
          {/*                  data-toggle="tab"*/}
          {/*                  href="#pablo"*/}
          {/*                  onClick={e => this.toggleNavs(e, 2)}*/}
          {/*                >*/}
          {/*                  <span className="d-none d-md-block">Week</span>*/}
          {/*                  <span className="d-md-none">W</span>*/}
          {/*                </NavLink>*/}
          {/*              </NavItem>*/}
          {/*            </Nav>*/}
          {/*          </div>*/}
          {/*        </Row>*/}
          {/*      </CardHeader>*/}
          {/*    </Card>*/}
          {/*  </Col>*/}
          {/*  <Col xl="4">*/}
          {/*    <Card className="shadow">*/}
          {/*      <CardHeader className="bg-transparent">*/}
          {/*        <Row className="align-items-center">*/}
          {/*          <div className="col">*/}
          {/*            <h6 className="text-uppercase text-muted ls-1 mb-1">*/}
          {/*              Performance*/}
          {/*            </h6>*/}
          {/*            <h2 className="mb-0">Total orders</h2>*/}
          {/*          </div>*/}
          {/*        </Row>*/}
          {/*      </CardHeader>*/}
          {/*    </Card>*/}
          {/*  </Col>*/}
          {/*</Row>*/}
          <Row>
            <Rankings golferStats={this.state.golferStats} />
          </Row>
        </Container>
      </>
    );
  }
}

export default Index;
