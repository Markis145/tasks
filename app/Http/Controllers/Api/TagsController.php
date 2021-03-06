<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyTag;
use App\Http\Requests\IndexTags;
use App\Http\Requests\ShowTag;
use App\Http\Requests\StoreTag;
use App\Http\Requests\UpdateTag;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(IndexTags $request)
    {
        return map_collection(Tag::orderBy('created_at','desc')->get());
    }
    public function show(ShowTag $request, Tag $tag) // Route Model Binding
    {
        return $tag->map();
    }
    public function destroy(DestroyTag $request, Tag $tag)
    {
        $tag->delete();
    }
    public function store(StoreTag $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }
    public function update(UpdateTag $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }
}
