<?php

namespace App\Jobs;

use App\Events\TaskFinishedEvent;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CheckTasksForFinishJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $check_date_time = Carbon::now()->subMinutes(1)->toDateTimeString();
        $need_finish_tasks_query = Task::where('created_at', '<=', $check_date_time);
        if ($need_finish_tasks_query->count()) {
            $need_finish_tasks_query->update(['done' => true]);
            TaskFinishedEvent::dispatch();
        }
    }
}
