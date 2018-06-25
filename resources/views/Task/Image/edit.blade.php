@extends('layouts.default')

@section('extends_style')
<link rel="stylesheet" href="{{URL::asset('css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
@stop


@section('content')
<hr>
<a class="btn btn-primary" href="{{route('task.show',$image->task_id)}}">Back to Task</a>
<hr>
<h2>{{__('Edit Image')}}</h2>
<hr>
<div class="row">
        <div class="col-md-12">
            <div id="container">
                <img id="image" src="{{URL::asset($image->file_path) }}" />
                @foreach($image->image_note as $item => $note)
                <div class="noted" style="top: {{$note->pos_top}}px; left: {{$note->pos_left}}px; width: {{$note->width}}px; height: {{$note->height}}px" title="{{$note->comment}}">
                    <span class="tip-num">{{$item+1}}</span>
                </div>
                @endforeach
            </div>
        </div>
</div>

<div>
        <input type="hidden" id="count" value="{{$image->image_note->count()+1}}">
        {{ Form::model(['image_id'=>$image->id],array('route' => ['task.image.addnote',$image->id],'class'=>'form')) }}
            <input type="hidden" name="image_id" value="{{$image->id}}">

             <div class="form-group">
                {{ Form::label('pos_top', 'Top') }}
                {{ Form::text('pos_top', Input::old('pos_top'), array('class' => 'form-control')) }}
                {{ Form::label('pos_left', 'Left') }}
                {{ Form::text('pos_left', Input::old('pos_left'), array('class' => 'form-control')) }}
                {{ Form::label('width', 'Width') }}
                {{ Form::text('width', Input::old('width'), array('class' => 'form-control')) }}
                {{ Form::label('height', 'Height') }}
                {{ Form::text('height', Input::old('height'), array('class' => 'form-control')) }}
            </div>
             <div class="form-group">
                {{ Form::label('comment', 'Comment') }}
                {{ Form::text('comment', Input::old('comment'), array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

  </div>

<hr>

@endsection

@section('extends_script')
<script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
<script src="{{URL::asset('js/main.js')}}"></script>
@stop