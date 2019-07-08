import React, { Component } from "react";
import {BrowserRouter as Router, NavLink, Route} from "react-router-dom"
import ReactDOM from "react-dom"
import Example from "./Example"
import Dashboard from "./Dashboard"
import Header from "./Header"
import NavItem from "./NavItem"

/** @namespace GL.reactBase */
/** @namespace GL.user.activeGroupTitle */
const reactBaseHref = `/${GL.reactBase}`;
const activeGroup = GL.user.activeGroupTitle;
const appName = GL.appName;

const navItems = [
    {
        title: "Dashboard",
        component: "dashboard",
        icon: "dashboard"
    },
    {
        title: "Post Round",
        component: "example",
        icon: "dashboard"
    },
    {
        title: "Rankings",
        component: "dashboard",
        icon: "dashboard"
    },
    {
        title: "Stats",
        component: "example",
        icon: "dashboard"
    },
    {
        title: "Scorecards",
        component: "dashboard",
        icon: "dashboard"
    },
    {
        title: "Post Round",
        component: "example",
        icon: "dashboard"
    },
    {
        title: "All Golfers",
        component: "dashboard",
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
                            <button className="navbar-toggler"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#main-menu"
                                    aria-controls="main-menu"
                                    aria-expanded="false"
                                    aria-label="Toggle navigation">
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
                                <li>
                                    {navItems.map(navItem => (
                                        <NavItem
                                            title={navItem.title}
                                            component={navItem.component}
                                            icon={navItem.icon}
                                            baseHref={reactBaseHref}
                                        />
                                    ))}
                                </li>
                            </ul>
                        </div>
                    </nav>
                </aside>
                
                <div id="right-panel" className="right-panel">
                    <Header activeGroup={activeGroup} />

                    <div className="content mt-30">
                        <Route exact path={`${reactBaseHref}/`} component={Dashboard} />
                        <Route exact path={`${reactBaseHref}/dashboard`} component={Dashboard} />
                        <Route path={`${reactBaseHref}/example`} component={Example} />
                    </div>
                </div>
            </Router>
        );
    }
}

const target = GL.reactBase;
if (document.getElementById(target)) {
    ReactDOM.render(<AppMain />, document.getElementById(target));
}