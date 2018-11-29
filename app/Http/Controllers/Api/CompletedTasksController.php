<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 24/10/18
 * Time: 16:43
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\DestroyTaskCompleted;
use App\Http\Requests\StoreTaskCompleted;
use App\Task;
use Illuminate\Http\Request;

class CompletedTasksController
{

    public function destroy(DestroyTaskCompleted $request, Task $task)
    {
        $task->completed=false;
        $task->save();
    }
    public function store(StoreTaskCompleted $request, Task $task)
    {
        $task->completed=true;
        $task->save();
    }
}