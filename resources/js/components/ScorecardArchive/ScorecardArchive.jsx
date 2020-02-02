import React, { useState, useEffect } from "react";
import Header from "../../Argon/components/Headers/Header";
import ContentContainer from "../../Argon/components/ContentContainer/ContentContainer";
import { Card, CardHeader, Col, Row, Table } from "reactstrap";
import { withRouter, useParams, Redirect } from "react-router-dom";
import { StyledTableRow } from "./ScorecardArchive.styled";
import { app } from "../../constants/app";

const handleRoundClick = (roundId, setRoundId, setRoundClicked) => {
  setRoundId(roundId);
  setRoundClicked(true);
};

const ScorecardArchive = () => {
  const [scorecards, setScorecards] = useState([]);
  const [roundClicked, setRoundClicked] = useState(false);
  const [roundId, setRoundId] = useState();
  const { userId } = useParams();

  useEffect(() => {
    const getScorecardArchiveByUser = async () => {
      try {
        const response = await fetch(`/scorecard-archive/${userId}`);
        const json = await response.json();

        if (json.success) {
          setScorecards(json.data);
        }
      } catch (error) {
        console.error(error);
      }
    };

    getScorecardArchiveByUser();
  }, [userId]);

  if (roundClicked) {
    return <Redirect to={`${app.baseUrl}/scorecard/${roundId}`} push />;
  }

  return (
    <React.Fragment>
      <Header />
      <ContentContainer>
        <Row>
          <Col md="9">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <Col>
                    <h3 className="mb-0">Scorecards</h3>
                  </Col>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Date Played</th>
                    <th scope="col">Course</th>
                    <th scope="col">Strokes</th>
                  </tr>
                </thead>
                <tbody>
                  {scorecards.map((scorecard, index) => {
                    const {
                      roundId,
                      datePlayed,
                      courseTitle,
                      strokes
                    } = scorecard;
                    return (
                      <StyledTableRow
                        key={`scorecard-row-${index}`}
                        onClick={() =>
                          handleRoundClick(roundId, setRoundId, setRoundClicked)
                        }
                      >
                        <th scope="col">{datePlayed}</th>
                        <th scope="col">{courseTitle}</th>
                        <th scope="col">{strokes}</th>
                      </StyledTableRow>
                    );
                  })}
                </tbody>
              </Table>
            </Card>
          </Col>
        </Row>
      </ContentContainer>
    </React.Fragment>
  );
};

export default withRouter(ScorecardArchive);
