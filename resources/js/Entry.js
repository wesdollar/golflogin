import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch, Redirect } from "react-router-dom";
import "./Argon/assets/vendor/nucleo/css/nucleo.css";
import "./Argon/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css";
import "./Argon/assets/scss/argon-dashboard-react.scss";
import AdminLayout from "./Argon/layouts/Admin.jsx";
import { app } from "./constants/app";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faSpinner } from "@fortawesome/free-solid-svg-icons";

library.add(faSpinner);

/* eslint-disable no-undef */
/** @namespace GL.reactBase */
/** @namespace GL.user.activeGroupTitle */
const reactBaseHref = `/${GL.reactBase}`;
const activeGroup = GL.user.activeGroupTitle;
const { appName, reactBase } = GL;
/* eslint-enable */

ReactDOM.render(
  <BrowserRouter>
    <Switch>
      <Route path={app.baseUrl} render={props => <AdminLayout {...props} />} />
      <Redirect from="/" to={app.dashboard} />
    </Switch>
  </BrowserRouter>,
  document.getElementById("root")
);
