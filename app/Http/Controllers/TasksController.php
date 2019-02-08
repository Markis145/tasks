<?php
namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasks', ['tasks' => $tasks]);
    }
    public function store(Request $request)
    {
        Task::create([
            'name' => $request->name,
            'completed' => false
        ]);

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
        $task->update($request->all());
        $task->save();
        return redirect('/tasks');
    }
    public function edit(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return view('task_edit', ['task' => $task]);
    }
}