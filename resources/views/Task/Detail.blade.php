@extends('layouts.default')
@section('content')

<h2>{{$task->name}}</h2>
<hr>
<p>{{$task->description}}</p>
<br>
<span>{{$task->project->name}}</span>
<hr>
<a class="btn btn-primary" href="{{route('task.edit',['id'=>$task->id])}}">Edit this shit</a>
<a class="btn btn-primary" href="{{route('project.show',$task->project_id)}}">Back to Project</a>
@endsection