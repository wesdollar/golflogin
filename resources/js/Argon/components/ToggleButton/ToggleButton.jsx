import React, { useState, useEffect } from "react";
import PropTypes from "prop-types";
import { Row, Col } from "reactstrap";
import { StyledToggleLabel } from "./ToggleButton.styled";

const handleCheckboxClick = (currentValue, setChecked) => {
  return setChecked(!currentValue);
};

const ToggleButton = ({ label, id, handleOnChange, defaultChecked }) => {
  const [checked, setChecked] = useState(defaultChecked);

  useEffect(() => {
    setChecked(defaultChecked);
  }, [defaultChecked]);

  return (
    <Row>
      <Col>
        <label className="custom-toggle">
          <input
            type="checkbox"
            id={id}
            onChange={handleOnChange}
            checked={checked}
            onClick={() => {
              handleCheckboxClick(checked, setChecked);
            }}
          />
          <span className="custom-toggle-slider rounded-circle" />
        </label>
        <StyledToggleLabel>{label}</StyledToggleLabel>
      </Col>
    </Row>
  );
};

ToggleButton.propTypes = {
  label: PropTypes.string.isRequired,
  id: PropTypes.string.isRequired,
  handleOnChange: PropTypes.func.isRequired,
  defaultChecked: PropTypes.bool
};

ToggleButton.defaultProps = {
  label: "",
  id: "",
  handleOnChange: () => {},
  defaultChecked: false
};

export default ToggleButton;
