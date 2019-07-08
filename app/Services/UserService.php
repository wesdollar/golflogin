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
        return $user->activeGroup()->first()->id;
    }

    public static function isOwner($user) {
        return ($user->role === 'owner') ? true : false;
    }

    public static function getUserData() {
        $user = User::find(Auth::id());
        $daysLeftInTrial = self::daysLeftInTrial($user);
        $groups = $user->groups;
        $belongsToGroup = ($groups->count()) ? true : false;
        $activeGroupTitle = ($belongsToGroup) ? $user->activeGroup->first()->title : null;

        return [
            'user' => $user,
            'onTrial' => $user->onTrial(),
            'daysLeftInTrial' => $daysLeftInTrial,
            'belongsToGroup' => $belongsToGroup,
            'groups' => $groups,
            'activeGroupTitle' => $activeGroupTitle,
            'fullName' => $user->first_name . ' ' . $user->last_name
        ];
    }
}