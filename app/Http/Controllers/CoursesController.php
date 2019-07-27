<?php

namespace App\Http\Controllers;

use App\Hole;
use App\Services\CoursesService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function createGui() {

        return view('back.courses.create');
    }

    public function create(Request $request) {

        $user = Auth::user();

        $title = $request->input('courseName');
        $groupId = UserService::getActiveGroupId($user);
        $teeBox = $request->input('teeBox');
        $rating = $request->input('usgaRating');
        $slope = $request->input('slopeRating');

        $course = CoursesService::createCourse($title, $groupId, $teeBox, $rating, $slope);

        $holesFromRequest = [];

        for ($i = 1; $i <= 18; $i++) {
            $par = "hole{$i}-par";
            $yardage = "hole{$i}-yardage";
            $holesFromRequest[$par] = $request->input($par);
            $holesFromRequest[$yardage] = $request->input($yardage);
        }

        $holes = CoursesService::compileHoleDataIntoDbStructure($holesFromRequest);

        CoursesService::createHoles($course->id, $holes);

        return response()->json("success");
    }
}
