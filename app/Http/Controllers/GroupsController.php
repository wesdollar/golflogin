<?php

namespace App\Http\Controllers;

use App\Group;
use App\Services\GroupsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GroupsController extends Controller
{

    public function createGui() {

        return view('back.groups.create');
    }

    public function create(Request $request) {

        $user = Auth::user();

        GroupsService::createGroup($request->input('title'), $user);

        return redirect()->route('dashboard')->with(['alert-success' => 'Your group has been added!']);
    }

    public function switch() {

        $user = Auth::user();

        $data = [
            'groups' => $user->groups()->get()
        ];

        return view('back.groups.switch', $data);
    }

    public function switchGroup(Request $request) {

        $user = Auth::user();

        $group = Group::find($request->route('group_id'));

        if (!$user->hasGroup($group)) {

            return redirect()->route('dashboard')->with(['alert-error' => 'You do not have permission to join that group!']);
        }

        GroupsService::setActiveGroup($user->id, $group->id);

        return redirect()->route('dashboard')->with(['alert-success' => 'You have switched groups!']);
    }

    public function joinOrCreateGroup() {

        return view('auth.createOrJoin');
    }

    public function handleJoinOrCreateGroup(Request $request) {

        $user = Auth::user();
        $message = null;

        if ($request->has('title')) {

            $group = GroupsService::createGwwroup($request->input('title'), $user);

            $message = 'Your group has been created! Your group code is ' . $group->group_code;
        }

        if ($request->has('group_code')) {

            $message = 'You have been added to the group!';
        }

        // todo: error handling / if $message = null

        return redirect()->route('dashboard')->with(['alert-success' => $message]);
    }


}
