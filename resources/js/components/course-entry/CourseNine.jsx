import React, { useState, useEffect } from "react";
import PropTypes from "prop-types";
import HoleLabel from "../RoundEntry/HoleLabel";
import RowLabels from "../RoundEntry/RowLabels";
import NumberField from "../inputs/NumberField";
import { StyledEntryRow } from "../RoundEntry/ScorecardNine/ScorecardNine.styled";
import { Row } from "reactstrap";

const rowLabels = ["Par", "Yardage"];

const CourseNine = ({ frontNine, onHandleChange, courseData }) => {
  const [hasData, setHasData] = useState(false);

  useEffect(() => {
    courseData.length && setHasData(true);
  }, [courseData]);

  return (
    <React.Fragment>
      <Row className={"mt-5"}>
        <div className={`col-md-2`}>&nbsp;</div>
        {frontNine.map(holeNumber => (
          <div className={`col-md-1`} key={`holeEntryRowLabel-${holeNumber}`}>
            <HoleLabel holeNumber={holeNumber} />
          </div>
        ))}
      </Row>
      <Row>
        <RowLabels offsetRows={1} rowLabels={rowLabels} />
        {frontNine.map((holeNumber, index) => {
          const hole = `hole${holeNumber}`;
          const par = hasData ? courseData[index].par : "";
          const yardage = hasData ? courseData[index].yardage : "";

          return (
            <StyledEntryRow
              offsetRows={1}
              className={`col-md-1`}
              key={`courseHole-${holeNumber}`}
            >
              <NumberField
                label={`${hole}-par`}
                handleOnChange={onHandleChange}
                inputValue={par}
              />
              <NumberField
                label={`${hole}-yardage`}
                handleOnChange={onHandleChange}
                inputValue={yardage}
              />
            </StyledEntryRow>
          );
        })}
      </Row>
    </React.Fragment>
  );
};

CourseNine.propTypes = {
  frontNine: PropTypes.array.isRequired,
  onHandleChange: PropTypes.func.isRequired,
  courseData: PropTypes.array
};

CourseNine.defaultProps = {
  courseData: []
};

export default CourseNine;
