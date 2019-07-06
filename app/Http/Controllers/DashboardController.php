<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Services\UserService;

class DashboardController extends Controller
{

    public function index() {

        $user = User::find(Auth::id());
        $daysLeftInTrial = UserService::daysLeftInTrial($user);
        $groups = $user->groups;

        if ($groups->count() < 1) {

            return redirect()->route('w');
        }

        $data = [
            'user' => $user,
            'onTrial' => $user->onTrial(),
            'daysLeftInTrial' => $daysLeftInTrial,
            'groups' => $groups,
        ];

        return view('back.dashboard', $data);
    }
}
