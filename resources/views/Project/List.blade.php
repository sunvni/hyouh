
@extends('layouts.default')
@section('content')

<h1>Project List</h1>
<hr>
<ul class="project-list">
@foreach($projects as $project)
    <li class="project-item">{{$project['name']}}
    <a class="btn btn-default" href="{{ route('project.show',['id'=>$project['id']]) }}">Detail</a>
    <a class="btn btn-default" href="{{ route('project.edit',['id'=>$project['id']]) }}">Edit</a> 
    {{ Form::open(array('route' => ['project.destroy',$project->id], 'class' => 'pull-right', 'method'=>'DELETE')) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
    {{ Form::close() }}
    </li>
@endforeach
</ul>
<hr>
<a href="{{route('project.create')}}" class="btn btn-primary">Create New project</a>
@endsection