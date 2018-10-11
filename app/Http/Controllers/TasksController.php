<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view ('tasks',['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        Task::create([
           'name' => $request->name,
           'completed' => false
        ]);

        //retornar a /tasks
        return redirect('/tasks');
    }

    public function destroy(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $task->delete();
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $task = Task::findOrFail($request->id);
        $task->name = $request->name;
        $task->completed = false;
        $task->save();
        return redirect('tasks');
    }

    public function edit(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit',[ 'task' => $task]);
//        return view('task_edit',compact('task'));
    }

    public function complete(Request $request)
    {
        $task = Task::findOrFail($request->id);
//        if (!$task->completed = true){
//            $task->completed = true;
//            $task->save();
//        } else {
//            $task->completed = false;
//            $task->save();
//        }
        if (!$task->completed = true) $task->completed = true; $task->save();
//        if (!$task->completed = false) $task->completed = false; $task->save();
        return redirect ('/tasks');
    }

}
