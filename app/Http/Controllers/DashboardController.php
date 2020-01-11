<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Services\UserService;
Use JavaScript;

class DashboardController extends Controller
{

    public function index() {
        $user = UserService::getUserData();

        return view('back.dashboard', $user);
    }

    public function react() {
        $userData = UserService::getUserData();

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        JavaScript::put([
            'www' => env('APP_URL'),
            'reactBase' => env('APP_REACT_BASE'),
            'appName' => config('app.name'),
            'user' => $userData
        ]);

        return view('back.argon');
    }

    public function argon() {
        $userData = UserService::getUserData();

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        JavaScript::put([
            'www' => env('APP_URL'),
            'reactBase' => env('APP_REACT_BASE'),
            'appName' => config('app.name'),
            'user' => $userData
        ]);

        return view('back.argon');
    }
}
