<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if($request->query('type')){
            $projects = Project::with('type')->where('type_id', $request->query('type'))->paginate(4);
        }else{
            $projects = Project::with('type')->paginate(4);
        }
        return response()->json([
            'status' => 'success',
            'results' => $projects
        ],200);
    }
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('type','technologies')->first();
        if ($project) {
            return response()->json([
                'status' => 'success',
                'results' => $project
            ],200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error, project not found'
            ],404);
        }
    }
}
