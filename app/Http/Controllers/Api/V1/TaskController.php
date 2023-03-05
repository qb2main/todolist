<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{


    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }


    /**
     * @param TaskRequest $request
     * @return TaskResource
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());
        if ($task) {
            // make done task that is third up to just created
            $task_for_finish = Task::latest()->skip(2)->first();
            if ($task_for_finish) {
                $task_for_finish->update(['done' => true]);
            }
        }

        return new TaskResource($task);
    }


    /**
     * @param Task $task
     * @return TaskResource
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }


    /**
     * @param TaskRequest $request
     * @param Task $task
     * @return TaskResource
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task);
    }


    /**
     * @param Task $task
     * @return Application|ResponseFactory|Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
