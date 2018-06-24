@extends('layouts.default')
@section('content')

{{ Html::ul($errors->all()) }}

@if(isset($task->id))

{{ Form::model($task,array('route' => ['task.update','id'=>$task->id],'method'=>'PUT')) }}


@else

{{ Form::model(['project_id'=>$project_id],array('route' => ['task.store'])) }}

@endif
    <div class="form-group">
        {{ Form::label('name', 'Task Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('project_id', 'Project ID') }}
        {{ Form::text('project_id', Input::old('project_id'), array('class' => 'form-control','name' => 'display', 'disabled'=>'disabled')) }}
        {{ Form::text('project_id', Input::old('project_id'), array('class' => 'hide')) }}
    </div>

    <div class="form-group">
        {{ Form::label('priority', 'Priority') }}
        {{ Form::select('priority', array('1' => 'Hight', '2' => 'Medium', '3' => 'Low'), '3',array('class' => 'form-control'))}}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

<a class="btn btn-primary" href="{{route('project.show',$project_id)}}">Back to List</a>
@endsection