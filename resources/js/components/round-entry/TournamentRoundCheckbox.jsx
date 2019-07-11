import React, { Component } from "react";
import Checkbox from "../inputs/Checkbox";

class TournamentRoundCheckbox extends Component {
  render() {
    return <Checkbox label={"Tournament Round"} id={"isTournamentRound"} />;
  }
}

export default TournamentRoundCheckbox;
