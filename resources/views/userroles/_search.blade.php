{!! Form::model($formModel, [
    'route' => 'Userroles.index',
    'method' => 'get'
]) !!}



<div class="row">
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label("role", "Role:", ["class" => "control-label"]) !!}
        {!! Form::text("role", null, ["class" => "form-control"]) !!}</div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div></div>

{!! Form::close() !!}