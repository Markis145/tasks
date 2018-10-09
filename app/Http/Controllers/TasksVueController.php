<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksVueController extends Controller
{
    public function index(){
        return view('tasks_vue');
    }
}
