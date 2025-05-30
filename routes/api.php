<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskListController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AttachmentController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

Route::apiResource('task-lists', TaskListController::class);
Route::apiResource('tasks', TaskController::class);

Route::post('comments', [CommentController::class, 'store']);
Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

Route::get('getFiles/{list}',[ AttachmentController::class, 'getFiles']);
Route::post('attachments', [AttachmentController::class, 'store']);
Route::delete('attachments/{attachment}', [AttachmentController::class, 'destroy']);

Route::post('/run-migrations', function (Request $request) {
    Artisan::call('migrate', ['--force' => true]);
    return response()->json([
        'message' => 'Migraciones ejecutadas correctamente',
        'output' => Artisan::output(),
    ]);
});
