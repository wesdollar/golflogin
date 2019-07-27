<?php

namespace Tests\Unit;

use App\Services\CoursesService;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CoursesServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_new_course()
    {
        $title = "Phish Island";
        $groupId = 555;
        $teeBox = "Red";
        $rating = 73.2;
        $slope = 132;

        $result = CoursesService::createCourse(
            $title,
            $groupId,
            $teeBox,
            $rating,
            $slope
        );

        $dbFields = ["title", "groupId", "teeBox", "rating", "slope"];
        $course = compact($dbFields);

        foreach ($dbFields as $field) {
            $snake = Str::snake($field);
            $this->assertEquals($result->$snake, $course[$field]);
        }
    }

    /** @test */
    public function it_compiles_hole_data_into_db_structure() {
        $holes = [];

        for ($i = 1; $i <= 18; $i++) {
            $holes["hole{$i}-par"] = 3;
            $holes["hole{$i}-yardage"] = 123;
        }

        $result = CoursesService::compileHoleDataIntoDbStructure($holes);
        $this->assertEquals($result[1]['par'], $holes['hole1-par']);

        for ($i = 1; $i <= 18; $i++) {
            $this->assertEquals($result[$i]['par'], $holes["hole{$i}-par"]);
            $this->assertEquals($result[$i]['yardage'], $holes["hole{$i}-yardage"]);
        }
    }

    /** @test */
    public function it_create_holes() {
        $courseId = 555;
        $holes = [
            [
                'par' => 3,
                'yardage' => 123
            ],
            [
                'par' => 4,
                'yardage' => 432
            ]
        ];

        $result = CoursesService::createHoles($courseId, $holes);

        $i = 0;
        foreach ($holes as $hole) {
            $this->assertEquals($result->get($i)->number, $i + 1);
            $this->assertEquals($result->get($i)->par, $hole['par']);
            $this->assertEquals($result->get($i)->yardage, $hole['yardage']);
            $this->assertEquals($result->get($i)->course_id, $courseId);

            $i++;
        }
    }
}
