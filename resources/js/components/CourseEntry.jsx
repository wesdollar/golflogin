import React, { Component } from "react";
import Text from "./inputs/Text";
import { getNineInputAttributes } from "../helpers/get-nine-input-attributes";
import CourseNine from "./course-entry/CourseNine";

const FRONT_NINE = "front";
const BACK_NINE = "back";

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

  generateNineArray(side) {
    let holeStart, currentHole, holeEnd;

    /* eslint-disable no-magic-numbers */
    switch (side) {
      case FRONT_NINE:
        holeStart = 1;
        holeEnd = 9;
        break;

      case BACK_NINE:
        holeStart = 10;
        holeEnd = 18;
        break;
    }
    /* eslint-enable no-magic-numbers */

    currentHole = holeStart;
    const result = [];

    while (currentHole <= holeEnd) {
      // courseNine.holeLabel expects number as string
      result.push(currentHole.toString());
      currentHole++;
    }

    return result;
  }

  render() {
    const textFields = [
      { id: "courseTitle", label: "Course Title" },
      { id: "teeBox", label: "Tee Box" },
      { id: "usgaRating", label: "USGA Rating" },
      { id: "slopeRating", label: "Slope Rating" }
    ];

    const frontNine = this.generateNineArray(FRONT_NINE);
    const backNine = this.generateNineArray(BACK_NINE);

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
        <CourseNine frontNine={frontNine} onHandleChange={this.setValue} />
        <CourseNine frontNine={backNine} onHandleChange={this.setValue} />
      </React.Fragment>
      /* eslint-enable react/destructuring-assignment */
    );
  }
}

export default CourseEntry;
