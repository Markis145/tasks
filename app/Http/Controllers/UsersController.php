<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 31/03/19
 * Time: 17:20
 */

namespace App\Http\Controllers;


use App\Http\Requests\UsersIndex;
use App\User;

class UsersController
{

    public function index(UsersIndex $request)
    {
        $users = User::all();
        return view('users.index', compact(['users']));
    }
}