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

    public static function getActiveGroupId(User $user): int {
        return $user->activeGroup()->id ?: null;
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

    public static function getTotalRounds(?int $userId): int {
        if (App::environment('local') && is_null($userId)) {
            $userId = 1;
        }

        $totalRounds = User::find($userId)->rounds()->count();

        return $totalRounds;
    }

    public static function getTotalStatsRounds(?int $userId): int {
        if (App::environment('local') && is_null($userId)) {
            $userId = 1;
        }

        $totalRounds = User::find($userId)->rounds()->where("stats", true)->count();

        return $totalRounds;
    }

    public static function getTotalHolesPlayed(?int $userId): int {
        if (App::environment('local') && is_null($userId)) {
            $userId = 1;
        }

        $totalHoles = User::find($userId)->roundData()->count();

        return $totalHoles;
    }

    public static function getTotalPutts(?int $userId): int {
        if (App::environment('local') && is_null($userId)) {
            $userId = 1;
        }

        $totalPutts = User::find($userId)->roundData()->sum("putts");

        return $totalPutts;
    }

    public static function getPuttsPerGreen(?int $userId): float {
        if (App::environment('local') && is_null($userId)) {
            $userId = 1;
        }

        $totalPutts = self::getTotalPutts($userId);
        $totalHolesPlayed = self::getTotalHolesPlayed($userId);

        return $totalPutts / $totalHolesPlayed;
    }

    public static function getPuttsPerRound(?int $userId): float {
        if (App::environment('local') && is_null($userId)) {
            $userId = 1;
        }

        $totalPutts = self::getTotalPutts($userId);
        $totalRoundsPlayed = self::getTotalRounds($userId);

        return $totalPutts / $totalRoundsPlayed;
    }

    public static function getParThreeAverage(?int $userId): float {
        if (App::environment('local') && is_null($userId)) {
            $userId = 1;
        }

        [$totalHolesPlay, $totalStrokes] = self::getHolesPlayedByType($userId, 3);

        return $totalStrokes / $totalHolesPlay;
    }

    public static function getHolesPlayedByType(int $userId, int $holeType): array {
        $query = DB::table('holes')
            ->join('rounds_data', 'holes.id', '=', 'rounds_data.hole_id')
            ->join('rounds', 'rounds_data.round_id', '=', 'rounds.id')
            ->join('users', 'rounds.user_id',  '=', 'users.id')
            ->select("holes.par")
            ->where("users.id", $userId)
            ->where("par", $holeType)
            ->get();

        return [$query->count(), $query->sum("par")];
    }
}