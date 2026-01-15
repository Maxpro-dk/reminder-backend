<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('status')->orderBy('execution_datetime')->get();
        return TaskResource::collection($tasks);
    }

    public function show(Task $task)
    {
        $task->load('status');
        return new TaskResource($task);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'execution_datetime' => 'required|date',
            'status_id' => 'required|exists:statuses,id'
        ], [
            'title.required' => 'The task title is required.',
            'title.string' => 'The task title must be a string.',
            'title.max' => 'The task title must not exceed 255 characters.',
            'execution_datetime.required' => 'The execution date and time is required.',
            'execution_datetime.date' => 'The execution date and time must be a valid date format.',
            'status_id.required' => 'A status must be selected for the task.',
            'status_id.exists' => 'The selected status does not exist.'
        ]);

        $task = Task::create($validated);
        $task->load('status');

        return new TaskResource($task);
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'execution_datetime' => 'sometimes|date',
            'status_id' => 'sometimes|exists:statuses,id'
        ], [
            'title.string' => 'The task title must be a string.',
            'title.max' => 'The task title must not exceed 255 characters.',
            'execution_datetime.date' => 'The execution date and time must be a valid date format.',
            'status_id.exists' => 'The selected status does not exist.'
        ]);

        $task->update($validated);
        $task->load('status');

        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}