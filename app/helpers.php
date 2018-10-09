<?php

use App\Framework\App;
use App\Task;

if (!function_exists('create_example_tasks')){
    function create_example_tasks() {
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);
        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);
        Task::create([
            'name' => 'estudiar PHP',
            'completed' => false
        ]);
    }
}
