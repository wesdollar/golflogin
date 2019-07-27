<?php

namespace App\Services;

use App\Course;
use App\Hole;

class CoursesService {

    /**
     * @param string $title
     * @param int    $groupId
     * @param string $teeBox
     * @param float $rating
     * @param float $slope
     *
     * @return object
     */
    public static function createCourse(
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

        return Course::create($data);
    }

    public static function compileHoleDataIntoDbStructure($holes) {
        $result = [];

        for ($i = 1; $i <= 18; $i++) {
            $result[$i]['par'] = $holes['hole' . $i . '-par'];
            $result[$i]['yardage'] = $holes['hole' . $i . '-yardage'];
        }

        return $result;
    }

    public static function createHoles(int $courseId, array $holes) {
        $i = 1;

        foreach ($holes as $hole) {
            $data = [
                'course_id' => $courseId,
                'number' => $i,
                'par' => $hole['par'],
                'yardage' => $hole['yardage'],
            ];

            Hole::create($data);
            $i++;
        }

        return Hole::where('course_id', $courseId)->get();
    }
}