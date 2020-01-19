import React, { Component } from "react";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import ReactDOM from "react-dom";
import Dashboard from "./Dashboard";
import { Container } from "reactstrap";
import Sidebar from "../Argon/components/Sidebar/Sidebar";
import AdminNavbar from "../Argon/components/Navbars/AdminNavbar";
import routes from "../Argon/routes";
import Index from "../Argon/views";
import AdminFooter from "../Argon/components/Footers/AdminFooter";

/* eslint-disable no-undef */
/** @namespace GL.reactBase */
/** @namespace GL.user.activeGroupTitle */
const reactBaseHref = `/${GL.reactBase}`;
const activeGroup = GL.user.activeGroupTitle;
const { appName } = GL;
const { reactBase } = GL;
/* eslint-enable */

const navItems = [
  {
    title: "Dashboard",
    href: "dashboard",
    icon: "dashboard"
  },
  {
    title: "Post Round",
    href: "round-entry",
    icon: "dashboard"
  },
  {
    title: "Rankings",
    href: "dashboard",
    icon: "dashboard"
  },
  {
    title: "Stats",
    href: "example",
    icon: "dashboard"
  },
  {
    title: "Scorecards",
    href: "dashboard",
    icon: "dashboard"
  },
  {
    title: "Add Course",
    href: "course-entry",
    icon: "dashboard"
  },
  {
    title: "All Golfers",
    href: "dashboard",
    icon: "dashboard"
  }
];

class AppMain extends Component {
  componentDidUpdate(e) {
    document.documentElement.scrollTop = 0;
    document.scrollingElement.scrollTop = 0;
    this.refs.mainContent.scrollTop = 0;
  }

  getRoutes = routes => {
    return routes.map((prop, key) => {
      if (prop.layout === "/admin") {
        return (
          <Route
            path={prop.layout + prop.path}
            component={prop.component}
            key={key}
          />
        );
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
    console.log(this.props);
    console.log("this.props");

    return (
      <>
        <Sidebar
          {...this.props}
          routes={routes}
          logo={{
            innerLink: "/admin/index",
            imgSrc: require(`../Argon/assets/img/brand/argon-react.png`),
            imgAlt: "..."
          }}
        />
        <div className="main-content" ref="mainContent">
          <AdminNavbar
            {...this.props}
            pageTitle={this.getBrandText(this.props.location.pathname)}
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
