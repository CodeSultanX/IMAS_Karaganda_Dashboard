<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Fillters\ProblemFillter;
use App\Http\Resources\Problem\ProblemResource;
use App\Models\Project;

class MainController extends Controller
{
    public function index(ProblemFillter $filter):JsonResponse
    {
        try{
            $query = Problem::filter($filter);
            $problemIds = $query->pluck('id');
            $projectIds = $query->pluck('project_id');
            $data = Problem::getAdminPageProblemsWithIds($problemIds);
            $projects_data = Project::whereIn('id',$projectIds)->get();
            return response()->json([
               'problems' =>  ProblemResource::collection($data),
               'projects' => $projects_data],200);            
        }catch(\Throwable $th){
            return response()->json(['error:',$th->getMessage()],500);
        }
    }
}
