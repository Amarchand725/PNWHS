
{!! Form::model($formModel, [
    'route' => 'Feedback.index',
    'method' => 'get'
]) !!}

<div class="row">
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label("title", "Title:", ["class" => "control-label"]) !!}
        {!! Form::text("title", null, ["class" => "form-control",'placeholder' => 'Search title']) !!}</div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div></div>

{!! Form::close() !!}
