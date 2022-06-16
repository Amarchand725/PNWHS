{!! Form::model($formModel, [
    'route' => 'Rights.index',
    'method' => 'get'
]) !!}


<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
			{!! Form::text("name", null, ["class" => "form-control"]) !!}
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6">
		<div class='form-group'>
		{!! Form::submit('Search', ['class' => 'btn btn-success','name'=>'submit']) !!}</div>
	</div>
</div>
{!! Form::close() !!}