<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;

class TaskController extends Controller
{
    public function listPublic(Request $request)
    {
        $tasks = Task::paginate();
        return TaskResource::collection($tasks);
    }

    public function listPrivate(Request $request)
    {
        $tasks = Task::where('created_by_user_id', $request->user()->id)->paginate();
        return TaskResource::collection($tasks);
    }

    public function show(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return new TaskResource($task);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'completed' => 'required'
        ]);

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'completed' => $request->completed,
            'created_by_user_id' => $request->user()->id
        ]);

        $task->save();

        return new TaskResource($task);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'completed' => 'required'
        ]);

        $task = Task::findOrFail($request->id);

        $task->fill([
            'name' => $request->name,
            'description' => $request->description,
            'completed' => $request->completed,
        ]);

        $task->save();

        return new TaskResource($task);
    }

    public function delete(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
