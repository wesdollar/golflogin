import React from "react";
import PropTypes from "prop-types";

const Header = () => {
    return (
        <header id="header" className="header">
            <div className="header-menu">
                <div className="col-sm-7">
                    <a id="menuToggle" className="menutoggle pull-left">
                        <i className="fa fa fa-hand-o-left" />
                    </a>
                    <div className="header-left">
                        <h3>
                            -- ACTIVE GROUP --
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

                            -- User Name --
                            <i className="fa fa-caret-down" style={{marginLeft: '8px'}} />
                        </a>

                        <div className="user-menu dropdown-menu">
                            <a className="nav-link" href="#">
                                <i className="fa fa-user" />
                                Edit Profile
                            </a>
                            <a className="nav-link" href="#">
                                <i className="fa fa-cog" />
                                Settings
                            </a>
                            <a className="nav-link" href="#">
                                <i className="fa fa-power-off" />
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
};

Header.defaultProps = {
};

export default Header;