import React from "react";
import PropTypes from "prop-types";

/** @namespace GL.user.fullName */
const userFullName = GL.user.fullName;

const Header = ({activeGroup}) => {
    return (
        <header id="header" className="header">
            <div className="header-menu">
                <div className="col-sm-7">
                    <a id="menuToggle" className="menutoggle pull-left">
                        <i className="fa fa fa-hand-o-left" />
                    </a>
                    <div className="header-left">
                        <h3>
                            {activeGroup}
                        </h3>
                    </div>
                </div>

                <div className="col-sm-5">
                    <div className="user-area dropdown float-right" style={{marginRight: '9px'}}>
                        <a href="#"
                           className="dropdown-toggle"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">

                            {userFullName}
                            <i className="fa fa-caret-down" style={{marginLeft: '8px'}} />
                        </a>

                        <div className="user-menu dropdown-menu">
                            <a className="nav-link" href="#">
                                <i className="fa fa-user mr-2" />
                                Edit Profile
                            </a>
                            <a className="nav-link" href="#">
                                <i className="fa fa-cog mr-2" />
                                Settings
                            </a>
                            <a className="nav-link" href="#">
                                <i className="fa fa-power-off mr-2" />
                                Logout
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
    );
};

Header.propTypes = {
    activeGroup: PropTypes.string.isRequired
};

Header.defaultProps = {
    activeGroup: "Golf Login"
};

export default Header;