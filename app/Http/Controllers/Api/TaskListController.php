<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskList::with(['tasks','attachments'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $taskList = TaskList::create($request->only('name'));

        return response()->json($taskList, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($list)
    {

        return Task::where('task_list_id', $list)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $list)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        TaskList::where('id',$list)->update(['name' => $request->name]);

        return response()->json(['success' => 'ok']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($list)
    {
        TaskList::where('id',$list)->delete();

        return response()->json(['success' => 'ok'], 204);
    }
}
