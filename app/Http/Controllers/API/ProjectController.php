<?php 

namespace App\Http\Controllers\API;


use App\Models\Project;
use Faker\Factory as Faker;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Resources\Project\ProjectResource;
use Illuminate\Http\JsonResponse;
class ProjectController extends Controller
{
    public function index():JsonResponse
    {
        $user_id = request('user_id');
        $data = Project::where('user_id',$user_id)->get();
        return response()->json(ProjectResource::collection($data));
    }

    public function store(ProjectRequest $request):JsonResponse
    {
        $faker = Faker::create();
        $user_id = request()->post('user_id');
        $data = $request->validated();
        $project = Project::create([
            'title' => $data['title'],
            'f_date' => $data['f_date'],
            's_date' => $data['s_date'],
            'user_id' => $user_id,
            'news_smi' => $faker->text(),
            'news_social' => $faker->text(),
            'stat_smi' => $faker->randomNumber(4,false),
            'stat_social' => $faker->randomNumber(4,false),
            'stat_neg' => $faker->randomNumber(4,false),
            'stat_pos' => $faker->randomNumber(4,false),
            'stat_neu' => $faker->randomNumber(4,false),
            'stat_all' => $faker->randomNumber(4,false),
        ]);

        if($project){
            return response()->json([
                'message' => 'Successfully created project',
                'project' => new ProjectResource($project),
                200]);
        }else{
            return response()->json(['message' => 'Error creating project',500]);
        }
    }

}