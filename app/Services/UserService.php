<?php
namespace App\Services;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService {
    var $carbon;
    var $user;

    function __construct() {
        $this->carbon = new Carbon();
        $this->user = new User();
    }

    public function daysLeftInTrial($user) {
        if ($user->onTrial()) {
            $trialEnds = $this->carbon->parse($user->trial_ends_at);

            return $trialEnds->diffInDays($this->carbon->now());
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

    public function getUserData() {
        try {
            $user = $this->user->find(Auth::id());
        }
        catch (\Exception $e) {
            return false;
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
}