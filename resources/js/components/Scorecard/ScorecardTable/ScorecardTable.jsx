/* eslint-disable no-magic-numbers */
import React from "react";
import ScorecardRow from "../ScorecardRow/ScorecardRow";
import { Table } from "reactstrap";
import PropTypes from "prop-types";
import { scorecard } from "../Scorecard.constants";

const ScorecardTable = ({ nineData, side }) => {
  let totalYardage = 0;
  let totalPar = 0;

  nineData.forEach(data => {
    totalYardage = totalYardage + data.hole.yardage;
    totalPar = totalPar + data.hole.par;
  });

  const nineLabel = side === scorecard.back ? "In" : "Out";

  return (
    <Table className="align-items-center table-flush table-striped" responsive>
      <thead className="thead-dark">
        <tr>
          <th scope="col">Hole</th>
          <th>{nineData[0].hole.number}</th>
          <th>{nineData[1].hole.number}</th>
          <th>{nineData[2].hole.number}</th>
          <th>{nineData[3].hole.number}</th>
          <th>{nineData[4].hole.number}</th>
          <th>{nineData[5].hole.number}</th>
          <th>{nineData[6].hole.number}</th>
          <th>{nineData[7].hole.number}</th>
          <th>{nineData[8].hole.number}</th>
          <th scope="col">{nineLabel}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Yards</td>
          <td>{nineData[0].hole.yardage}</td>
          <td>{nineData[1].hole.yardage}</td>
          <td>{nineData[2].hole.yardage}</td>
          <td>{nineData[3].hole.yardage}</td>
          <td>{nineData[4].hole.yardage}</td>
          <td>{nineData[5].hole.yardage}</td>
          <td>{nineData[6].hole.yardage}</td>
          <td>{nineData[7].hole.yardage}</td>
          <td>{nineData[8].hole.yardage}</td>
          <td>{totalYardage}</td>
        </tr>
        <tr>
          <td>Par</td>
          <td>{nineData[0].hole.par}</td>
          <td>{nineData[1].hole.par}</td>
          <td>{nineData[2].hole.par}</td>
          <td>{nineData[3].hole.par}</td>
          <td>{nineData[4].hole.par}</td>
          <td>{nineData[5].hole.par}</td>
          <td>{nineData[6].hole.par}</td>
          <td>{nineData[7].hole.par}</td>
          <td>{nineData[8].hole.par}</td>
          <td>{totalPar}</td>
        </tr>
        <ScorecardRow
          rowLabel={"Strokes"}
          dataKey={"strokes"}
          roundData={nineData}
        />
        <ScorecardRow
          rowLabel={"Putts"}
          dataKey={"putts"}
          roundData={nineData}
        />
        <ScorecardRow rowLabel={"GIR"} dataKey={"gir"} roundData={nineData} />
        <ScorecardRow rowLabel={"FIR"} dataKey={"fir"} roundData={nineData} />
        <ScorecardRow
          rowLabel={"Par Save"}
          dataKey={"up_and_down"}
          roundData={nineData}
        />
        <ScorecardRow
          rowLabel={"Sand Save"}
          dataKey={"sand_save"}
          roundData={nineData}
        />
        <ScorecardRow
          rowLabel={"Penalty Strokes"}
          dataKey={"penalty_strokes"}
          roundData={nineData}
        />
      </tbody>
    </Table>
  );
};

ScorecardTable.propTypes = {
  nineData: PropTypes.array.isRequired,
  side: PropTypes.string.isRequired
};

ScorecardTable.defaultProps = {
  nineData: [],
  side: scorecard.front
};

export default ScorecardTable;
