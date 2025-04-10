<?php

namespace App\Http\Controllers\API;

use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Problem\TaskRequest;
use App\Http\Resources\Problem\TaskResource;
use App\Models\ProblemNote;

class TaskController extends Controller
{
    public function index():JsonResponse
    {
        try {
            $problems = Problem::with('task')->get();
            return response()->json(TaskResource::collection($problems),200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error : '. $th->getMessage()],500);
        }
    }


    public function store(TaskRequest $request):JsonResponse
    {
        $data = $request->validated();
        try {
            $task = ProblemNote::create([
                'problem_id' => $data['id'],
                'note_type' => $data['type'],
                'content' => $data['content'],
                'status' => 'pending',
                'user_id' => $data['user_id'],
            ]);
           
            return response()->json([
                'message' => 'Successfully created task  ',
                'task' => $task,
            ],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error creating task : '. $th->getMessage()],500);
        }


    }

    public function update(ProblemNote $task,TaskRequest $request)
    {
        try {
            $data = $request->validated();
            $task->update([
                'note_type' => $data['type'],
                'content' => $data['content'],
                'status' => $data['status'],
                'user_id' => $data['user_id'],
            ]);
            
            return response()->json([
                'message' => 'Successfully updated task ',
                'task' => $task,
            ],200);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error updating task : '. $th->getMessage()],500);
        }
       
    }

    public function destroy(ProblemNote $task):JsonResponse
    {
        if($task->delete()){
            return response()->json(['message' => 'Success deleted task'],200);
        }else{
            return response()->json(['message' => 'Error deleting task'],500);
        }
    }
}
