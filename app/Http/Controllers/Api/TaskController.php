<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::with(['list'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
            'task_list_id' => 'required|exists:task_lists,id',
        ]);

        $task = Task::create($request->only('title', 'description', 'completed', 'task_list_id'));

        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return $task->load(['list']);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'completed' => 'sometimes|boolean',
            'task_list_id' => 'sometimes|required|exists:task_lists,id',
        ]);

        $task->update($request->only('title', 'description', 'completed', 'task_list_id'));

        return response()->json($task);
    }

    public function destroy($task)
    {
        Task::where('id',$task)->delete();

        return response()->json(['success' => 'ok'], 204);
    }
}
