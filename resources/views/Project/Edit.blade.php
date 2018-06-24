@extends('layouts.default')
@section('content')
{{ Html::ul($errors->all()) }}

@if(isset($project))

{{ Form::model($project,array('route' => ['project.update','id'=>$project->id],'method'=>'PUT')) }}

@else

{{ Form::open(array('route' => 'project.store')) }}

@endif
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('plan_start', 'Start Date') }}
        {{ Form::text('plan_start', Input::old('plan_start'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('plan_end', 'End Date') }}
        {{ Form::text('plan_end', Input::old('plan_end'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

<a class="btn btn-primary" href="{{route('project.index')}}">Back to List</a>
@endsection