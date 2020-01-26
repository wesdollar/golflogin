<?php

namespace App\Services;

use App\Round;
use App\RoundData;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoundsService {
    var $userService;
    var $statsService;

    function __construct() {
        $this->userService = new UserService();
        $this->statsService = new StatsService();
    }

    /**
     * @param int    $userId
     * @param int    $courseId
     * @param int    $groupId
     * @param string $datePlayed
     * @param string $roundType
     * @param string $startingSide
     * @param bool   $statsRound
     * @param bool   $tournamentRound
     *
     * @return int   $roundId
     */
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
            'group_id' => $groupId,
            'course_id' => $courseId,
            'date_played' => $datePlayed,
            'type' => $roundType,
            'starting_side' => $startingSide,
            'stats' => $statsRound,
            'tournament' => $tournamentRound
        ];

        $round = Round::create($data);

        return $round->id;
    }

    /**
     * @param int    $roundId
     * @param int    $holeId
     * @param int    $strokes
     * @param int    $putts
     * @param string $gir
     * @param string $fir
     * @param string $upAndDown
     * @param string $sandSave
     * @param int    $penaltyStrokes
     *
     * @return RoundData
     */
    public function createHoleData(
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

    /**
     * @param $roundId
     *
     * @return Round
     */
    public static function getRoundById($roundId) {
        $round = Round::findOrFail($roundId);

        return $round;
    }

    /**
     * @param $requestRoundType - round type from $request
     *
     * @return int
     */
    public static function getRoundType($requestRoundType) {
        if ($requestRoundType === "frontNine" || $requestRoundType === "backNine") {
            return 9;
        }

        return 18;
    }

    /**
     * @param $requestRoundType - round type from $request
     *
     * @return string
     */
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

    /**
     * @param Request $request
     *
     * @return int
     */
    public function createRoundFromRequest(Request $request):int {
        $user = $this->userService->getUserData();
        $requestRoundType = $request->get("roundType");

        $userId = $user["user"]->id;
        $groupId = $user["activeGroupId"];
        $courseId = (int) $request->get("courseId");
        $datePlayed = Carbon::parse($request->get("datePlayed"))->toDateTimeString();
        $type = $this->getRoundType($requestRoundType);
        $startingSide = $this->getStartingSide($requestRoundType);
        $stats = $request->get("isStatsRound");
        $tournament = $request->get("isTournamentRound");

        $roundId = $this->createRound(
            $userId,
            $courseId,
            $groupId,
            $datePlayed,
            $type,
            $startingSide,
            $stats,
            $tournament
        );

        return $roundId;
    }

    /**
     * @param Request $request
     * @param int     $roundId
     *
     * @return bool
     */
    public function createHoleDataFromRequest(Request $request, int $roundId): bool {

        try {
            foreach ($request->get("scorecardData") as $hole) {
                $holeId = $hole["holeId"];
                $strokes = (int) $hole["Strokes"];
                $putts = (int) $hole["Putts"];
                $gir = $this->statsService->getGirValue($hole["GIR"]);
                $fir = $this->statsService->getFirValue($holeId, $hole["FIR"]);
                $upAndDown = $this->statsService->getYesNoValue($hole["Up & Down"]);
                $sandSave = $this->statsService->getYesNoValue($hole["Sand Save"]);

                $penaltyStrokesKey = "Penalty Strokes";
                $penaltyStrokes = is_null($hole[$penaltyStrokesKey]) ? 0 : (int) $hole[$penaltyStrokesKey];

                $this->createHoleData(
                    $roundId,
                    $holeId,
                    $strokes,
                    $putts,
                    $gir,
                    $fir,
                    $upAndDown,
                    $sandSave,
                    $penaltyStrokes
                );
            }

            return true;
        }
        catch (\Exception $e) {
            // $e->getMessage()

            return false;
        }
    }
}