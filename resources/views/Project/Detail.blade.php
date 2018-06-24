@extends('layouts.default')
@section('content')
<h2>{{$project->name}}</h2>
<hr>
<p>{{$project->description}}</p>
<span>{{$project->plan_start}}</span>
<span>{{$project->plan_end}}</span>
<br>
<span>{{$project->users->name}}</span>
<hr>
<ul class="task-list">
    @foreach($project->task as $task)
        <li class="task-item">
        {{$task->name}}        
        <a class="btn btn-default" href="{{ route('task.show',['id'=>$task->id]) }}">View</a>
        <a class="btn btn-default" href="{{ route('task.edit',['id'=>$task->id]) }}">Edit</a> 
        {{ Form::open(array('route' => ['task.destroy',$task->id], 'class' => 'pull-right', 'method'=>'DELETE')) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}
        </li>
    @endforeach
</ul>
<a class="btn btn-primary" href="{{route('task.add',['project_id'=>$project->id])}}">Add Task</a>
<hr>
<a class="btn btn-primary" href="{{route('project.edit',['id'=>$project->id])}}">Edit this shit</a>
<a class="btn btn-primary" href="{{route('project.index')}}">Back to List</a>
@endsection