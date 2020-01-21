<?php

namespace App\Http\Controllers;

use App\Services\UserService;
Use JavaScript;

class DashboardController extends Controller
{
    var $userService;
    
    function __construct() {
        $this->userService = new UserService();
    }

    public function index() {
        $user = $this->userService->getUserData();

        return view('back.dashboard', $user);
    }

    public function react() {
        $userData = $this->userService->getUserData();

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
        $userData = $this->userService->getUserData();

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        JavaScript::put([
            'www' => env('APP_URL'),
            'reactBase' => env('APP_REACT_BASE'),
            'appName' => config('app.name'),
            'user' => $userData,
            'csrfToken' => csrf_token()
        ]);

        return view('back.argon');
    }
}
