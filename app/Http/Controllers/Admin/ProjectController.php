<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();

        return view('admin.projects.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        
        $request->validate(
            [
                "title" => "required",
                'description' => "required",
                'img' => 'nullable|image'
            ],
            [
                "title.required" => 'il nome é obbligatorio',
                "description.required" => 'la descrizione é obbligatoria',
            ]
        );


        $form_data = $request->all();


        $slug = Project::generateSlug($request->title);
        $form_data['slug'] = $slug;

        if ($request->hasFile('img')) {
            $path = Storage::disk('public')->put('project_images', $request->img);
    
            $form_data['img'] = $path;
        }
        
        $new_project = new Project();
        $new_project->fill( $form_data );
        $new_project->save();
        
        return redirect()->route('admin.projects.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //$projectID = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                "title" => "required",
                'description' => "required",
                'img' => 'nullable|image'
            ],
            [
                "title.required" => 'il nome é obbligatorio',
                "description.required" => 'la descrizione é obbligatoria',
            ]
        );

        if( $project->cover_image ){
            Storage::delete($project->img);
        }

        $form_data = $request->all();
        $project->update($form_data);
        
        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}