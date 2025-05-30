<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskListController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AttachmentController;

Route::apiResource('task-lists', TaskListController::class);
Route::apiResource('tasks', TaskController::class);

Route::post('comments', [CommentController::class, 'store']);
Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

Route::get('getFiles/{list}',[ AttachmentController::class, 'getFiles']);
Route::post('attachments', [AttachmentController::class, 'store']);
Route::delete('attachments/{attachment}', [AttachmentController::class, 'destroy']);
