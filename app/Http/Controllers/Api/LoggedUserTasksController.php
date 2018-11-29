<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyLoggedUserTask;
use App\Http\Requests\IndexLoggedUserTask;
use App\Http\Requests\StoreLoggedUserTask;
use App\Http\Requests\UpdateLoggedUserTask;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserTasksController extends Controller
{
    public function index(IndexLoggedUserTask $request)
    {
        return map_collection($request->user()->tasks);
    }

    public function store(StoreLoggedUserTask $request)
    {
        $task = Task::create($request->only(['name','completed','description','user_id']));
        Auth::user()->addTask($task);
//        $task->refresh();
        return $task;
    }

    public function destroy(DestroyLoggedUserTask $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->delete();
    }

    public function update(UpdateLoggedUserTask $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->completed = $request->completed;
        $task->save();
        return $task;
    }
}
