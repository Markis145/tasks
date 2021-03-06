<?php
namespace App\Http\Controllers\Api;
use App\Events\TaskDelete;
use App\Events\TaskModify;
use App\Events\TaskStore;
use App\Http\Requests\DestroyTask;
use App\Http\Requests\IndexTask;
use App\Http\Requests\ShowTask;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use Illuminate\Support\Facades\Auth;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TasksController extends Controller
{

    public function index(IndexTask $request)
    {
        return map_collection(Task::orderBy('created_at','desc')->get());
    }
    public function show(ShowTask $request, Task $task) // Route Model Binding
    {
        return $task->map();
    }
    public function destroy(DestroyTask $request, Task $task)
    {
        $task->delete();
//        event(new TaskDelete($task,Auth::user()));
    }
    public function store(StoreTask $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        $task->save();
        event(new TaskStore($task,Auth::user()));
        return $task->map();

    }
    public function update(UpdateTask $request, Task $task)
    {
        $task_old=$task;
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        $task->save();
        event(new TaskModify($task_old,$task,Auth::user()));
        return $task->map();
    }
}