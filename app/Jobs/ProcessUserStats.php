<?php

namespace App\Jobs;

use App\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUserStats implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $userId;

    public function __construct(int $userId) {
        $this->userId = $userId;
    }

    /**
     * Update user's stats
     *
     * @return void
     */
    public function handle()
    {
        UserService::updateStats($this->userId);
    }
}
