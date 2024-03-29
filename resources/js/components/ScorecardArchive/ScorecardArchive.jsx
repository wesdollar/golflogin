import React, { useState, useEffect } from "react";
import Header from "../../Argon/components/Headers/Header";
import ContentContainer from "../../Argon/components/ContentContainer/ContentContainer";
import { Card, CardHeader, Col, Row, Table } from "reactstrap";
import { withRouter, useParams, Redirect } from "react-router-dom";
import { StyledTableRow } from "./ScorecardArchive.styled";
import { app } from "../../constants/app";
import Loading from "../Loading/Loading";

const handleRoundClick = (roundId, setRoundId, setRoundClicked) => {
  setRoundId(roundId);
  setRoundClicked(true);
};

const ScorecardArchive = () => {
  const [scorecards, setScorecards] = useState([]);
  const [roundClicked, setRoundClicked] = useState(false);
  const [isLoading, setIsLoading] = useState(true);
  const [roundId, setRoundId] = useState();
  const [displayName, setDisplayName] = useState("");
  const { userId } = useParams();

  useEffect(() => {
    /* eslint-disable no-undef */
    // double parseInt used because either could change independent of UI
    if (parseInt(GL.user.user.id) === parseInt(userId)) {
      setDisplayName(GL.user.fullName);
    }
    /* eslint-enable no-undef */

    const getScorecardArchiveByUser = async () => {
      try {
        const response = await fetch(`/scorecard-archive/${userId}`);
        const json = await response.json();

        if (json.success) {
          const { data } = json;
          setScorecards(data);
          // eslint-disable-next-line no-magic-numbers
          setDisplayName(data[0].golfer);
          setIsLoading(false);
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

  const displayNameTitle = displayName.length ? `| ${displayName}` : "";

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
                    <h3 className="mb-0">
                      Scorecards{" "}
                      <span className={"font-weight-300"}>
                        {displayNameTitle}
                      </span>
                    </h3>
                  </Col>
                </Row>
              </CardHeader>
              <Loading
                alignItems={"top"}
                fullHeight={false}
                isLoading={isLoading}
                iconSize={"3x"}
              >
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
                            handleRoundClick(
                              roundId,
                              setRoundId,
                              setRoundClicked
                            )
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
              </Loading>
            </Card>
          </Col>
        </Row>
      </ContentContainer>
    </React.Fragment>
  );
};

export default withRouter(ScorecardArchive);
