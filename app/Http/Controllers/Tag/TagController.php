<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tag;

class TagController extends Controller
{
    public function addTags(Request $request,$taskId)
    {
       $task = Task::find($taskId);
       $task->tags()->sync($request->tagIds);
       return response()->json(["msg" => "Tags Added"]);
    }
    // Get all Tags
    public function getAllTags()
    {
        $tags = Tag::select("id","tag_name")->get();
         // Transform the tags to the desired format
        $formattedTags = $tags->map(function ($tag) {
            return [
                'value' => $tag->id,
                'label' => $tag->tag_name
            ];
        });
        return response()->json($formattedTags);
    }
    public function getTagsByTask($taskId)
    {
        $tags = Task::with("tags")->get()->find($taskId);
        $responseArray = json_decode($tags, true);
        $tagNameArray = array_column($responseArray['tags'], 'tag_name');
        return response()->json($responseArray["tags"]);
    }
}
