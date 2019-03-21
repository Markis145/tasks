<?php

namespace App\Http\Controllers;


use App\Http\Requests\ChatIndex;

class ChatController extends Controller
{
    public function index(ChatIndex $request)
    {
        $channels = $request->user()->channels;
        return view('chat.index', compact('channels'));
    }
}