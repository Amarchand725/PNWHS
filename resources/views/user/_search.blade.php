{!! Form::model($formModel, [
'route' => 'User.index',
'method' => 'get'
]) !!}


<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			{!! Form::label("email", "Email:", ["class" => "control-label"]) !!}
			{!! Form::text("email", null, ["class" => "form-control"]) !!}
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<?php $type = App\UserType::where('statuss','1')->get(); ?>
			{!! Form::label("user_type", "User Type:", ["class" => "control-label"]) !!}
			<select name="user_type" class="form-control">
				<option>Select Type</option>
				@foreach($type as $value)
				<option value="{{$value->id}}">{{$value->name}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

<br>
<div class="col-md-3">
	<div class='form-group'>
	{!! Form::submit('Search', ['class' => 'btn btn-success','name'=>'submit']) !!}</div>
</div>
<br>
	{!! Form::close() !!}