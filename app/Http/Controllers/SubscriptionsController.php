<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function createNoCcSubscription() {

        $user = User::find(Auth::id());
        $user->trial_ends_at = now()->addDays(14);
        $user->save();

        return redirect()->route('dashboard');
    }
}
