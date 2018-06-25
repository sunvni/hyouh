@extends('layouts.default')
@section('content')

<h2>{{$task->name}}</h2>
<hr>
          
<div class="container">
    <div class="row">
        <div class="col-md-6">
            {{ Form::model($task,array('route' => ['task.image.store',$task->id],'class'=>'form')) }}
                <input type="hidden" name="task_id" value="{{$task->id}}">
            <div class="form-group">
                {{ Form::label('name', $task->name) }}
            </div>
            <div class="form-group">
                <input type="hidden" name="image" id="image" value="">
            </div>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
        </div>
    </div>
</div>

<div id="container" class="container">
    <div class="row">
        <div class="col-md-6">
            <div id="image_preview">
                <img id="previewing" src="{{URL::asset('images/noimage.png') }}" />
            </div>
        </div>
    </div>
 </div>  
@endsection

@yield('extends_script')
<script>
document.onpaste = function(event){
    var items = (event.clipboardData || event.originalEvent.clipboardData).items;
    console.log(JSON.stringify(items)); // will give you the mime types
    for (index in items) {
        var item = items[index];
        if (item.kind === 'file') {
        var blob = item.getAsFile();
        var reader = new FileReader();
        var src = '';
        reader.onload = function(event){
                src = event.target.result;
                $("#previewing").attr("src",src)
                $("#image").val(src);
            }; // data url!
        

        reader.readAsDataURL(blob);
        }
    }
}
</script>
@endyield