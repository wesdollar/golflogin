import React, { Component } from "react";

class CourseSelect extends Component {
  constructor() {
    super();
    this.state = {
      courses: [
        {
          name: "One Course",
          id: 2
        },
        {
          name: "Two Course",
          id: 1
        }
      ]
    };
  }

  render() {
    const { courses } = this.state;

    return (
      <div className="form-group">
        <label htmlFor="">Course</label>
        <select className="form-control">
          {courses.map((course, index) => (
            <option key={`courseSelect-${index}`}>{course.name}</option>
          ))}
        </select>
      </div>
    );
  }
}

export default CourseSelect;
