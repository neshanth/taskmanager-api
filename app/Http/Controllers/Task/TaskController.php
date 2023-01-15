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
            'description'=>'max:50'
        ]);

        $taskData = [
            'task' => $request->task,
            'due_date' => $request->due_date,
            'status' => false,
            'user_id' => $request->user_id,
            'description'=> $request->description
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
        $request->validate([
            'task' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|boolean',
            'description'=>'max:50'
        ]);

        $taskData = [
            'task' => $request->task,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'description'=> $request->description
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

    // Change status of task
    public function changeStatus(Request $request, $id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->status = !$task->status;
            $userId = $request->user()->id;
            $task->save();
            $completedTasks = DB::table("tasks")
            ->where("user_id", "=", $userId)
            ->where("status", "=", 1)
            ->get();
            $pendingTasks = DB::table("tasks")
            ->where("user_id", "=", $userId)
            ->where("status", "=", 0)
            ->get();
            return response()->json([
                'msg' => 'Task Status Updated',
                'completed' => $completedTasks,
                'pending' => $pendingTasks
            ]);
        } else {
            return response()->json("Task Not Found");
        }
    }
    // Get Task stats
    public function getTaskStats($userId)
    {
        $completedTasksCount = $this->getCompletedTasks($userId);
        $pendingTasksCount = $this->getPendingTasks($userId);
        $totalTasks = $this->getTotalTasks($userId);
        $stats = [
            'completed' => $completedTasksCount,
            'pending' => $pendingTasksCount,
            'tasks' => $totalTasks
        ];

        return response()->json($stats);
    }
    private function getCompletedTasks($userId)
    {
        $completedTasks = DB::table("tasks")
            ->where("user_id", "=", $userId)
            ->where("status", "=", 1)
            ->get();
        return count($completedTasks);
    }
    private function getPendingTasks($userId)
    {
        $pendingTasks = DB::table("tasks")
            ->where("user_id", "=", $userId)
            ->where("status", "=", 0)
            ->get();
        return count($pendingTasks);
    }
    private function getTotalTasks($userId)
    {
        $totalTasks = Task::where("user_id", "=", $userId)->count();
        return $totalTasks;
    }
    public function getRecentTasks($userId)
    {
        $recentTasks = DB::table("tasks")->where("user_id","=", $userId)->latest()->take(5)->get();
        return response()->json(['recent' => $recentTasks]);
    }
}
