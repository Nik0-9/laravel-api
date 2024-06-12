<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();//paginate(3);
        //dd($projects);
        return response()->json([
            'status' => 'success',
            'results' => $projects
        ],200);
    }
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('type')->first();
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
