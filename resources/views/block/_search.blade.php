{!! Form::model($formModel, [
    'route' => 'Block.index',
    'method' => 'get'
]) !!}

<div class="row">
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
        {!! Form::text("name", null, ["class" => "form-control", "placeholder" => "Search By Block Name"]) !!}</div>
</div>
    
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div></div>
{!! Form::close() !!}