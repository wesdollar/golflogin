import React, { useState, useEffect } from "react";
import PropTypes from "prop-types";
import HoleLabel from "../RoundEntry/HoleLabel";
import RowLabels from "../RoundEntry/RowLabels";
import NumberField from "../inputs/NumberField";

const rowLabels = ["Par", "Yardage"];

const CourseNine = ({ frontNine, onHandleChange, courseData }) => {
  const [hasData, setHasData] = useState(false);

  useEffect(() => {
    courseData.length && setHasData(true);
  }, [courseData]);

  return (
    <React.Fragment>
      <div className={`row half-gutter-top`}>
        <div className={`col-md-2`}>&nbsp;</div>
        {frontNine.map(holeNumber => (
          <div
            className={`col-md-1 scorecard-entry-row`}
            key={`holeEntryRowLabel-${holeNumber}`}
          >
            <HoleLabel holeNumber={holeNumber} />
          </div>
        ))}
      </div>
      <div className={`row`}>
        <RowLabels rowLabels={rowLabels} />
        {frontNine.map((holeNumber, index) => {
          const hole = `hole${holeNumber}`;
          const par = hasData ? courseData[index].par : "";
          const yardage = hasData ? courseData[index].yardage : "";

          return (
            <div className={`col-md-1`} key={`courseHole-${holeNumber}`}>
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
            </div>
          );
        })}
      </div>
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
