import React, { useState, useEffect } from "react";
import { Button, Card, CardHeader, Col, Row, Table } from "reactstrap";
import GolferRow from "./GolferRow/GolferRow";
import PropTypes from "prop-types";
import { orderBy } from "lodash";

const twoDecimals = 2;
const one = 1;

const formatNumber = number => parseFloat(number).toFixed(twoDecimals);

const statBoxTitles = {
  scoringAverage18: {
    title: "18 Hole Scoring Avg",
    sortOrder: "asc",
    numberFormat: number => `${formatNumber(number)}`
  },
  fir: {
    title: "Fairways in Regulation",
    sortOrder: "desc",
    numberFormat: number => `${formatNumber(number)}%`
  },
  gir: {
    title: "Greens in Regulation",
    sortOrder: "desc",
    numberFormat: number => `${formatNumber(number)}%`
  },
  ppg: {
    title: "Putts Per Green",
    sortOrder: "asc",
    numberFormat: number => `${formatNumber(number)}`
  },
  ppr: {
    title: "Putts Per Round",
    sortOrder: "asc",
    numberFormat: number => `${formatNumber(number)}`
  },
  parSaves: {
    title: "Par Saves",
    sortOrder: "desc",
    numberFormat: number => `${formatNumber(number)}%`
  },
  sandSaves: {
    title: "Sand Saves",
    sortOrder: "desc",
    numberFormat: number => `${formatNumber(number)}%`
  },
  parOrBetter: {
    title: "Par or Better",
    sortOrder: "desc",
    numberFormat: number => `${formatNumber(number)}%`
  },
  parBusters: {
    title: "Par Busters",
    sortOrder: "desc",
    numberFormat: number => `${formatNumber(number)}%`
  },
  par3Avg: {
    title: "Par Three Avg",
    sortOrder: "asc",
    numberFormat: number => `${formatNumber(number)}`
  },
  par4Avg: {
    title: "Par Four Avg",
    sortOrder: "asc",
    numberFormat: number => `${formatNumber(number)}`
  },
  par5Avg: {
    title: "Par Five Avg",
    sortOrder: "asc",
    numberFormat: number => `${formatNumber(number)}`
  }
};

const StatBox = ({ statKey, golferStats }) => {
  const [stats, setStats] = useState([]);

  useEffect(() => {
    const { sortOrder } = statBoxTitles[statKey];
    const sortedStats = orderBy(golferStats, [statKey], [sortOrder]);

    setStats(sortedStats);
  }, [golferStats, statKey]);

  return (
    <Col xl="4" className={"mb-4"}>
      <Card className="shadow">
        <CardHeader className="border-0">
          <Row className="align-items-center">
            <Col xs={8}>
              <h3 className="mb-0">{statBoxTitles[statKey].title}</h3>
            </Col>
            <Col className="text-right">
              {/*<Button*/}
              {/*  color="primary"*/}
              {/*  href="#pablo"*/}
              {/*  onClick={e => e.preventDefault()}*/}
              {/*  size="sm"*/}
              {/*>*/}
              {/*  See all*/}
              {/*</Button>*/}
            </Col>
          </Row>
        </CardHeader>
        <Table className="align-items-center table-flush" responsive>
          <thead className="thead-light">
            <tr>
              <th scope="col">Rank</th>
              <th scope="col">Golfer</th>
              <th scope="col" />
            </tr>
          </thead>
          <tbody>
            {stats.map((golfer, index) => {
              const metric = statBoxTitles[statKey].numberFormat(
                golfer[statKey]
              );

              return (
                <GolferRow
                  key={`statBox-${index}`}
                  golferName={golfer.golfer}
                  metric={metric}
                  rank={index + one}
                />
              );
            })}
          </tbody>
        </Table>
      </Card>
    </Col>
  );
};

StatBox.propTypes = {
  statKey: PropTypes.string.isRequired,
  golferStats: PropTypes.array.isRequired
};

export default StatBox;
