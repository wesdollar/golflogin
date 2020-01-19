import React, { Component } from "react";
import PropTypes from "prop-types";
import DatePicker from "../../Argon/components/DatePicker/DatePicker";
import "react-datepicker/dist/react-datepicker.css";

class DatePlayed extends Component {
  constructor() {
    super();

    this.setDatePlayed = this.setDatePlayed.bind(this);
  }

  setDatePlayed(value) {
    // eslint-disable-next-line react/destructuring-assignment
    this.props.handleOnChange(value);
  }

  render() {
    const { selectedDate } = this.props;
    const fieldId = "date-played";

    return (
      <div className={"form-group"}>
        <label htmlFor={fieldId} className={"display-block"}>
          Date Played
        </label>
        <DatePicker
          handleOnChange={this.setDatePlayed}
          id={fieldId}
          defaultValue={selectedDate}
        />
      </div>
    );
  }
}

DatePlayed.propTypes = {
  handleOnChange: PropTypes.func.isRequired,
  selectedDate: PropTypes.object
};

DatePlayed.defaultProps = {
  selectedDate: {}
};

export default DatePlayed;
