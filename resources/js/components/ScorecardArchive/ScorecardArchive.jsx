import React, { useState, useEffect } from "react";
import Header from "../../Argon/components/Headers/Header";
import ContentContainer from "../../Argon/components/ContentContainer/ContentContainer";
import { Card, CardHeader, Col, Row, Table } from "reactstrap";
import { withRouter, useParams } from "react-router-dom";

const ScorecardArchive = () => {
  const [scorecards, setScorecards] = useState([]);
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

  return (
    <React.Fragment>
      <Header />
      <ContentContainer>
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
                  const { datePlayed, courseTitle, strokes } = scorecard;
                  return (
                    <tr key={`scorecard-row-${index}`}>
                      <th scope="col">{datePlayed}</th>
                      <th scope="col">{courseTitle}</th>
                      <th scope="col">{strokes}</th>
                    </tr>
                  );
                })}
              </tbody>
            </Table>
          </Card>
        </Col>
      </ContentContainer>
    </React.Fragment>
  );
};

export default withRouter(ScorecardArchive);
