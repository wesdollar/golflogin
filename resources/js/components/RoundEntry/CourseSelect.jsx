import React, { useEffect, useState } from "react";
import PropTypes from "prop-types";
import LoadingInline from "../LoadingInline/LoadingInline";

const handleCourseSelect = (event, setSelectValue, handleOnChange) => {
  const { value } = event.target;
  setSelectValue(value);
  handleOnChange(value);
};

const CourseSelect = ({ handleOnChange }) => {
  const [selectValue, setSelectValue] = useState();
  const [courses, setCourses] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const getCourses = async () => {
      try {
        const result = await fetch("/courses/get");
        const json = await result.json();

        setCourses(json.courses);
        setIsLoading(false);
      } catch (error) {
        console.log(`fetch error: ${error}`);
      }
    };

    getCourses();
  }, []);

  return (
    <div className="form-group">
      <label htmlFor="">Course</label>
      <LoadingInline isLoading={isLoading}>
        <select
          value={selectValue}
          className="form-control"
          onChange={event =>
            handleCourseSelect(event, setSelectValue, handleOnChange)
          }
        >
          <option value={""} />
          {courses.map((course, index) => (
            <option key={`courseSelect-${index}`} value={course.id}>
              {course.title}
            </option>
          ))}
        </select>
      </LoadingInline>
    </div>
  );
};

CourseSelect.propTypes = {
  handleOnChange: PropTypes.func.isRequired
};

export default CourseSelect;
