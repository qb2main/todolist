<?php

namespace App\Observers;

use App\Jobs\CheckTasksForFinishJob;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TaskObserver
{
    public function created(Task $task)
    {
        CheckTasksForFinishJob::dispatch()->delay(now()->addSeconds(65));
    }
}
