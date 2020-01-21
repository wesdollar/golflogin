<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Hole;
use App\Services\RoundsService;
use App\Services\StatsService;
use App\Services\UserService;
use Illuminate\Http\Request;

class RoundsController extends Controller
{
    var $userService;
    var $roundsService;
    var $course;
    var $statsService;

    function __construct() {
        $this->userService = new UserService();
        $this->roundsService = new RoundsService();
        $this->course = new Course();
        $this->statsService = new StatsService();
    }

    public function roundEntry() {

        $user = $this->userService->getUser();
        $activeGroupId = $this->userService->getActiveGroupId($user);
        $courses = $this->course->where('group_id', '=', $activeGroupId)->get();

        if ($courses->count() === 0) {
            return redirect()->route('courses.createGui')->with('alert-info', 'You need to create a course before adding a round!');
        }

        $holes = [];

        foreach ($courses as $course) {
            $tmpHoles = Hole::where('course_id', '=', $course->id)->get();

            // nudge holes index up by one
            $offsetHoles = [];
            $i = 1;

            foreach ($tmpHoles as $hole) {
                $offsetHoles[$i] = $hole;
                $i++;
            }

            $holes[$course->id] = $offsetHoles;
        }

        $meta = [
            'isOwner' => $this->userService->isOwner($user),
            'players' => Group::find($activeGroupId)->users()->get()
        ];

        $data = [
            'courses' => $courses,
            'holes' => json_encode($holes),
            'meta' => json_encode($meta),
        ];

        return view('back.rounds.create', $data);
    }

    public function create(Request $request) {
        $user = $this->userService->getUserData();
        $requestRoundType = $request->get("roundType");

        $userId = $user["user"]->id;
        $groupId = $user["activeGroupId"];
        $courseId = (int) $request->get("courseId");
        $datePlayed = $request->get("datePlayed");
        $type = $this->roundsService->getRoundType($requestRoundType);
        $startingSide = $this->roundsService->getStartingSide($requestRoundType);
        $stats = $request->get("isStatsRound");
        $tournament = $request->get("isTournamentRound");

        $roundId = 1;
//        $roundId = $this->roundsService->createRound(
//            $userId,
//            $groupId,
//            $courseId,
//            $datePlayed,
//            $type,
//            $startingSide,
//            $stats,
//            $tournament
//        );

        foreach($request->get("scorecardData") as $hole) {
            $holeId = $hole["holeId"];
            $strokes = (int) $hole["Strokes"];
            $putts = (int) $hole["Putts"];
            $gir = $this->statsService->getYesNoValue($hole["GIR"]);
            $fir = $this->statsService->getYesNoValue($hole["FIR"]);
            $upAndDown = $this->statsService->getYesNoValue($hole["Up & Down"]);
            $sandSave = $this->statsService->getYesNoValue($hole["Sand Save"]);
            $penaltyStrokes = is_null($hole["Penalty Strokes"]) ? 0 : (int) $hole["Sand Save"];

            $this->roundsService->createHoleData(
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

        /*
         * Example Request
         * [
              "datePlayed" => "Fri Jan 31 2020 00:00:00 GMT-0500"
              "courseId" => "1"
              "isTournamentRound" => false
              "isStatsRound" => true
              "roundType" => "all"
              "scorecardData" => array:18 [
                1 => array:8 [
                  "Strokes" => "4"
                  "Putts" => "2"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 1
                ]
                2 => array:8 [
                  "Strokes" => "4"
                  "Putts" => "1"
                  "GIR" => false
                  "FIR" => true
                  "Up & Down" => "yes"
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 2
                ]
                3 => array:8 [
                  "Strokes" => "3"
                  "Putts" => "2"
                  "GIR" => true
                  "FIR" => null
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 3
                ]
                4 => array:8 [
                  "Strokes" => "5"
                  "Putts" => "2"
                  "GIR" => false
                  "FIR" => null
                  "Up & Down" => "no"
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 4
                ]
                5 => array:8 [
                  "Strokes" => "4"
                  "Putts" => "2"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 5
                ]
                6 => array:8 [
                  "Strokes" => "3"
                  "Putts" => "1"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 6
                ]
                7 => array:8 [
                  "Strokes" => "3"
                  "Putts" => "2"
                  "GIR" => true
                  "FIR" => null
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 7
                ]
                8 => array:8 [
                  "Strokes" => "4"
                  "Putts" => "1"
                  "GIR" => false
                  "FIR" => null
                  "Up & Down" => "yes"
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 8
                ]
                9 => array:8 [
                  "Strokes" => "5"
                  "Putts" => "2"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 9
                ]
                10 => array:8 [
                  "Strokes" => "2"
                  "Putts" => "1"
                  "GIR" => true
                  "FIR" => null
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 10
                ]
                11 => array:8 [
                  "Strokes" => "3"
                  "Putts" => "1"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 11
                ]
                12 => array:8 [
                  "Strokes" => "5"
                  "Putts" => "2"
                  "GIR" => false
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => "no"
                  "Penalty Strokes" => null
                  "holeId" => 12
                ]
                13 => array:8 [
                  "Strokes" => "3"
                  "Putts" => "1"
                  "GIR" => false
                  "FIR" => null
                  "Up & Down" => "yes"
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 13
                ]
                14 => array:8 [
                  "Strokes" => "5"
                  "Putts" => "1"
                  "GIR" => false
                  "FIR" => false
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => "1"
                  "holeId" => 14
                ]
                15 => array:8 [
                  "Strokes" => "5"
                  "Putts" => "2"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 15
                ]
                16 => array:8 [
                  "Strokes" => "4"
                  "Putts" => "2"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 16
                ]
                17 => array:8 [
                  "Strokes" => "3"
                  "Putts" => "1"
                  "GIR" => true
                  "FIR" => true
                  "Up & Down" => null
                  "Sand Save" => null
                  "Penalty Strokes" => null
                  "holeId" => 17
                ]
                18 => array:8 [
                  "Strokes" => "4"
                  "Putts" => "1"
                  "GIR" => false
                  "FIR" => null
                  "Up & Down" => null
                  "Sand Save" => "yes"
                  "Penalty Strokes" => null
                  "holeId" => 18
                ]
              ]
         *
         * DB notes:
         * "type" (round type) is enum 18|9
         * "starting_side" is enum front|back, defaults to front
         *      such that it doesn't need to be included for 18,
         *      is used to denote 9 holes front or back
         */
    }
}
