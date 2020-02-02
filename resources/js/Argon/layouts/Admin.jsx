import React from "react";
import { Route, Switch } from "react-router-dom";
import { Container } from "reactstrap";
import AdminNavbar from "../components/Navbars/AdminNavbar.jsx";
import AdminFooter from "../components/Footers/AdminFooter.jsx";
import Sidebar from "../components/Sidebar/Sidebar.jsx";
import routes from "../routes.js";
import Scorecard from "../../components/Scorecard/Scorecard";

const activeGroup = GL.user.activeGroupTitle;

class Admin extends React.Component {
  componentDidUpdate(e) {
    document.documentElement.scrollTop = 0;
    document.scrollingElement.scrollTop = 0;
    this.refs.mainContent.scrollTop = 0;
  }
  getRoutes = routes => {
    return routes.map((prop, key) => {
      if (prop.layout === "/admin") {
        const path = prop.param
          ? `${prop.layout}${prop.path}/:${prop.param}`
          : `${prop.layout}${prop.path}`;

        return <Route path={path} component={prop.component} key={key} />;
      } else {
        return null;
      }
    });
  };
  getBrandText = path => {
    for (let i = 0; i < routes.length; i++) {
      if (
        this.props.location.pathname.indexOf(
          routes[i].layout + routes[i].path
        ) !== -1
      ) {
        return routes[i].name;
      }
    }
    return "Brand";
  };
  render() {
    return (
      <>
        <Sidebar {...this.props} routes={routes} />
        <div className="main-content" ref="mainContent">
          <AdminNavbar
            {...this.props}
            pageTitle={this.getBrandText(this.props.location.pathname)}
            activeGroup={activeGroup}
          />
          <Switch>{this.getRoutes(routes)}</Switch>
          <Container fluid>
            <AdminFooter />
          </Container>
        </div>
      </>
    );
  }
}

export default Admin;
