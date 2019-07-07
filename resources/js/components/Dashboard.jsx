import React from "react";
import PropTypes from "prop-types";

const Dashboard = () => {
    return (
        <div className="container-fluid">
            <div className={"row"}>
                <div className={"col-md-12"}>
                    <h1>Dashboard fuck me {GL.foo}</h1>
                </div>
            </div>
        </div>
    );
};

Dashboard.propTypes = {
};

Dashboard.defaultProps = {
};

export default Dashboard;