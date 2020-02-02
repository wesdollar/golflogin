import React, { useEffect, useState } from "react";
import { withRouter, useParams } from "react-router-dom";
import Header from "../../Argon/components/Headers/Header";
import ContentContainer from "../../Argon/components/ContentContainer/ContentContainer";
import { Row, Col } from "reactstrap";
import { get } from "lodash";
import ScorecardTable from "./ScorecardTable/ScorecardTable";
import { scorecard } from "./Scorecard.constants";

const Scorecard = () => {
  const [roundDetails, setRoundDetails] = useState({});
  const [roundData, setRoundData] = useState([]);
  const { scorecardId } = useParams();

  useEffect(() => {
    const getScorecard = async () => {
      try {
        const response = await fetch(`/rounds/${scorecardId}`);
        const json = await response.json();

        console.log(json);

        setRoundDetails(json.data.roundDetails);
        setRoundData(json.data.roundData);
      } catch (error) {
        console.error(error);
      }
    };

    getScorecard();
  }, []);

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
      <Header />
      <ContentContainer>
        <Row>
          <Col>
            <h3 className={"mb-4"}>
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
      </ContentContainer>
    </>
  );
};

export default withRouter(Scorecard);
