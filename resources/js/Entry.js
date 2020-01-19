import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch, Redirect } from "react-router-dom";

import "./Argon/assets/vendor/nucleo/css/nucleo.css";
import "./Argon/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css";
import "./Argon/assets/scss/argon-dashboard-react.scss";

import AdminLayout from "./Argon/layouts/Admin.jsx";
import AuthLayout from "./Argon/layouts/Auth.jsx";

/* eslint-disable no-undef */
/** @namespace GL.reactBase */
/** @namespace GL.user.activeGroupTitle */
const reactBaseHref = `/${GL.reactBase}`;
const activeGroup = GL.user.activeGroupTitle;
const { appName } = GL;
const { reactBase } = GL;
/* eslint-enable */

ReactDOM.render(
  <BrowserRouter>
    <Switch>
      <Route path="/admin" render={props => <AdminLayout {...props} />} />
      <Route path="/auth" render={props => <AuthLayout {...props} />} />
      <Redirect from="/" to="/admin/index" />
    </Switch>
  </BrowserRouter>,
  document.getElementById("root")
);
