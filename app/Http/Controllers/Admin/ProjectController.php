<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator; //Illuminate\Suppor\Facades\Validator
use Illuminate\Validation\Rule;


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
    public function store(Request $request)
    {

        // $form_data = $request->all();
        $form_data = $this->validationStore($request->all());
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
    public function update(Request $request, Project $project)
    {
        // $form_data = $request->all();
        $form_data = $this->validationUpdate($request->all());
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


    public function validationStore($data)
    {
        //dd($data);
        $validator = Validator::make(
            $data,
            [
                'title' => [
                    'required',
                    'max:200',
                    'min:3',
                ],
                'image' => 'nullable|file|size:1024',
                'content' => 'required',
                'type_id' => 'nullable|exists:types,id',
                'technology' => 'nullable|exists:tecnology,id'

            ],
            [
                'title.required' => 'Campo obbligatorio',
                'title.unique' => 'Progetto già esistente',
                'title.max' => 'Il titolo deve avere :max caratteri',
                'title.min' => 'Il titolo deve avere :min caratteri',
                'image.max' => 'L\'immagine non puo\' superare :size kilobytes',
                'content.required' => 'Campo obbligatorio'
                ]
                )->validate();
                return $validator;
            }
            public function validationUpdate($data,Project $project)
            {
                //dd($data);
        $validator = Validator::make(
            $data,
            [
                'title' => [
                    'required',
                    'max:200',
                    'min:3',
                    Rule::unique('projects')->ignore($project->id)
                ],
                'image' => 'nullable|file|size:1024',
                'content' => 'required',
                'type_id' => 'nullable|exists:types,id',
                'technology' => 'nullable'
            ],
            [
                'title.required' => 'Campo obbligatorio',
                'title.unique' => 'Progetto già esistente',
                'title.max' => 'Il titolo deve avere :max caratteri',
                'title.min' => 'Il titolo deve avere :min caratteri',
                'image.max' => 'L\'immagine non puo\' superare :size kilobytes',
                'content.required' => 'Campo obbligatorio'
            ]
        )->validate();
        return $validator;
    }
}
