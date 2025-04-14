<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Fillters\ProblemFillter;
use App\Http\Resources\Problem\ProblemResource;

class MainController extends Controller
{
    public function index(ProblemFillter $filter):JsonResponse
    {
        try{
            $problemIds = Problem::filter($filter)->pluck('id');
            $data = Problem::getAdminPageProblemsWithIds($problemIds);
            return response()->json(ProblemResource::collection($data),200);            
        }catch(\Throwable $th){
            return response()->json(['error:',$th->getMessage()],500);
        }
    }
}
