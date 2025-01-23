<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskListRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(TaskListRequest $request)
    {
        $sortBy = $request->query('sort_by', 'id');
        $sortDirection = $request->query('sort_direction', 'asc');

        $user = auth()->user();
        $tasks = $user->tasks()->orderBy($sortBy, $sortDirection)->get();

        return response()->json(TaskResource::collection($tasks));
    }

    public function store(TaskStoreRequest $request)
    {
        $user = auth()->user();
        $task = $user->tasks()->create($request->validated());
        return response()->json(TaskResource::make($task));
    }

    public function update(Task $task, TaskUpdateRequest $request)
    {
        $task->update($request->validated());
        return response()->json(TaskResource::make($task));
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}
