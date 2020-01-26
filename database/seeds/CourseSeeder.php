<?php

use App\Course;
use App\Hole;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group_id = 3;
        $title = "Junip Creek";
        $tee_box = "Blue";
        $rating = 73.2;
        $slope = 132;
        $user_id = 1;

        $course = Course::create(compact(
            "group_id",
            "title",
            "tee_box",
            "rating",
            "slope",
            "user_id"
        ));

        Hole::create([
            "course_id" => $course->id,
            "number" => 1,
            "par" => 4,
            "yardage" => 467
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 2,
            "par" => 4,
            "yardage" => 401
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 3,
            "par" => 3,
            "yardage" => 201
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 4,
            "par" => 4,
            "yardage" => 506
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 5,
            "par" => 5,
            "yardage" => 578
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 6,
            "par" => 3,
            "yardage" => 145
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 7,
            "par" => 4,
            "yardage" => 401
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 8,
            "par" => 5,
            "yardage" => 614
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 9,
            "par" => 4,
            "yardage" => 523
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 10,
            "par" => 4,
            "yardage" => 301
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 11,
            "par" => 3,
            "yardage" => 257
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 12,
            "par" => 4,
            "yardage" => 467
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 13,
            "par" => 4,
            "yardage" => 543
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 14,
            "par" => 5,
            "yardage" => 478
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 15,
            "par" => 3,
            "yardage" => 201
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 16,
            "par" => 4,
            "yardage" => 432
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 17,
            "par" => 5,
            "yardage" => 589
        ]);

        Hole::create([
            "course_id" => $course->id,
            "number" => 18,
            "par" => 4,
            "yardage" => 465
        ]);
    }
}
