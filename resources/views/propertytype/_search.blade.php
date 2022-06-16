{!! Form::model($formModel, [
    'route' => 'Propertytype.index',
    'method' => 'get'
]) !!}

<div class="row">
<div class="col-md-4">
    <div class="form-group">
    
        {!! Form::label("Propertytype", "Property Type:", ["class" => "control-label"]) !!}
        {!! Form::text("name", null, ["class" => "form-control"]) !!}</div>
</div>
    

<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div></div>

{!! Form::close() !!}