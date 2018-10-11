<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    public function index(Request $request, Task $task)
    {
        return $task;
    }

    public function show(Request $request, Task $task)
    {
        return $task;
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
    }

    public function store(Request $request)
    {
//        Task::create();
        $task = new Task();
        $task->name = $request->name;
        $task->completed = false;
        $task->save();
        return $task;
    }

    public function edit(Request $request, Task $task)
    {

    }


}
