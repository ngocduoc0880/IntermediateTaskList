<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Login
Route::post('login', [AuthController::class, 'login']);

// Group
Route::middleware(['auth:sanctum'])->group(function () {
    // Show List Task
    Route::get('index', [TaskController::class,'index']);
    // Add Task
    Route::post('task', [TaskController::class, 'store']);
    // Delete Task
    Route::delete('task/{task}', [TaskController::class, 'destroy']);
});


