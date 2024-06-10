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
        $projects = Project::all();
        //dd($projects);
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }
    
}
