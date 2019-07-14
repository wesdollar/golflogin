import React, { Component } from "react";
import { coursesData } from "../../mock-data/round-entry";
import PropTypes from "prop-types";

class CourseSelect extends Component {
  constructor() {
    super();
    this.state = {
      courses: coursesData,
      selectValue: ""
    };

    this.handleOnChange = this.handleOnChange.bind(this);
  }

  handleOnChange(event) {
    const { value } = event.target;
    this.setState({ selectValue: value });

    // eslint-disable-next-line react/destructuring-assignment
    this.props.onHandleChange(value);
  }

  render() {
    const { courses, selectValue } = this.state;

    return (
      <div className="form-group">
        <label htmlFor="">Course</label>
        <select
          value={selectValue}
          className="form-control"
          onChange={this.handleOnChange}
        >
          {courses.map((course, index) => (
            <option key={`courseSelect-${index}`} value={course.id}>
              {course.name}
            </option>
          ))}
        </select>
      </div>
    );
  }
}

CourseSelect.propTypes = {
  onHandleChange: PropTypes.func.isRequired
};

export default CourseSelect;
