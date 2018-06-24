<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Construct
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('project_manager','=', \Auth::user()->id)->get();
        return view('Project.List',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Project.Edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name'       => 'required',
            'description'      => 'required',
            'plan_start'      => 'required|date',
            'plan_end'      => 'required|date',
        );
        $validator = Validator::make(Input::all(), $rules);
        
         if ($validator->fails()) {
            return Redirect::to('project/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $project = new Project;
            $project->name       = Input::get('name');
            $project->description      = Input::get('description');
            $project->project_manager      = \Auth::user()->id;
            $project->plan_start = Input::get('plan_start');
            $project->plan_end = Input::get('plan_end');
            $project->save();

            // redirect
            Session::flash('message', 'Successfully created project!');
            return Redirect::to('project');
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {        
        return view('Project.detail',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('Project.Edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
         $rules = array(
            'name'       => 'required',
            'description'      => 'required',
            'plan_start'      => 'required|date',
            'plan_end'      => 'required|date',
        );
        $validator = Validator::make(Input::all(), $rules);
        
         if ($validator->fails()) {
            return Redirect::to('project/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
           // $project = Project::find($id);
            $project->name       = Input::get('name');
            $project->description      = Input::get('description');
            $project->project_manager      = \Auth::user()->id;
            $project->plan_start = Input::get('plan_start');
            $project->plan_end = Input::get('plan_end');
            $project->save();

            // redirect
            Session::flash('message', 'Successfully created project!');
            return Redirect::route('project.show',['id'=>$project->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //$project_id = $task->project_id;
        
        $project->delete();
        return Redirect::route('project.index');
    }
}
