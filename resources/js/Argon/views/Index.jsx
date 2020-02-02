import React from "react";
import { Container, Row } from "reactstrap";

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
