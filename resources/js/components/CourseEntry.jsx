import React, { Component } from "react";
import TextEntry from "./inputs/TextEntry";
import { getNineInputAttributes } from "../helpers/get-nine-input-attributes";
import CourseNine from "./course-entry/CourseNine";
import Button from "./Button/Button";
import ContentContainer from "../Argon/components/ContentContainer/ContentContainer";
import Header from "../Argon/components/Headers/Header";
import { Row, Col } from "reactstrap";
import { courseEntry } from "../mock-data/course-entry";
import { handlePost } from "../helpers/fetch/handle-post";
import { app } from "../constants/app";

const FRONT_NINE = "front";
const BACK_NINE = "back";

class CourseEntry extends Component {
  constructor() {
    super();
    this.state = {
      courseTitle: "",
      teeBox: "",
      usgaRating: "",
      slopeRating: "",
      courseData: { frontNine: [], backNine: [] }
    };

    this.setValue = this.setValue.bind(this);
    this.setDummyData = this.setDummyData.bind(this);
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

  setDummyData() {
    // eslint-disable-next-line no-undef
    if (process.env.MIX_ENV === app.env.develop) {
      this.setState({
        courseData: {
          frontNine: courseEntry.frontNine,
          backNine: courseEntry.backNine
        },
        courseTitle: "The Patch",
        teeBox: "Purple",
        usgaRating: "67.2",
        slopeRating: "106"
      });
    }
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

    const handleOnSave = async () => {
      const pars = [
        /* eslint-disable react/destructuring-assignment,no-magic-numbers */
        this.state[`hole${1}-par`],
        this.state[`hole${2}-par`],
        this.state[`hole${3}-par`],
        this.state[`hole${4}-par`],
        this.state[`hole${5}-par`],
        this.state[`hole${6}-par`],
        this.state[`hole${7}-par`],
        this.state[`hole${8}-par`],
        this.state[`hole${9}-par`],
        this.state[`hole${10}-par`],
        this.state[`hole${11}-par`],
        this.state[`hole${12}-par`],
        this.state[`hole${13}-par`],
        this.state[`hole${14}-par`],
        this.state[`hole${15}-par`],
        this.state[`hole${16}-par`],
        this.state[`hole${17}-par`],
        this.state[`hole${18}-par`]
      ];

      const yardages = [
        this.state[`hole${1}-yardage`],
        this.state[`hole${2}-yardage`],
        this.state[`hole${3}-yardage`],
        this.state[`hole${4}-yardage`],
        this.state[`hole${5}-yardage`],
        this.state[`hole${6}-yardage`],
        this.state[`hole${7}-yardage`],
        this.state[`hole${8}-yardage`],
        this.state[`hole${9}-yardage`],
        this.state[`hole${10}-yardage`],
        this.state[`hole${11}-yardage`],
        this.state[`hole${12}-yardage`],
        this.state[`hole${13}-yardage`],
        this.state[`hole${14}-yardage`],
        this.state[`hole${15}-yardage`],
        this.state[`hole${16}-yardage`],
        this.state[`hole${17}-yardage`],
        this.state[`hole${18}-yardage`]
      ];
      /* eslint-enable react/destructuring-assignment,no-magic-numbers */

      const { courseTitle, teeBox, usgaRating, slopeRating } = this.state;

      const payload = {
        courseName: courseTitle,
        teeBox,
        usgaRating,
        slopeRating,
        pars,
        yardages
      };

      const request = {
        url: "/courses/create",
        payload
      };

      try {
        handlePost(request);
      } catch (error) {
        console.log(error);
      }
    };

    const { courseData } = this.state;

    return (
      /* eslint-disable react/destructuring-assignment */
      <>
        <Header />
        <ContentContainer>
          <Row>
            <Col md={{ offset: 2, size: 9 }}>
              {textFields.map(field => (
                <TextEntry
                  label={field.label}
                  id={field.id}
                  value={this.state[field.id]}
                  name={field.id}
                  handleOnChange={this.setValue}
                  key={field.id}
                  handleDoubleClick={this.setDummyData}
                />
              ))}
            </Col>
          </Row>
          <CourseNine
            courseData={courseData.frontNine}
            frontNine={frontNine}
            onHandleChange={this.setValue}
          />
          <CourseNine
            courseData={courseData.backNine}
            frontNine={backNine}
            onHandleChange={this.setValue}
          />
          <div className={"row"}>
            <div className={"col offset-md-2"}>
              <Button label={"Save"} handleOnClick={handleOnSave} />
            </div>
          </div>
        </ContentContainer>
      </>
      /* eslint-enable react/destructuring-assignment */
    );
  }
}

export default CourseEntry;
