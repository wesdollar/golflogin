import React, { Component } from "react";
import PropTypes from "prop-types";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

class DatePlayed extends Component {
  constructor() {
    super();
    this.state = {
      datePlayed: ""
    };

    this.setDatePlayed = this.setDatePlayed.bind(this);
  }

  setDatePlayed(value) {
    this.setState({ datePlayed: value });
    // eslint-disable-next-line react/destructuring-assignment
    this.props.handleOnChange(value);
  }

  render() {
    const { datePlayed } = this.state;
    const fieldId = "date-played";

    return (
      <div className={"form-group"}>
        <label htmlFor={fieldId} className={"display-block"}>
          Date Played
        </label>
        <DatePicker
          selected={datePlayed}
          onChange={this.setDatePlayed}
          className={"form-control"}
          id={fieldId}
        />
      </div>
    );
  }
}

DatePlayed.propTypes = {
  handleOnChange: PropTypes.func.isRequired
};

export default DatePlayed;
