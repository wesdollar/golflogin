import React from "react";
import PropTypes from "prop-types";
import ReactDatetime from "react-datetime";
import {
  FormGroup,
  InputGroupAddon,
  InputGroupText,
  InputGroup
} from "reactstrap";

const DatePicker = ({ placeholder, handleOnChange, defaultValue }) => {
  return (
    <FormGroup>
      <InputGroup className="input-group">
        <InputGroupAddon addonType="prepend">
          <InputGroupText>
            <i className="ni ni-calendar-grid-58" />
          </InputGroupText>
        </InputGroupAddon>
        <ReactDatetime
          inputProps={{
            placeholder
          }}
          timeFormat={false}
          onChange={handleOnChange}
          closeOnSelect={true}
          value={defaultValue}
        />
      </InputGroup>
    </FormGroup>
  );
};

DatePicker.propTypes = {
  placeholder: PropTypes.string,
  handleOnChange: PropTypes.func.isRequired,
  defaultValue: PropTypes.object
};

DatePicker.defaultProps = {
  placeholder: "Select a date",
  handleOnChange: () => {},
  defaultValue: {}
};

export default DatePicker;
