<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Problem\ProblemRequest;
use App\Http\Resources\Problem\ProblemResource;
use App\Models\Problem;
use App\Models\ProblemImage;
use App\Models\ProblemMap;
use App\Models\ProblemResult;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProblemController extends Controller
{
    
    public function index():JsonResponse
    {
        $data =  Problem::getAdminPageProblems();
        return response()->json(ProblemResource::collection($data),200);
    }


    public function store(ProblemRequest $request):JsonResponse
    {
        $data = $request->validated();
        $user_id = request()->post('user_id');

        try {
            $problem = Problem::create([
                'title' => $data['title'],
                'level' => $data['level'],
                'color' => $data['color'],
                'project_id' => $data['project_id'],
            ]);
    
    
            ProblemResult::create([
                'user_id' => $user_id,
                'problem_id' => $problem->id,
                'result' => $data['result'],
                'status' => $data['status'],
            ]);
    
            foreach($data['regions'] as $region_id){
                ProblemMap::create([
                    'problem_id' => $problem->id,
                    'region_id' => $region_id,
                ]);
            }
            
    
            foreach($data['images'] as $image){
                $name = md5(Carbon::now() .'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
                $path = Storage::disk('public')->putFileAs('images',$image,$name);
                ProblemImage::create([
                    'problem_id' => $problem->id,
                    'url_image' => $path,
                ]);
            }

            return response()->json([
                'message' => 'Successfully created problem ',
                'problem' => $problem,
            ],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error creating problem : '. $th->getMessage()],500);
        }

       



    }
}
