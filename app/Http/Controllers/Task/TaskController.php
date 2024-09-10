<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $tasks =  Task::where("user_id", "=", $userId)->get();
        foreach($tasks as $task){
          $tagsArray =  $this->getTagsByTask($task->id);
          $task->tags = $tagsArray;
        }
        return response()->json(['tasks' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required',
            'due_date' => 'required|date',
            'user_id'=>'required',
            'description'=>'max:150'
        ]);

        $taskData = [
            'task' => $request->task,
            'due_date' => $request->due_date,
            'status' => false,
            'user_id' => $request->user_id,
            'description'=> $request->description
        ];

        $taskId = Task::create($taskData);
        return response()->json([
            'msg' => 'Task Added',
            'id' => $taskId->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $tagsArray =  $this->getTagsByTask($task->id);
        $task->tags = $tagsArray;
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'task' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|boolean',
            'description'=>'max:150'
        ]);

        $taskData = [
            'task' => $request->task,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'description'=> $request->description
        ];
        Task::find($id)->update($taskData);
        return response()->json([
            'msg' => 'Task Updated',
            'id' => $id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task =  Task::destroy($id);
        if ($task) {
            return response()->json("Task Deleted");
        }
        return response()->json("Failed to Delete", 500);
    }
    /**
     * Change Status of the Task
     *
     */
    public function changeStatus(Request $request, $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = !$task->status;
            $tagsArray =  $this->getTagsByTask($task->id);
            $userId = $request->user()->id;
            $task->save();
            return response()->json(['msg' => 'Task Status Updated']);
        } else {
            return response()->json(['error' => 'Task Not Found'], 500);
        }

        return response()->json([
            'error' => "Failed to Update Task Status",
        ], 500);
    }
     /**
     * Get Tags By Task
     *
     */
    private function getTagsByTask($taskId)
    {
           // Fetch the task with its tags
            $task = Task::with('tags')->find($taskId);
            // Check if task exists
            if (!$task) {
                return ['error' => 'Task not found'];
            }
            // Transform tags to include only ID and name
            $tags = $task->tags->map(function ($tag) {
                return [
                    'value' => $tag->id,
                    'label' => $tag->tag_name
                ];
            })->toArray();
            // Return the transformed tags
            return $tags;
    }
}
