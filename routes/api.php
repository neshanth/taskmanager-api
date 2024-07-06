<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\Tag\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);
Route::post("/logout", [AuthController::class, 'logout']);
// Tasks
Route::resource("tasks", TaskController::class)->middleware("auth:sanctum");
//Task Status
Route::patch("/tasks/status/{id}", [TaskController::class, 'changeStatus'])->middleware("auth:sanctum");
//Tags
Route::post("/tags/add/{id}",[TagController::class,'addTags'])->middleware("auth:sanctum");
Route::get("/tags",[TagController::class,'getAllTags'])->middleware("auth:sanctum");
Route::get("/tags/{id}",[TagController::class,'getTagsByTask']);