<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Services\CoursesService;
use App\Services\UserService;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function createGui() {

        return view('back.courses.create');
    }

    public function create(Request $request) {

        $user = UserService::getUser();

        try {
            $title = $request->input('courseName');
            $groupId = UserService::getActiveGroupId($user);
            $teeBox = $request->input('teeBox');
            $rating = $request->input('usgaRating');
            $slope = $request->input('slopeRating');

            $course = CoursesService::createCourse($title, $groupId, $teeBox, $rating, $slope);
            $holes = CoursesService::compileHoleDataIntoDbStructure($request->input("pars"), $request->input("yardages"));

            CoursesService::createHoles($course->id, $holes);
        }
        catch (\Exception $e) {
            $response = [
                'success' => false,
                'error' => $e->getMessage()
            ];

            return response()->json($response);
        }

        $response = [
            'success' => true,
            'courseId' => $course->id
        ];

        return response()->json($response);
    }

    public function get() {
        $user = UserService::getUser();
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

    public function getCourseData($courseId) {
        $course = Course::findOrFail($courseId);

        return response()->json($course->holes);
    }
}
