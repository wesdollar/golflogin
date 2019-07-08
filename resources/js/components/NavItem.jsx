import React, {Component} from 'react'
import PropTypes from 'prop-types'
import {NavLink} from "react-router-dom"

class NavItem extends Component {

    render() {
        const {title, component, icon, baseHref} = this.props;

        return (
            <NavLink to={`${baseHref}/${component}`}>
                <i className={`menu-icon fa fa-${icon}`} />
                {title}
            </NavLink>
        )
    }
}

NavItem.propTypes = {
    title: PropTypes.string.isRequired,
    component: PropTypes.string.isRequired,
    icon: PropTypes.string.isRequired,
    baseHref: PropTypes.string.isRequired
}

export default NavItem