<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;

class UserService {
    public static function daysLeftInTrial($user) {
        if ($user->onTrial()) {
            $trialEnds = Carbon::parse($user->trial_ends_at);
            $daysLeftInTrial = $trialEnds->diffInDays(Carbon::now());

            return $daysLeftInTrial;
        }
        else {
            return false;
        }
    }

    public static function getActiveGroupId($user) {
        return $user->activeGroup()->id ?: null;
    }

    public static function isOwner($user) {
        return ($user->role === 'owner') ? true : false;
    }

    public static function getUserData() {
        try {
            $user = User::find(Auth::id());
        }
        catch (\Exception $e) {
            return false;
        }

        $daysLeftInTrial = self::daysLeftInTrial($user);
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

    public static function getUser() {
        return Auth::user();
    }
}