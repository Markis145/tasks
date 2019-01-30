<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TasksTagsUpdate;
use App\Task;
use App\Tag;
use Illuminate\Http\Request;

class TasksTagsController extends Controller
{


    /**
     * Update the specified resource in storage.
     *
     * @param TasksTagsUpdate $request
     * @param Task $task
     * @return void
     */
    public function update(TasksTagsUpdate $request, Task $task)
    {
//        foreach ($request->tags as $tag) {
//            if (is_int($tag)) {
//                $task->addTag(Tag::find($tag));
//            } else {
//                $newTag = Tag::create([
//                    'color' => 'grey',
//                    'name' => $tag,
//                    'description' => ''
//                ]);
//                $task->addTag($newTag);
//            }
//        }
        $mappedTags = collect($request->tags)->map(function ($tag) {
            if (is_int($tag)) return $tag;
            else {
                return Tag::create([
                    'color' => 'grey',
                    'name' => $tag,
                    'description' => ''
                ])->id;
            }
        });
        $task->addTags(Tag::find($mappedTags));
    }

}
