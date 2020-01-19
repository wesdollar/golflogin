import React, { useEffect, useState } from "react";
import PropTypes from "prop-types";
import { Row, Col } from "reactstrap";

const handleChange = (event, setValue, handleOnChange) => {
  const { value } = event.target;
  setValue(value);
  // eslint-disable-next-line react/destructuring-assignment
  handleOnChange(event);
};

const NumberField = ({ label, handleOnChange, inputValue }) => {
  const [value, setValue] = useState("");

  useEffect(() => {
    const fakeEvent = { target: { value: inputValue, name: label } };
    handleChange(fakeEvent, setValue, handleOnChange);
  }, [inputValue]);

  return (
    <Row>
      <Col>
        <div className="form-group">
          <label htmlFor="" className={"sr-only"}>
            {label}
          </label>
          <input
            type="text"
            className={`form-control text-center`}
            value={value}
            onChange={() => handleChange(event, setValue, handleOnChange)}
            name={label}
          />
        </div>
      </Col>
    </Row>
  );
};

NumberField.propTypes = {
  label: PropTypes.string.isRequired,
  handleOnChange: PropTypes.func.isRequired,
  inputValue: PropTypes.oneOfType([PropTypes.string, PropTypes.number])
};

NumberField.defaultProps = {
  inputValue: ""
};

export default NumberField;
