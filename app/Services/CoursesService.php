<?php

namespace App\Services;

use App\Course;
use App\Hole;

class CoursesService {
    var $course;
    var $hole;
    
    function __construct() {
        $this->course = new Course();
        $this->hole = new Hole();
    }

    /**
     * @param string $title
     * @param int    $groupId
     * @param string $teeBox
     * @param float $rating
     * @param float $slope
     *
     * @return object
     */
    public function createCourse(
        string $title,
        int $groupId,
        string $teeBox,
        float $rating,
        float $slope
    ) {
        $data = [
            'title' => $title,
            'group_id' => $groupId,
            'tee_box' => $teeBox,
            'rating' => $rating,
            'slope' => $slope
        ];

        return $this->course->create($data);
    }

    public function compileHoleDataIntoDbStructure($pars, $yardages) {
        $result = [];

        for ($i = 0; $i <= 17; $i++) {
            $result[$i]['par'] = $pars[$i];
            $result[$i]['yardage'] = $yardages[$i];
        }

        return $result;
    }

    public function createHoles(int $courseId, array $holes) {
        $holeIndex = 1;

        foreach ($holes as $hole) {
            $data = [
                'course_id' => $courseId,
                'number' => $holeIndex,
                'par' => $hole['par'],
                'yardage' => $hole['yardage'],
            ];

            $this->hole->create($data);
            $holeIndex++;
        }

        return $this->hole->where('course_id', $courseId)->get();
    }
}