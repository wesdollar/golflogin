import React, { Component } from "react";
import PropTypes from "prop-types";
import GirCheckbox from "./GirCheckbox";
import ColumnLabel from "./ColumnLabel";

class DisplayGirCheckbox extends Component {
  render() {
    const { displayCheckbox, hole, onHandleChange } = this.props;

    if (displayCheckbox) {
      return (
        <GirCheckbox
          hole={hole}
          onHandleChange={onHandleChange}
        />
      );
    }

    const { par, strokes, putts } = this.props;
    const strokesAsInt = parseInt(strokes);
    const puttsAsInt = parseInt(putts);

    if (!strokesAsInt && !puttsAsInt) {
      return <ColumnLabel label={"No"} className={"text-muted"} />;
    }

    let gir = false;

    const par3 = 3;
    const par4 = 4;
    const par5 = 5;

    switch (parseInt(par)) {
      case par3:
        gir = strokesAsInt - puttsAsInt === 1;
        break;
      case par4:
        gir = strokesAsInt - puttsAsInt === 2;
        break;
      case par5:
        gir = strokesAsInt - puttsAsInt === 3;
        break;
    }

    if (gir) {
      return <ColumnLabel label={"Yes"} />;
    }

    return <ColumnLabel label={"No"} />;
  }
}

DisplayGirCheckbox.propTypes = {
  hole: PropTypes.string.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  putts: PropTypes.string.isRequired,
  strokes: PropTypes.string.isRequired,
  par: PropTypes.string.isRequired,
  displayCheckbox: PropTypes.bool
};

DisplayGirCheckbox.defaultProps = {
  putts: "0",
  strokes: "0"
};

DisplayGirCheckbox.defaultProps = {
  onHandleChange: () => {}
};

export default DisplayGirCheckbox;
