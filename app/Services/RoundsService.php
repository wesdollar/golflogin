<?php

namespace App\Services;

use App\Round;
use App\RoundData;

class RoundsService {

    // DB structure for Rounds
    // user_id          int
    // course_id        int
    // group_id         int
    // date_played      date
    // type             "18" or "9"
    // starting_side    "front" or "back" (default front)
    // stats            boolean (default false)
    // tournament       boolean (default false)
    public static function createRound(
        int $userId,
        int $courseId,
        int $groupId,
        string $datePlayed,
        string $roundType, // "18" or "9"
        string $startingSide = "front", // "front" or "back"
        bool $statsRound = false,
        bool $tournamentRound = false
    ) {
        $data = [
            'user_id' => $userId,
            'course_id' => $courseId,
            'group_id' => $groupId,
            'date_played' => $datePlayed,
            'type' => $roundType,
            'starting_side' => $startingSide,
            'stats' => $statsRound,
            'tournament' => $tournamentRound
        ];

        $round = Round::create($data);

        return $round;
    }

    // DB structure for RoundsData
    // round_id         int
    // hole_id          int
    // strokes          smallInt
    // putts            smallInt
    // gir              enum [n/a, yes, no]
    // fir              enum [n/a, yes, no]
    // up_and_down      enum [n/a, yes, no]
    // sand_save        enum [n/a, yes, no]
    // penalty_strokes  smallInt (default 0)
    public static function createHoleData(
        int $roundId,
        int $holeId,
        int $strokes,
        int $putts,
        string $gir = "n/a",
        string $fir = "n/a",
        string $upAndDown = "n/a",
        string $sandSave = "n/a",
        int $penaltyStrokes = 0
    )
    {
        $data = [
            'round_id' => $roundId,
            'hole_id' => $holeId,
            'strokes' => $strokes,
            'putts' => $putts,
            'gir' => $gir,
            'fir' => $fir,
            'up_and_down' => $upAndDown,
            'sand_save' => $sandSave,
            'penalty_strokes' => $penaltyStrokes
        ];

        $holeData = RoundData::create($data);

        return $holeData;
    }

    public static function getRoundById($roundId) {
        $round = Round::findOrFail($roundId);

        return $round;
    }

    public static function getRoundType($requestRoundType) {
        if ($requestRoundType === "frontNine" || $requestRoundType === "backNine") {
            return 9;
        }

        return 18;
    }

    public static function getStartingSide($requestRoundType) {
        $startingSide = "front";

        switch ($requestRoundType) {
            case "all":
                break;
            case "frontNine":
                $startingSide = "front";
                break;
            case "backNine":
                $startingSide = "back";
                break;
        }

        return $startingSide;
    }
}