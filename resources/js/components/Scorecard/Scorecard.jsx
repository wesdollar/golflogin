import React from "react";
import PropTypes from "prop-types";
import { Row, Col } from "reactstrap";
import { get } from "lodash";
import ScorecardTable from "./ScorecardTable/ScorecardTable";
import { scorecard } from "./Scorecard.constants";

const Scorecard = ({ roundData, roundDetails, golfer }) => {
  if (!roundData.length) {
    return null;
  }

  const roundType = roundDetails.type;
  const startingSide = roundDetails.starting_side;
  let frontNine;
  let backNine;
  let displayFront = false;
  let displayBack = false;

  if (
    roundType === scorecard.roundType.all ||
    startingSide === scorecard.front
  ) {
    frontNine = roundData.slice(0, 9);
    displayFront = true;
  }

  if (
    roundType === scorecard.roundType.all ||
    startingSide === scorecard.back
  ) {
    backNine = roundData.slice(9, 18);
    displayBack = true;
  }

  return (
    <>
      <Row>
        <Col>
          <h3 className={"mb-4"}>
            <span className={"font-weight-300"}>{golfer}</span>{" "}
            {get(roundDetails, "course.title", "")} –{" "}
            {get(roundDetails, "course.tee_box", "")} |{" "}
            {get(roundDetails, "date_played", "")}
          </h3>
        </Col>
      </Row>
      {displayFront && (
        <Row className={"mb-5"}>
          <Col>
            <ScorecardTable nineData={frontNine} side={scorecard.front} />
          </Col>
        </Row>
      )}
      {displayBack && (
        <Row>
          <Col>
            <ScorecardTable nineData={backNine} side={scorecard.back} />
          </Col>
        </Row>
      )}
    </>
  );
};

Scorecard.propTypes = {
  roundDetails: PropTypes.object.isRequired,
  roundData: PropTypes.array.isRequired,
  golfer: PropTypes.string.isRequired
};

Scorecard.defaultProps = {
  roundDetails: {},
  roundData: [],
  golfer: ""
};

export default Scorecard;
