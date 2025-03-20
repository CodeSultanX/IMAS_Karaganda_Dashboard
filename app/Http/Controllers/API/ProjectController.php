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
    public function index()
    {   
        $user_id = request('user_id');
        $data = Project::where('user_id',$user_id)->get();
        return response()->json(ProjectResource::collection($data));
    }

    public function store(ProjectRequest $request):JsonResponse
    {
        $faker = Faker::create();
        $data = $request->validated();
        $project = Project::create([
            'name' => $data['name'],
            'f_date' => (new \DateTime($data['f_date']))->format('Y-m-d'),
            's_date' => (new \DateTime($data['s_date']))->format('Y-m-d'),
            'user_id' => $data['user_id'],
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

    public function update(ProjectRequest $request):JsonResponse
    {
        $data = $request->validated();
        $data['f_date'] = (new \DateTime($data['f_date']))->format('Y-m-d');
        $data['s_date'] = (new \DateTime($data['s_date']))->format('Y-m-d');
        $project_id = request('project');
        $project = Project::find($project_id);
        $project->name = $data['name'];
        $project->f_date = $data['f_date'];
        $project->s_date = $data['s_date'];
        if($project->save()){
            return response()->json(['message' => 'Successfully updated project',200]);
        }else{
            return response()->json(['message' => 'Error updating project',500]);
        }
    }

    public function destroy():JsonResponse
    {
        $project_id = request('project');
        $project = Project::find($project_id);
        if($project->delete()){
            return response()->json(['message' => 'Successfully deleted project',200]);
        }else{
            return response()->json(['message' => 'Error deleting project',500]);
        }
    }

}