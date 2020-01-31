<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Hole;
use App\Jobs\ProcessUserStats;
use App\Round;
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
        $activeGroupId = $this->userService->getActiveGroupIdFromUser($user);
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
         */ // example request

        try {
            $roundId = $this->roundsService->createRoundFromRequest($request);
        }
        catch (\Exception $e) {
            $response = [
                'success' => false,
                'error' => "Unable to create round."
            ];

            return response()->json($response, 406);
        }

        try {
            $this->roundsService->createHoleDataFromRequest($request, $roundId);
        }
        catch (\Exception $e) {
            $response = [
                'success' => false,
                'error' => "Unable to save round stats, but the round's scorecard was saved."
            ];

            return response()->json($response, 406);
        }

        $userId = $user = $this->userService->getUser()->id;

        try {
            ProcessUserStats::dispatch($userId);
        }
        catch (\Exception $e) {
            $response = [
                'success' => false,
                'error' => "Unable to update stats at this time."
            ];

            return response()->json($response, 422);
        }

        return response()->json([
            "success" => true
        ]);
    }

    public function get(Request $request) {
        $activeGroupId = UserService::getUserData()['activeGroupTitle'];
        $roundId = $request->route('roundId');
        $data = RoundsService::getRoundAndRoundDataById($roundId);

        if ($activeGroupId !== $data["roundDetails"]["group_id"]) {
            $response = [
                'success' => false,
                'error' => "Round belongs to a group you don't have access to."
            ];

            return response()->json($response, 403);
        }

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }

    public function scorecardArchive(Request $request) {
        $userId = $request->route('userId');
        $data = RoundsService::getAllRoundsByUserId($userId);

        return response()->json([
            "success" => true,
            "data" => $data
        ]);
    }
}
