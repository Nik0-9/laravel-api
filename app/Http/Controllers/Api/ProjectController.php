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
        $projects = Project::paginate(5);
        //dd($projects);
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'results' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => 'Project not found'
            ]);
        }
    }
}
