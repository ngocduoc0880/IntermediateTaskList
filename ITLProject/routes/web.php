<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

// Add Task
Route::get('index', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    return view('tasks/index', [
        'tasks' => $tasks
    ]);
});
Route::post('task', [TaskController::class, 'store']);

// Delete Task
Route::delete('task/{task}', [TaskController::class, 'delete']);

// Authentication Routes...
Route::get('login', function () {
    return view('auth/login');
});
Route::post('login', [LoginController::class, 'authenticate']);

// Registration Routes...
Route::get('register', function () {
    return view('auth/register');
});
Route::post('register', [RegisterController::class, 'store']);
