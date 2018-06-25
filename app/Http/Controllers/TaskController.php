<?php

namespace App\Http\Controllers;

use App\Task;
use App\Image;
use App\ImageNote;
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

    /**
     * Add image to task
     * 
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function addImage(Task $task)
    {
        return view("Task.Image.add",compact('task'));
    }

    /**
     * Store added image to task
     * 
     * @param \App\Task $task
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request)
    {
        $data = $request->get('image');
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        $filename = "images/clb".date("Y-m-d_H-i-s", time()).".png";
        file_put_contents($filename, $data); 
        $image = new Image;

        $image->task_id = $request->get('task_id');
        $image->file_path = $filename;
        $image->save();
        return Redirect::route('task.show',$image->task_id);
        
    }

    public function editImage(Image $image)
    {
        return view('Task.Image.Edit',compact('image'));
    }

    public function addNote(Request $request)
    {
        $note = new ImageNote;
        $image_id = Input::get('image_id');
        $note->pos_top = Input::get('pos_top');
        $note->pos_left = Input::get('pos_left');
        $note->width = Input::get('width');
        $note->height = Input::get('height');
        $note->comment = Input::get('comment');
        $note->image_id = $image_id;
        $note->save();
        return Redirect::route('task.image.edit',$image_id);
    }
}
