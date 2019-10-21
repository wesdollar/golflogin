<?php

namespace Tests\Unit;

use App\Services\RoundsService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoundsServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $frontNine = "front";
    protected $backNine = "back";
    protected $fullRound = "18";
    protected $onlyNine = "9";
    protected $roundId = 4;
    protected $holeId = 5;

    protected $userId = 1;
    protected $courseId = 2;
    protected $groupId = 3;
    protected $datePlayed = "01/01/01";
    protected $roundType = "18";
    protected $startingSide = "back";
    protected $statsRound = true;
    protected $tournamentRound = true;

    protected $insertedRoundId = null;

    /** @test */
    public function it_creates_a_new_round_when_passed_all_parameters()
    {
        $result = RoundsService::createRound(
            $this->userId,
            $this->courseId,
            $this->groupId,
            $this->datePlayed,
            $this->roundType,
            $this->startingSide,
            $this->statsRound,
            $this->tournamentRound
        );

        $this->assertEquals($result->user_id, $this->userId);
        $this->assertEquals($result->course_id, $this->courseId);
        $this->assertEquals($result->group_id, $this->groupId);
        $this->assertEquals($result->date_played, $this->datePlayed);
        $this->assertEquals($result->type, $this->roundType);
        $this->assertEquals($result->starting_side, $this->startingSide);
        $this->assertEquals($result->stats, $this->statsRound);
        $this->assertEquals($result->tournament, $this->tournamentRound);

        $this->insertedRoundId = $result->id;
    }

    /** @test */
    public function gets_round_by_id() {
        $result = RoundsService::getRoundById($this->insertedRoundId);

        dd($result);

        $this->assertEquals($result->user_id, $this->userId);
        $this->assertEquals($result->course_id, $this->courseId);
        $this->assertEquals($result->group_id, $this->groupId);
        $this->assertEquals($result->date_played, $this->datePlayed);
        $this->assertEquals($result->type, $this->roundType);
        $this->assertEquals($result->starting_side, $this->startingSide);
        $this->assertEquals($result->stats, $this->statsRound);
        $this->assertEquals($result->tournament, $this->tournamentRound);
    }

    /** @test */
    public function it_creates_a_new_round_when_relying_on_defaults()
    {
        $result = RoundsService::createRound(
            $this->userId,
            $this->courseId,
            $this->groupId,
            $this->datePlayed,
            $this->roundType
        );

        $this->assertEquals($result->user_id, $this->userId);
        $this->assertEquals($result->course_id, $this->courseId);
        $this->assertEquals($result->group_id, $this->groupId);
        $this->assertEquals($result->date_played, $this->datePlayed);
        $this->assertEquals($result->type, $this->roundType);
        $this->assertEquals($result->starting_side, $this->frontNine);
        $this->assertEquals($result->stats, false);
        $this->assertEquals($result->tournament, false);
    }

    /** @test */
    public function it_saves_individual_hole_to_round_data_when_passed_all_parameters() {
        $yes = "yes";

        $strokes = 4;
        $putts = 2;
        $gir = $yes;
        $fir = $yes;
        $upAndDown = $yes;
        $sandSave = $yes;
        $penaltyStrokes = 2;

        $result = RoundsService::createHoleData(
            $this->roundId,
            $this->holeId,
            $strokes,
            $putts,
            $gir,
            $fir,
            $upAndDown,
            $sandSave,
            $penaltyStrokes
        );

        $this->assertEquals($result->round_id, $this->roundId);
        $this->assertEquals($result->hole_id, $this->holeId);
        $this->assertEquals($result->strokes, $strokes);
        $this->assertEquals($result->putts, $putts);
        $this->assertEquals($result->gir, $gir);
        $this->assertEquals($result->fir, $fir);
        $this->assertEquals($result->up_and_down, $upAndDown);
        $this->assertEquals($result->sand_save, $sandSave);
        $this->assertEquals($result->penalty_strokes, $penaltyStrokes);
    }

    /** @test */
    public function it_saves_individual_hole_to_round_data_when_relying_on_default() {
        $na = "n/a";

        $strokes = 4;
        $putts = 2;
        $gir = $na;
        $fir = $na;
        $upAndDown = $na;
        $sandSave = $na;
        $penaltyStrokes = 0;

        $result = RoundsService::createHoleData(
            $this->roundId,
            $this->holeId,
            $strokes,
            $putts
        );

        $this->assertEquals($result->round_id, $this->roundId);
        $this->assertEquals($result->hole_id, $this->holeId);
        $this->assertEquals($result->strokes, $strokes);
        $this->assertEquals($result->putts, $putts);
        $this->assertEquals($result->gir, $gir);
        $this->assertEquals($result->fir, $fir);
        $this->assertEquals($result->up_and_down, $upAndDown);
        $this->assertEquals($result->sand_save, $sandSave);
        $this->assertEquals($result->penalty_strokes, $penaltyStrokes);
    }
}
