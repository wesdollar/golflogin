import React, { Component } from "react";
import {BrowserRouter as Router, Link, Route} from "react-router-dom"
import ReactDOM from "react-dom"
import Example from "./Example"
import Dashboard from "./Dashboard"
import Header from "./Header"

const reactBaseHref = "/app";

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
                                Golf Login
                            </a>
                            <a className="navbar-brand hidden" href="..">
                                <i className="fa fa-beer" />
                            </a>
                        </div>

                        <div id="main-menu" className="main-menu collapse navbar-collapse">
                            <ul className="nav navbar-nav">
                                <li>
                                    <Link to={`${reactBaseHref}/dashboard`}>
                                        <i className="menu-icon fa fa-dashboard" />
                                        Dashboard
                                    </Link>
                                    <Link to={`${reactBaseHref}/example`}>
                                        <i className="menu-icon fa fa-dashboard" />
                                        Example
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </aside>
                
                <div id="right-panel" className="right-panel">
                    <Header/>

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

const target = "app";
if (document.getElementById(target)) {
    ReactDOM.render(<AppMain />, document.getElementById(target));
}