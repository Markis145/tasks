<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexTags;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(IndexTags $request)
    {
        $tags = map_collection(Tag::orderBy('created_at','desc')->get());
        $uri = '/api/v1/tags';
        return view('tags', compact('tags', 'uri'));

    }
}
