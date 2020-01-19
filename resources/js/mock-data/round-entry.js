import { roundTypes } from "../components/RoundEntry/constants/roundTypes";

export const mockRoundEntryData = {
  datePlayed: "Fri Jan 31 2020 00:00:00 GMT-0500",
  courseId: "1",
  isTournamentRound: false,
  isStatsRound: true,
  roundType: roundTypes.all,
  scorecardData: {
    "1": {
      Strokes: "4",
      Putts: "2",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 1
    },
    "2": {
      Strokes: "4",
      Putts: "1",
      GIR: false,
      FIR: true,
      "Up & Down": "yes",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 2
    },
    "3": {
      Strokes: "3",
      Putts: "2",
      GIR: true,
      FIR: "",
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 3
    },
    "4": {
      Strokes: "5",
      Putts: "2",
      GIR: false,
      FIR: "",
      "Up & Down": "no",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 4
    },
    "5": {
      Strokes: "4",
      Putts: "2",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 5
    },
    "6": {
      Strokes: "3",
      Putts: "1",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 6
    },
    "7": {
      Strokes: "3",
      Putts: "2",
      GIR: true,
      FIR: "",
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 7
    },
    "8": {
      Strokes: "4",
      Putts: "1",
      GIR: false,
      FIR: "",
      "Up & Down": "yes",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 8
    },
    "9": {
      Strokes: "5",
      Putts: "2",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 9
    },
    "10": {
      Strokes: "2",
      Putts: "1",
      GIR: true,
      FIR: "",
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 10
    },
    "11": {
      Strokes: "3",
      Putts: "1",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 11
    },
    "12": {
      Strokes: "5",
      Putts: "2",
      GIR: false,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "no",
      "Penalty Strokes": "",
      holeId: 12
    },
    "13": {
      Strokes: "3",
      Putts: "1",
      GIR: false,
      FIR: "",
      "Up & Down": "yes",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 13
    },
    "14": {
      Strokes: "5",
      Putts: "1",
      GIR: false,
      FIR: false,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "1",
      holeId: 14
    },
    "15": {
      Strokes: "5",
      Putts: "2",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 15
    },
    "16": {
      Strokes: "4",
      Putts: "2",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 16
    },
    "17": {
      Strokes: "3",
      Putts: "1",
      GIR: true,
      FIR: true,
      "Up & Down": "",
      "Sand Save": "",
      "Penalty Strokes": "",
      holeId: 17
    },
    "18": {
      Strokes: "4",
      Putts: "1",
      GIR: false,
      FIR: "",
      "Up & Down": "",
      "Sand Save": "yes",
      "Penalty Strokes": "",
      holeId: 18
    }
  }
};

export const courseData = [
  {
    number: "1",
    yardage: "234",
    par: "3"
  },
  {
    number: "2",
    yardage: "405",
    par: "4"
  },
  {
    number: "3",
    yardage: "604",
    par: "5"
  },
  {
    number: "4",
    yardage: "123",
    par: "3"
  },
  {
    number: "5",
    yardage: "234",
    par: "3"
  },
  {
    number: "6",
    yardage: "498",
    par: "4"
  },
  {
    number: "7",
    yardage: "475",
    par: "5"
  },
  {
    number: "8",
    yardage: "306",
    par: "4"
  },
  {
    number: "9",
    yardage: "658",
    par: "5"
  },
  {
    number: "10",
    yardage: "289",
    par: "4"
  },
  {
    number: "11",
    yardage: "249",
    par: "3"
  },
  {
    number: "12",
    yardage: "310",
    par: "4"
  },
  {
    number: "13",
    yardage: "134",
    par: "3"
  },
  {
    number: "14",
    yardage: "520",
    par: "4"
  },
  {
    number: "15",
    yardage: "467",
    par: "5"
  },
  {
    number: "16",
    yardage: "634",
    par: "5"
  },
  {
    number: "17",
    yardage: "478",
    par: "4"
  },
  {
    number: "18",
    yardage: "503",
    par: "4"
  }
];

export const coursesData = [
  {
    name: "One Course",
    id: 2
  },
  {
    name: "Two Course",
    id: 1
  }
];
