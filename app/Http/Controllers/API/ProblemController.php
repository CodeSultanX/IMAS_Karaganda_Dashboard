<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Fillters\ProblemFillter;
use App\Http\Requests\Problem\FillterRequest;
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
        try {
            $data = Problem::getAdminPageProblems();
            return response()->json(ProblemResource::collection($data),200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error : '. $th->getMessage()],500);
        }
    }


    public function store(ProblemRequest $request):JsonResponse
    {
        $data = $request->validated();
        try {
            $problem = Problem::create([
                'title' => $data['title'],
                'level' => $data['level'],
                'color' => $data['color'],
                'project_id' => $data['project_id'],
            ]);
    
    
            ProblemResult::create([
                'user_id' => $data['user_id'],
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
            
            
            if(!empty($data['images'])){
                foreach($data['images'] as $image){
                    $name = md5(Carbon::now() .'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
                    $path = Storage::disk('public')->putFileAs('images',$image,$name);
                    ProblemImage::create([
                        'problem_id' => $problem->id,
                        'url_image' => $path,
                    ]);
                }
            }
           
            return response()->json([
                'message' => 'Successfully created problem ',
                'problem' => $problem,
            ],200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error creating problem : '. $th->getMessage()],500);
        }


    }

    public function update(Problem $problem,ProblemRequest $request)
    {
        try {
            $data = $request->validated();
            $problem->update([
                'title' => $data['title'],
                'level' => $data['level'],
                'color' => $data['color'],
                'project_id' => $data['project_id'],
            ]);
            
            ProblemResult::where('problem_id',$problem->id)->update([
                'result' => $data['result'],
                'status' => $data['status'],
            ]);

            ProblemMap::where('problem_id',$problem->id)->delete();
            foreach($data['regions'] as $region_id){
                ProblemMap::create([
                    'problem_id' => $problem->id,
                    'region_id' => $region_id,
                ]);
            }

            if(isset($data['images'])){
               $currentImages =  $problem->images;
                foreach($currentImages as $currentImage){
                    Storage::disk('public')->delete($currentImage->url_image);
                    $currentImage->delete();
                }
              
                
                foreach($data['images'] as $image){
                    $name = md5(Carbon::now() .'_'.$image->getClientOriginalName()).'.'.$image->getClientOriginalExtension();
                    $path = Storage::disk('public')->putFileAs('images',$image,$name);
                   
                    $problem->images()->create([
                        'url_image' => $path,
                    ]);
                }
            }else{
                $currentImages =  $problem->images;
                foreach($currentImages as $currentImage){
                    Storage::disk('public')->delete($currentImage->url_image);
                    $currentImage->delete();
                }
            }

            return response()->json([
                'message' => 'Successfully updated problem ',
                'problem' => $problem,
            ],200);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error updating problem : '. $th->getMessage()],500);
        }
       
    }

    public function destroy(Problem $problem):JsonResponse
    {
        if($problem->delete()){
            return response()->json(['message' => 'Success deleted problem'],200);
        }else{
            return response()->json(['message' => 'Error deleting problem'],500);
        }
    }

    public function updateVisible(Problem $problem):JsonResponse
    {
        $problem->is_visible = request('is_visible');
        if($problem->save()){
            return response()->json(['message' => 'Success updated visible'],200);
        }else{
            return response()->json(['message' => 'Error updatting visible'],500);
        }
    }

    public function search(ProblemFillter $filter) : JsonResponse
    {
        try {
           $problemIds = Problem::filter($filter)->pluck('id');
           $data = Problem::getAdminPageProblemsWithIds($problemIds);
           return response()->json(ProblemResource::collection($data),200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error : '. $th->getMessage()],500);
        }
       
    }


    public function main()
    {
        


    }
   
}
