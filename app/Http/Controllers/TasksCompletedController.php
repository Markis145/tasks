<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 15/10/18
 * Time: 21:16
 */

namespace App\Http\Controllers;


use App\Task;
use Illuminate\Http\Request;

class TasksCompletedController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $task->completed = true;
        $task->save();
        return redirect('/tasks');
    }
    public function destroy(Request $request, Task $task)
    {
        $task->completed = false;
        $task->save();
        return redirect('/tasks');
    }
}