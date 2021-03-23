<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tasks = new TaskRepository;
        return response()->json($tasks->forUser($request->user()));
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
            $this->validate($request, [
                'name' => 'required|max:255',
            ]);
            $task = new Task;
            $task->user_id = $request->user()->id;
            $task->name = $request->name;
            $task->save();
            return response()->json([
                'status_code' => 200,
                'message' => 'success',
            ]);
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        try{
            if(!$this->authorize('destroy', $task)){
                throw new \Exception('Unauthorized');
            }
            $task->delete();
            return response()->json([
                'status_code' => 200,
                'message' => 'success',
            ]);
        }catch(\Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error',
                'error' => $error,
            ]);
        }
    }
}
