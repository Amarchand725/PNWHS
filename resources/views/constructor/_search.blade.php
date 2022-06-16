{!! Form::model($formModel, [
    'route' => 'Contractor.index',
    'method' => 'get'
]) !!}



<div class="row">
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
        {!! Form::text("name", null, ["class" => "form-control"]) !!}</div>
</div>
    <div class="col-md-4">

        <div class="form-group">
            {!! Form::label("email", "Email:", ["class" => "control-label"]) !!}
            {!! Form::text("email", null, ["class" => "form-control"]) !!}</div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div></div>

{!! Form::close() !!}


