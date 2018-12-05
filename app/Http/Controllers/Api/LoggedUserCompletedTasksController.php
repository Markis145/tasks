<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 24/10/18
 * Time: 16:43
 */

namespace App\Http\Controllers\Api;

use App\Http\Requests\DestroyLoggedUserTaskCompleted;
use App\Http\Requests\DestroyTaskCompleted;
use App\Http\Requests\StoreLoggedUserTaskCompleted;
use App\Http\Requests\StoreTaskCompleted;
use App\Task;
use Illuminate\Http\Request;

class LoggedUserCompletedTasksController
{

    public function destroy(DestroyLoggedUserTaskCompleted $request, Task $task)
    {
        $task->completed=false;
        $task->save();
    }
    public function store(StoreLoggedUserTaskCompleted $request, Task $task)
    {
        $task->completed=true;
        $task->save();
    }
}