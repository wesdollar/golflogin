import React, { useState, useEffect } from "react";
import PropTypes from "prop-types";
import { FormGroup } from "reactstrap";
import { roundTypes as roundTypesConstants } from "./constants/roundTypes";

const roundTypes = [
  {
    label: "18 Holes",
    id: roundTypesConstants.all,
    defaultChecked: true
  },
  {
    label: "Front 9",
    id: roundTypesConstants.frontNine,
    defaultChecked: false
  },
  {
    label: "Back 9",
    id: roundTypesConstants.backNine,
    defaultChecked: false
  }
];

const HolesPlayed = ({ handleOnChange, roundType }) => {
  const [selectedRoundType, setSelectedRoundType] = useState(
    roundTypesConstants.all
  );

  useEffect(() => {
    setSelectedRoundType(roundType);
  }, [roundType]);

  return (
    <FormGroup>
      <label>Holes Played</label>
      {roundTypes.map(type => {
        const defaultChecked = selectedRoundType === type.id;

        return (
          <div
            key={`holesPlayed-${type.id}`}
            className="custom-control custom-radio mb-3"
          >
            <input
              className="custom-control-input"
              id={type.id}
              name="holesPlayed"
              type="radio"
              value={type.id}
              checked={defaultChecked}
              onChange={event => {
                const { value } = event.target;
                handleOnChange(value);
                setSelectedRoundType(value);
              }}
            />
            <label className="custom-control-label" htmlFor={type.id}>
              {type.label}
            </label>
          </div>
        );
      })}
    </FormGroup>
  );
};

HolesPlayed.propTypes = {
  handleOnChange: PropTypes.func.isRequired,
  roundType: PropTypes.string.isRequired
};

HolesPlayed.defaultProps = {
  handleOnChange: () => {}
};

export default HolesPlayed;
