<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        return view('Task.Edit',compact('project_id'));
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
            'priority'      => 'required|integer',
            'project_id'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
         if ($validator->fails()) {
            return Redirect::route('task.add',Input::get('project_id'))
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $task = new Task;
            $task->name       = Input::get('name');
            $task->description      = Input::get('description');
            $task->priority = Input::get('priority');
            $task->project_id = Input::get('project_id');
            $task->save();

            // redirect
            Session::flash('message', 'Successfully created task!');
            return Redirect::route('project.show',$task->project_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('Task.Detail',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {   
        $project_id = $task->project_id;
        return view('Task.Edit',compact('task','project_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Task $task)
    {
        $rules = array(
            'name'       => 'required',
            'description'      => 'required',
            'priority'      => 'required|integer',
            'project_id'      => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
         if ($validator->fails()) {
            return Redirect::route('task.add',Input::get('project_id'))
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $task->name       = Input::get('name');
            $task->description      = Input::get('description');
            $task->priority = Input::get('priority');
            $task->project_id = Input::get('project_id');
            $task->save();

            // redirect
            Session::flash('message', 'Successfully created task!');
            return Redirect::route('project.show',$task->project_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $project_id = $task->project_id;
        $task->delete();
        return Redirect::route('project.show',$project_id);
    }
}
