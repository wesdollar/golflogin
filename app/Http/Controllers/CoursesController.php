<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Services\CoursesService;
use App\Services\UserService;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    var $userService;
    var $coursesService;
    var $group;
    var $course;
    
    function __construct() {
        $this->userService = new UserService();
        $this->coursesService = new CoursesService();
        $this->group = new Group();
        $this->course = new Course();
    }

    public function createGui() {

        return view('back.courses.create');
    }

    public function create(Request $request) {

        $user = $this->userService->getUser();

        try {
            $title = $request->input('courseName');
            $groupId = $this->userService->getActiveGroupIdFromUser($user);
            $teeBox = $request->input('teeBox');
            $rating = $request->input('usgaRating');
            $slope = $request->input('slopeRating');

            $course = $this->coursesService->createCourse($title, $groupId, $teeBox, $rating, $slope);
            $holes = $this->coursesService->compileHoleDataIntoDbStructure($request->input("pars"), $request->input("yardages"));

            $this->coursesService->createHoles($course->id, $holes);
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
        $user = $this->userService->getUser();
        $courses = null;

        if ($user->groups()->count()) {
            $activeGroupId = $user->activeGroup()->id;
            $courses = $this->group->findOrFail($activeGroupId)->courses()->get();
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
        $course = $this->course->findOrFail($courseId);

        return response()->json($course->holes);
    }
}
