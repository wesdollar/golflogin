<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Hole;
use App\Services\UserService;
use App\Tee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoundsController extends Controller
{
    public function roundEntry() {

        $user = UserService::getUser();
        $activeGroupId = UserService::getActiveGroupId($user);
        $courses = Course::where('group_id', '=', $activeGroupId)->get();

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
            'isOwner' => UserService::isOwner($user),
            'players' => Group::find($activeGroupId)->users()->get()
        ];

        $data = [
            'courses' => $courses,
            'holes' => json_encode($holes),
            'meta' => json_encode($meta),
        ];

        return view('back.rounds.create', $data);
    }

    public function create() {

        dd('nothing yet');
    }
}
