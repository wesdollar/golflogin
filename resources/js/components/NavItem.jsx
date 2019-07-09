import React, { Component } from "react";
import PropTypes from "prop-types";
import { NavLink } from "react-router-dom";

class NavItem extends Component {
  render() {
    const { title, href, icon, baseHref } = this.props;

    return (
      <li>
        <NavLink to={`${baseHref}/${href}`}>
          <i className={`menu-icon fa fa-${icon}`} />
          {title}
        </NavLink>
      </li>
    );
  }
}

NavItem.propTypes = {
  title: PropTypes.string.isRequired,
  href: PropTypes.string.isRequired,
  icon: PropTypes.string.isRequired,
  baseHref: PropTypes.string.isRequired
};

export default NavItem;
