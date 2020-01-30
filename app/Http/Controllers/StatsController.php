<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Services\CoursesService;
use App\Services\StatsService;
use App\Services\UserService;
use App\Stat;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    function __construct() {
    }

    public function get() {
        $user = UserService::getUser();
        $activeGroupId = $user->activeGroup()->id ?? null;

        try {
            $stats = StatsService::compileStatsByGolfer($activeGroupId);
        }
        catch (\Exception $e) {
            $response = [
                'success' => false,
                'error' => $e->getMessage()
            ];

            return response()->json($response, 406);
        }

        return response()->json($stats);
    }
}
