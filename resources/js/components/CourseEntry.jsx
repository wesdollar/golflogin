import React, { Component } from "react";
import Text from "./inputs/Text";
import RowLabels from "./round-entry/RowLabels";
import { getNineInputAttributes } from "../helpers/get-nine-input-attributes";

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
        <div className={`row gutter-top`}>
          <RowLabels rowLabels={rowLabels} />
        </div>
      </React.Fragment>
      /* eslint-enable react/destructuring-assignment */
    );
  }
}

export default CourseEntry;
