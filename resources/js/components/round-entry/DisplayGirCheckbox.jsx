import React, { Component } from "react";
import PropTypes from "prop-types";
import GirCheckbox from "./GirCheckbox";
import ColumnLabel from "./ColumnLabel";
import { roundEntry } from "../../constants/round-entry";

class DisplayGirCheckbox extends Component {
  constructor() {
    super();

    this.setGir = this.setGir.bind(this);
    this.handleUpdateGir = this.handleUpdateGir.bind(this);
  }

  componentDidUpdate(prevProps) {
    this.handleUpdateGir(prevProps);
  }

  handleUpdateGir(prevProps) {
    const { par, strokes, putts } = this.props;

    if (strokes !== prevProps.strokes || putts !== prevProps.putts) {
      const isGir = this.isGir(par, strokes, putts);

      this.setGir(isGir);
    }
  }

  setGir(value) {
    const { hole, onHandleChange } = this.props;
    onHandleChange(hole, roundEntry.gir, value);
  }

  isGir(par, strokes, putts) {
    const strokesAsInt = parseInt(strokes);
    const puttsAsInt = parseInt(putts);

    const par3 = 3;
    const par4 = 4;
    const par5 = 5;
    let gir = false;

    switch (parseInt(par)) {
      case par3:
        // eslint-disable-next-line no-magic-numbers
        gir = strokesAsInt - puttsAsInt <= 1;
        break;
      case par4:
        // eslint-disable-next-line no-magic-numbers
        gir = strokesAsInt - puttsAsInt <= 2;
        break;
      case par5:
        // eslint-disable-next-line no-magic-numbers
        gir = strokesAsInt - puttsAsInt <= 3;
        break;
    }

    return gir;
  }

  render() {
    const { displayCheckbox, hole, onHandleChange } = this.props;

    if (displayCheckbox) {
      return <GirCheckbox hole={hole} onHandleChange={onHandleChange} />;
    }

    const { par, strokes, putts } = this.props;

    if (!strokes && !putts) {
      return <ColumnLabel label={"No"} className={"text-muted"} />;
    }

    if (this.isGir(par, strokes, putts)) {
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
