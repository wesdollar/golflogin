<?php

namespace App\Services;

use App\Group;
use App\User;

class GroupsService {

    public static function setActiveGroup($userId, $groupId) {

        $user = User::find($userId);
        $group = Group::find($groupId);

        $user->active_group = $group->id;
        $user->save();

        return true;
    }

    /**
     * @param         $groupTitle
     * @param         $user
     */
    public static function createGroup($groupTitle, $user) {

        $data = [
            'owner_id' => $user->id,
            'title'    => $groupTitle,
            'group_code' => strtoupper(self::generateGroupCode()),
        ];

        $group = Group::create($data);

        $group->users()->save($user);

        GroupsService::setActiveGroup($user->id, $group->id);

        return $group;
    }

    public static function generateGroupCode() {

        $code = str_random(6);

        if (Group::where('group_code', $code)->count() > 0) {

            self::generateGroupCode();
        }
        else {

            return $code;
        }
    }
}