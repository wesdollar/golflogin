<?php

use App\Course;
use App\RoundData;
use App\Services\RoundsService;
use Illuminate\Database\Seeder;

class RoundsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = collect([2, 3, 4, 5])->random();
        $courseId = 17;

        $round = RoundsService::createRound(
            $userId,
            $courseId,
            3,
            "2020-01-31",
            "18",
            "front",
            true,
            false
        );

        $yesNoCollection = collect(["yes", "no", "n/a"]);
        $strokesCollection = collect([3, 4, 5, 6]);
        $puttsCollection = collect([1, 2]);

        $holes = Course::find($courseId)->holes()->get();

        for ($i = 0; $i < 18; $i++) {
            RoundData::create([
                "round_id" => $round,
                "hole_id" => $holes[$i]->id,
                "strokes" => $strokesCollection->random(),
                "putts" => $puttsCollection->random(),
                "penalty_strokes" => 0,
                "gir" => $yesNoCollection->random(),
                "fir" => $yesNoCollection->random(),
                "up_and_down" => $yesNoCollection->random(),
                "sand_save" => $yesNoCollection->random()
            ]);
        }
    }
}
