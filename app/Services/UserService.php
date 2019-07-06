<?php

namespace App\Services;

use App\Group;
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
}