import React, { useEffect, useState } from "react";
import { withRouter, useParams } from "react-router-dom";
import Header from "../../Argon/components/Headers/Header";
import ContentContainer from "../../Argon/components/ContentContainer/ContentContainer";
import ScorecardComponent from "../../components/Scorecard/Scorecard";
import Loading from "../../components/Loading/Loading";

const Scorecard = () => {
  const [isLoading, setIsLoading] = useState(true);
  const [roundDetails, setRoundDetails] = useState({});
  const [roundData, setRoundData] = useState([]);
  const [golfer, setGolfer] = useState("");
  const { scorecardId } = useParams();

  useEffect(() => {
    const getScorecard = async () => {
      try {
        const response = await fetch(`/rounds/${scorecardId}`);
        const {
          data: { roundDetails, roundData, golfer }
        } = await response.json();

        setRoundDetails(roundDetails);
        setRoundData(roundData);
        setGolfer(golfer);
        setIsLoading(false);
      } catch (error) {
        console.error(error);
      }
    };

    getScorecard();
  }, []);

  return (
    <>
      <Header />
      <ContentContainer>
        <Loading isLoading={isLoading}>
          <ScorecardComponent
            roundData={roundData}
            roundDetails={roundDetails}
            golfer={golfer}
          />
        </Loading>
      </ContentContainer>
    </>
  );
};

export default withRouter(Scorecard);
