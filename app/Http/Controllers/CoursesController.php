<?php

namespace App\Http\Controllers;

use App\Group;
use App\Hole;
use App\Services\CoursesService;
use App\Services\UserService;
use App\User;
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
        $holes = CoursesService::compileHoleDataIntoDbStructure($request->input("pars"), $request->input("yardages"));

        CoursesService::createHoles($course->id, $holes);

        return response()->json("success");
    }

    public function get() {
        $user = Auth::user();
        $courses = null;

        if ($user->groups()->count()) {
            $activeGroupId = $user->activeGroup()->id;
            $courses = Group::findOrFail($activeGroupId)->courses()->get();
        }
        else {
            $courses = $user->courses()->get();
        }

        $data = [
            "courses" => $courses
        ];

        return response()->json($data);
    }
}
