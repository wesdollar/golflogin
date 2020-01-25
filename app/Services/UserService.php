<?php
namespace App\Services;

use App;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class UserService {
    var $carbon;
    var $user;

    function __construct() {
        $this->carbon = new Carbon();
        $this->user = new User();
    }

    public function daysLeftInTrial(User $user) {
        if ($user->onTrial()) {
            $trialEnds = $this->carbon->parse($user->trial_ends_at);

            return $trialEnds->diffInDays($this->carbon->now());
        }
        else {
            return false;
        }
    }

    public static function getActiveGroupIdFromUser(User $user): int {
        return $user->activeGroup()->id ?: null;
    }

    public static function getActiveGroupId(int $userId): int {
        return User::find($userId)->activeGroup()->id ?: null;
    }

    public static function isOwner(User $user): bool {
        return ($user->role === 'owner') ? true : false;
    }

    public function getUserData(): array {
        try {
            $user = $this->user->find(Auth::id());
        }
        catch (\Exception $e) {
            return null;
        }

        $daysLeftInTrial = $this->daysLeftInTrial($user);
        $groups = $user->groups ?: null;
        $belongsToGroup = ($groups->count()) ? true : false;
        $activeGroupTitle = ($belongsToGroup) ? $user->activeGroup()->title : null;

        return [
            'user' => $user,
            'onTrial' => $user->onTrial(),
            'daysLeftInTrial' => $daysLeftInTrial,
            'belongsToGroup' => $belongsToGroup,
            'groups' => $groups,
            'activeGroupTitle' => $activeGroupTitle,
            'activeGroupId' => $user->activeGroup()->id ?: null,
            'fullName' => "{$user->first_name} {$user->last_name}"
        ];
    }

    public function getUser() {
        return Auth::user();
    }

    public static function getTotalRounds(int $userId): int {
        $totalRounds = User::find($userId)->rounds()->count();

        return $totalRounds;
    }

    public static function getTotalStatsRounds(int $userId): int {
        $totalRounds = User::find($userId)->rounds()->where("stats", true)->count();

        return $totalRounds;
    }

    public static function getTotalHolesPlayed(int $userId): int {
        $totalHoles = User::find($userId)->roundData()->count();

        return $totalHoles;
    }

    public static function getTotalPutts(int $userId): int {
        $totalPutts = User::find($userId)->roundData()->where("stats", true)->sum("putts");

        return $totalPutts;
    }

    public static function getPuttsPerGreen(int $userId): float {
        $totalPutts = self::getTotalPutts($userId);
        $totalHolesPlayed = self::getTotalHolesPlayed($userId);

        return number_format($totalPutts / $totalHolesPlayed, 2);
    }

    public static function getPuttsPerRound(int $userId): float {
        $totalPutts = self::getTotalPutts($userId);
        $totalRoundsPlayed = self::getTotalRounds($userId);

        return number_format($totalPutts / $totalRoundsPlayed, 2);
    }

    public static function getHoleAverageByType(int $userId, int $holeType): float {
        [$totalHolesPlay, $totalStrokes] = self::getHolesPlayedByType($userId, $holeType);

        return number_format($totalStrokes / $totalHolesPlay, 2);
    }

    public static function getParThreeAverage(int $userId): float {
        return self::getHoleAverageByType($userId, 3);
    }

    public static function getParFourAverage(int $userId): float {
        return self::getHoleAverageByType($userId, 4);
    }

    public static function getParFiveAverage(int $userId): float {
        return self::getHoleAverageByType($userId, 5);
    }

    public static function getHolesPlayedByType(int $userId, int $holeType): array {
        $query = DB::table('holes')
            ->join('rounds_data', 'holes.id', '=', 'rounds_data.hole_id')
            ->join('rounds', 'rounds_data.round_id', '=', 'rounds.id')
            ->join('users', 'rounds.user_id',  '=', 'users.id')
            ->select("holes.par", "rounds_data.strokes")
            ->where("users.id", $userId)
            ->where("par", $holeType)
            ->get();

        return [$query->count(), $query->sum("strokes")];
    }

    public static function getScoringAverage(int $userId, string $roundType): float {
        try {
            $query = DB::table('holes')
                ->join('rounds_data', 'holes.id', '=', 'rounds_data.hole_id')
                ->join('rounds', 'rounds_data.round_id', '=', 'rounds.id')
                ->join('users', 'rounds.user_id',  '=', 'users.id')
                ->where("users.id", $userId)
                ->where("rounds.type", $roundType)
                ->select("rounds_data.strokes")
                ->get();

            $totalStrokes = $query->sum("strokes");

            $roundsQuery = DB::table("rounds")
                ->where("user_id", $userId)
                ->where("type", $roundType)
                ->select("id")
                ->get();

            $totalRounds = $roundsQuery->count();

            return number_format($totalStrokes / $totalRounds, 2);
        }
        catch (\Exception $e) {
            return number_format(0, 2);
        }
    }

    public static function getYesNoStat(?int $userId, string $stat): float {
        switch ($stat) {
            case "gir":
                $statRef = "gir";
                break;
            case "fir":
                $statRef = "fir";
                break;
            case "upAndDown":
                $statRef = "up_and_down";
                break;
            case "sandSave":
                $statRef = "sand_save";
                break;
            default:
                $statRef = "gir";
        }

        $statColumn = "rounds_data.$statRef";

        $stats = DB::table('holes')
            ->join('rounds_data', 'holes.id', '=', 'rounds_data.hole_id')
            ->join('rounds', 'rounds_data.round_id', '=', 'rounds.id')
            ->join('users', 'rounds.user_id',  '=', 'users.id')
            ->where("users.id", $userId)
            ->where($statColumn, "!=", "n/a")
            ->where("rounds.stats", true)
            ->select($statColumn)
            ->get();

        $totalPossible = $stats->count();
        $totalHit = 0;

        foreach ($stats as $stat) {
            if ($stat->{$statRef} === "yes") {
                $totalHit++;
            }
        }

        return number_format(($totalHit / $totalPossible) * 100, 2);
    }

    public static function getParOrBetter(int $userId): float {
        $holes = DB::table('holes')
            ->join('rounds_data', 'holes.id', '=', 'rounds_data.hole_id')
            ->join('rounds', 'rounds_data.round_id', '=', 'rounds.id')
            ->join('users', 'rounds.user_id',  '=', 'users.id')
            ->where("users.id", $userId)
            ->where("rounds.stats", true)
            ->select("rounds_data.strokes", "holes.par")
            ->get();

        $holesPlayed = $holes->count();
        $parOrBetter = 0;

        foreach ($holes as $hole) {
            if ($hole->strokes <= $hole->par) {
                $parOrBetter++;
            }
        }

        return number_format(($parOrBetter / $holesPlayed) * 100, 2);
    }
}