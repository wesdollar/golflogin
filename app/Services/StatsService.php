<?php
namespace App\Services;

use App;
use App\Hole;
use App\Stat;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class StatsService {

     public function getGirValue($requestGir): string {
        switch ($requestGir) {
            case true:
                $value = "yes";
                break;
            case false:
                $value = "no";
                break;
            default:
                $value = "n/a";
        }

        return $value;
    }

    public function getFirValue(int $holeId, $value) {
         $par = Hole::find($holeId)->par;

         if ($par === 3) {
             return "n/a";
         }

         if (is_bool($value) && $value) {
             return "yes";
         }
         else {
             return "no";
         }
    }

    public function getYesNoValue($requestValue): string {
        if (is_null($requestValue)) {
            return "n/a";
        }

        return $requestValue;
    }

    public static function getGroupStats(int $groupId): Collection {
        $stats = Stat::where("group_id", $groupId)
            ->join("users", "stats.user_id", "=", "users.id")
            ->select("stats.*", "users.first_name as firstName", "users.last_name as lastName")
            ->get();

        return $stats;
    }

    public static function compileStatsByGolfer(int $groupId): array {
         $stats = self::getGroupStats($groupId);

         $statsArray = [];

         foreach ($stats as $stat) {
             array_push($statsArray, [
                 "golfer" => "$stat->firstName $stat->lastName",
                 "userId" => $stat->user_id,
                 "roundsPlayed" => $stat->rounds_played,
                 "statsRoundsPlayed" => $stat->rounds_played_stats,
                 "scoringAverage18Tournament" => $stat["18_tournament_avg"],
                 "scoringAverage18" => $stat["18_avg"],
                 "scoringAverage9" => $stat["9_avg"],
                 "fir" => $stat->fir,
                 "gir" => $stat->gir,
                 "ppg" => $stat->ppg,
                 "ppr" => $stat->ppr,
                 "parSavesPerRound" => $stat->par_saves_per_round,
                 "parSaves" => $stat->up_and_downs,
                 "sandSaves" => $stat->sand_saves,
                 "parOrBetter" => $stat->par_or_better,
                 "parBusters" => $stat->par_breakers,
                 "par3Avg" => $stat->par_3_avg,
                 "par4Avg" => $stat->par_4_avg,
                 "par5Avg" => $stat->par_5_avg,
                 "holeInOnes" => $stat->hole_in_ones,
                 "doubleEagles" => $stat->double_eagles,
                 "eagles" => $stat->eagles,
                 "birdies" => $stat->birdies,
                 "pars" => $stat->pars,
                 "bogies" => $stat->bogies,
                 "doubleBogies" => $stat->double_bogies,
                 "others" => $stat->three_over_plus,
                 "handicapIndex" => $stat->handicap_index,
             ]);
         }

         return $statsArray;
    }

    public static function groupStatsByKey(int $groupId): array {

    }
}