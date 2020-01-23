import React from "react";
import { Row, Col, Nav, NavItem, NavLink } from "reactstrap";
import { getFullYear } from "../../../helpers/get-full-year";

class Footer extends React.Component {
  render() {
    const fullYear = getFullYear();

    return (
      <footer className="footer">
        <Row className="align-items-center justify-content-xl-between">
          <Col xl="6">
            <div className="copyright text-center text-xl-left text-muted">
              &copy; {fullYear}
              <a
                className="font-weight-bold ml-1"
                href="https://www.golflogin.com"
                target="_blank"
                rel="noopener noreferrer"
              >
                Golf Login
              </a>
            </div>
          </Col>

          <Col xl="6">
            <Nav className="nav-footer justify-content-center justify-content-xl-end">
              <NavItem>
                <NavLink
                  href="//golflogin.com"
                  rel="noopener noreferrer"
                  target="_blank"
                >
                  GolfLogin.com
                </NavLink>
              </NavItem>
              <NavItem>
                <NavLink href="#" rel="noopener noreferrer" target="_blank">
                  Logout
                </NavLink>
              </NavItem>
            </Nav>
          </Col>
        </Row>
      </footer>
    );
  }
}

export default Footer;
