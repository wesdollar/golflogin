<?php

namespace App\Http\Controllers;

use App\Course;
use App\Hole;
use App\Services\UserService;
use App\Tee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function createGui() {

        return view('back.courses.create');
    }

    public function create(Request $request) {

        $user = Auth::user();

        $data = [
            'title' => $request->input('courseName'),
            'group_id' => UserService::getActiveGroupId($user),
            'tee_box' => $request->input('teeBox'),
            'rating' => $request->input('usgaRating'),
            'slope' => $request->input('slopeRating'),
        ];

        $course = Course::create($data);

        $yardages = $request->input('yardages');
        $pars = $request->input('pars');

        $holes = [];

        for($i = 1; $i <= 18; $i++) {

            $holes[$i]['par'] = $pars[$i];
            $holes[$i]['yardage'] = $yardages[$i];
        }

        $i = 1;

        foreach ($holes as $hole) {

            $data = [
                'course_id' => $course->id,
                'number' => $i,
                'par' => $hole['par'],
                'yardage' => $hole['yardage'],
            ];

            Hole::create($data);

            $i++;
        }

        return redirect()->route('dashboard')->with(['alert-success' => 'Course added!']);
    }
}
