<?php

namespace App\Http\Controllers;


use App\Http\Requests\Chat\ChatIndex;
use App\User;

class ChatController extends Controller
{
    public function index(ChatIndex $request)
    {
        $user = map_simple_collection(User::with('roles','permissions')->get());
        $channels = $request->user()->channels;
        return view('chat.index', compact('channels','user'));
    }
}