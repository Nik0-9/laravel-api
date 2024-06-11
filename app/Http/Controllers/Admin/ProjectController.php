<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        $types = Type::all();

        return view('admin.projects.index', compact('projects','types'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        // $form_data = $request->all();
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
       
        if ($request->hasFile('image')) {
            $path = Storage::put('project_images', $request->image);
            $form_data['image'] = $path;
        }
        $newProject = Project::create($form_data);
        if($request->has('technologies')){
            $newProject->technologies()->attach($request->technologies);
        }
        return redirect()->route('admin.projects.show', $newProject->slug)->with('message', $form_data['title'] . ' è stato creato');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        // $form_data = $request->all();
        $form_data = $request->validated();
        if ($project->title !== $form_data['title']) {
            $form_data['slug'] = Project::generateSlug($form_data['title']);
        }
        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::delete($project->image);
            }
            $path = Storage::put('project_images', $request->image);
            $form_data['image'] = $path;
        }
        $project->update($form_data);
        if($request->has('technologies')){
            $project->technologies()->sync($request->technologies);
        }else{
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.projects.show', compact('project'))->with('message', $project->title . ' è stato editato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', $project->title . ' è stato eliminato');
    }
}
