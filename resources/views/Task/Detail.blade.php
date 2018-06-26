@extends('layouts.default')
@section('content')

<h2>{{$task->name}}</h2>
<hr>
<p>{{$task->description}}</p>
<br>
<span>{{$task->project->name}}</span>
@foreach ($task->image as $image)
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div id="container">
                <a href="{{route('task.image.edit',[$image->id])}}">
                    <img class="image" src="{{URL::asset($image->file_path) }}" />
                </a>
                @foreach($image->image_note as $item => $note)
                <div class="noted" data-id="{{$note->id}}" style="top: {{$note->pos_top}}px; left: {{$note->pos_left}}px; width: {{$note->width}}px; height: {{$note->height}}px" title="{{$note->comment}}">
                    <span class="tip-num">{{$item+1}}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
<hr>
<a class="btn btn-primary" href="{{route('task.edit',['id'=>$task->id])}}">Edit this shit</a>
<a class="btn btn-primary" href="{{route('task.image.add',['id'=>$task->id])}}">Add image note</a>
<a class="btn btn-primary" href="{{route('project.show',$task->project_id)}}">Back to Project</a>
@endsection


@section('extends_script')
<script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
<script>
   $(document).tooltip({
        position: {
            my: "bottom",
            at: "top-13",
            collision: "flip",
            using: function (position, feedback) {
                $(this).addClass(feedback.vertical)
                    .css(position);
            }
        }
    });
</script>
@stop

@section('extends_style')
<link rel="stylesheet" href="{{URL::asset('css/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
@stop


