<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;

class TaskController extends Controller
{

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try{
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
        } catch(\Exception $error){
            return response()->json([
                'status_code' => 500,
                'message' => 'Error',
                'error' => $error,
            ]);
        }
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
            $this->authorize('destroy', $task);
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
