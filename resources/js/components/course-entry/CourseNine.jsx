import React, { Component } from "react";
import PropTypes from "prop-types";
import HoleLabel from "../round-entry/HoleLabel";
import RowLabels from "../round-entry/RowLabels";
import NumberField from "../inputs/NumberField";

class CourseNine extends Component {
  render() {
    const { frontNine, onHandleChange } = this.props;
    const rowLabels = ["Par", "Yardage"];

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
          {frontNine.map(holeNumber => {
            const hole = `hole${holeNumber}`;

            return (
              <div className={`col-md-1`} key={`courseHole-${holeNumber}`}>
                <NumberField
                  label={`${hole}-par`}
                  onHandleChange={onHandleChange}
                />
                <NumberField
                  label={`${hole}-yardage`}
                  onHandleChange={onHandleChange}
                />
              </div>
            );
          })}
        </div>
      </React.Fragment>
    );
  }
}

CourseNine.propTypes = {
  frontNine: PropTypes.array.isRequired,
  onHandleChange: PropTypes.func.isRequired
};

export default CourseNine;
