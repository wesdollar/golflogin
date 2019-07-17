import React, { Component } from "react";
import Text from "./inputs/Text";
import RowLabels from "./round-entry/RowLabels";
import { getNineInputAttributes } from "../helpers/get-nine-input-attributes";
import NumberField from "./round-entry/inputs/NumberField";
import HoleLabel from "./round-entry/HoleLabel";

class CourseEntry extends Component {
  constructor() {
    super();
    this.state = {
      courseTitle: "",
      teeBox: "",
      usgaRating: "",
      slopeRating: ""
    };

    this.setValue = this.setValue.bind(this);
  }

  componentDidMount() {
    /* eslint-disable no-magic-numbers */
    const frontNine = getNineInputAttributes(1);
    const backNine = getNineInputAttributes(10);
    /* eslint-enable no-magic-numbers */

    this.setState({
      ...this.state,
      ...frontNine,
      ...backNine
    });
  }

  setValue(event) {
    const { name, value } = event.target;
    this.setState({ [name]: value });
  }

  render() {
    const textFields = [
      { id: "courseTitle", label: "Course Title" },
      { id: "teeBox", label: "Tee Box" },
      { id: "usgaRating", label: "USGA Rating" },
      { id: "slopeRating", label: "Slope Rating" }
    ];

    const rowLabels = ["Par", "Yardage"];

    const holeStart = 1;
    let currentHole = holeStart;
    const frontNine = [];
    while (currentHole <= 9) {
      frontNine.push(currentHole);
      currentHole++;
    }

    return (
      /* eslint-disable react/destructuring-assignment */
      <React.Fragment>
        {textFields.map(field => (
          <Text
            label={field.label}
            id={field.id}
            value={this.state[field.id]}
            name={field.id}
            handleOnChange={this.setValue}
            key={field.id}
          />
        ))}
        <div className={`row`}>
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
          {frontNine.map(holeNumber => (
            <div className={`col-md-1`} key={`courseHole-${holeNumber}`}>
              <NumberField
                label={`hole${holeNumber}-par`}
                onHandleChange={() => {}}
              />
              <NumberField
                label={`hole${holeNumber}-yardage`}
                onHandleChange={() => {}}
              />
            </div>
          ))}
        </div>
      </React.Fragment>
      /* eslint-enable react/destructuring-assignment */
    );
  }
}

export default CourseEntry;
