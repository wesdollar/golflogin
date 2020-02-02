import React, { useState, useEffect } from "react";
import { Container, Row } from "reactstrap";
import Header from "../components/Headers/Header.jsx";
import Rankings from "../../components/Rankings/Rankings";

const Index = () => {
  const [golferStats, setGolferStats] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const getStats = async () => {
      try {
        const response = await fetch("/stats/get");
        const json = await response.json();

        setGolferStats(json);
        setIsLoading(false);
      } catch (error) {
        console.error(`Fetch failed: ${error}`);
      }
    };

    getStats();
  }, []);

  return (
    <>
      <Header />
      <Container className="mt--7" fluid>
        <Row>
          <Rankings golferStats={golferStats} isLoading={isLoading} />
        </Row>
      </Container>
    </>
  );
};

export default Index;
