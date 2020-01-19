import React, { Component } from "react";
import PropTypes from "prop-types";

class CourseSelect extends Component {
  constructor() {
    super();
    this.state = {
      selectValue: ""
    };

    this.handleOnChange = this.handleOnChange.bind(this);
  }

  handleOnChange(event) {
    const { value } = event.target;
    this.setState({ selectValue: value });

    // eslint-disable-next-line react/destructuring-assignment
    this.props.handleOnChange(value);
  }

  render() {
    const { selectValue } = this.state;
    const { courses } = this.props;

    return (
      <div className="form-group">
        <label htmlFor="">Course</label>
        <select
          value={selectValue}
          className="form-control"
          onChange={this.handleOnChange}
        >
          <option value={""} />
          {courses.map((course, index) => (
            <option key={`courseSelect-${index}`} value={course.id}>
              {course.title}
            </option>
          ))}
        </select>
      </div>
    );
  }
}

CourseSelect.propTypes = {
  handleOnChange: PropTypes.func.isRequired,
  courses: PropTypes.array.isRequired
};

export default CourseSelect;
