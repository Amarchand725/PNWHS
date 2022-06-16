{!! Form::model($formModel, [
    'route' => 'UserType.index',
    'method' => 'get'
]) !!}


<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<?php $type = App\UserType::all(); ?>
			{!! Form::label("name", "User Type:", ["class" => "control-label"]) !!}
			<select name="name" class="form-control">
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