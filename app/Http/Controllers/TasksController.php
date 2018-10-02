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
        //Models -> eloquent -> ORM (Hibernate de java)
//        Task::find($request->id);
//        if (!Task::find($request->id)) return response (404,'No ho he provat');
        $task = Task::findOrFail($request->id);
        $task->name = $request->name;
        $task->completed = true;
        $task->save();
        return redirect('tasks');
    }

    public function edit(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit',[ 'task' => $task]);
//        return view('task_edit',compact('task'));
    }


}

//class CompletedTaskController {
//    //complete
//    public function store()
//    {
//
//    }
//
//    //uncomplete
//    public function delete()
//    {
//
//    }
//}
