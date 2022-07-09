<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks =  Task::all();
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
        $taskData = [
            'task' => $request->task,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => false
        ];

        Task::create($taskData);
        return response()->json("Task Added");
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
        $taskData = [
            'task' => $request->task,
            'description' => $request->description,
            'due_date' => $request->due_date
        ];
        Task::find($id)->update($taskData);
        return response()->json("Task Updated");
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

    // Change status of checkbox
    public function changeStatus($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = !$task->status;
            $task->save();
            return response()->json("Task Status Updated");
        } else {
            return response()->json("Task Not Found");
        }
    }
}
