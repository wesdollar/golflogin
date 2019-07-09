import React, { Component } from "react";
import { BrowserRouter as Router, Route } from "react-router-dom";
import ReactDOM from "react-dom";
import Example from "./Example";
import Dashboard from "./Dashboard";
import ThemeHeader from "./ThemeHeader";
import NavItem from "./NavItem";
import RoundEntry from "./RoundEntry";

/* eslint-disable no-undef */
/** @namespace GL.reactBase */
/** @namespace GL.user.activeGroupTitle */
const reactBaseHref = `/${GL.reactBase}`;
const activeGroup = GL.user.activeGroupTitle;
const appName = GL.appName;
const reactBase = GL.reactBase;
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
    title: "Post Round",
    href: "example",
    icon: "dashboard"
  },
  {
    title: "All Golfers",
    href: "dashboard",
    icon: "dashboard"
  }
];

class AppMain extends Component {
  render() {
    return (
      <Router>
        <aside id="left-panel" className="left-panel">
          <nav className="navbar navbar-expand-sm navbar-default">
            <div className="navbar-header">
              <button
                className="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#main-menu"
                aria-controls="main-menu"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <i className="fa fa-bars" />
              </button>
              <a className="navbar-brand" href="..">
                {appName}
              </a>
              <a className="navbar-brand hidden" href="..">
                <i className="fa fa-beer" />
              </a>
            </div>

            <div id="main-menu" className="main-menu collapse navbar-collapse">
              <ul className="nav navbar-nav">
                {navItems.map((navItem, index) => (
                  <NavItem
                    title={navItem.title}
                    href={navItem.href}
                    icon={navItem.icon}
                    baseHref={reactBaseHref}
                    key={`navItem-${index}`}
                  />
                ))}
              </ul>
            </div>
          </nav>
        </aside>

        <div id="right-panel" className="right-panel">
          <ThemeHeader activeGroup={activeGroup} />

          <div className="content mt-30">
            <Route exact path={`${reactBaseHref}/`} component={Dashboard} />
            <Route
              exact
              path={`${reactBaseHref}/dashboard`}
              component={Dashboard}
            />
            <Route path={`${reactBaseHref}/example`} component={Example} />
            <Route
              path={`${reactBaseHref}/round-entry`}
              component={RoundEntry}
            />
          </div>
        </div>
      </Router>
    );
  }
}

if (document.getElementById(reactBase)) {
  ReactDOM.render(<AppMain />, document.getElementById(reactBase));
}
