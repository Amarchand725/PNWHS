@extends('admin.master')
@section('content')
@include('flash_msgs')

{!! Form::open([
'route' => 'User.store'
]) !!}

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-close">&times;</a>
			<a href="" class="minimize">&minus;</a>
		</div>
		<h4 class="panel-title">Create Plot</h4>
	</div>
	<div class="panel-body">
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("first_Name", "First Name:", ["class" => "control-label"]) !!}
					{!! Form::text("first_name", null, ["class" => "form-control", "placeholder" => "Enter First Name"]) !!}
					{{ Form::hidden('api_token',str_random(60))}}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("lastName", "Last Name:", ["class" => "control-label"]) !!}
					{!! Form::text("last_name", null, ["class" => "form-control", "placeholder" => "Enter Last Name"]) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("user_name", "Username:", ["class" => "control-label"]) !!}
					{!! Form::text("user_name", null, ["class" => "form-control", "placeholder" => "Enter Username"]) !!}
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("email", "Email:", ["class" => "control-label"]) !!}
					{!! Form::email("email", null, ["class" => "form-control", "placeholder" => "Enter Email"]) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("password", "Password:", ["class" => "control-label" , 'required' => 'required']) !!}
					<input type="password" name="password" class="form-control" placeholder="Enter Password">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				   {!! Form::label("user_type", "User Type:", ["class" => "control-label"]) !!}
					{!! Form::select('user_type',  $superadmin , null, array('class' => 'form-control')) !!}
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("mobile_no", "Mobile No:", ["class" => "control-label"]) !!}
					{!! Form::number("mobile_no", null, ["class" => "form-control", "placeholder" => "Enter Mobile No"]) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("phone", "Phone No:", ["class" => "control-label"]) !!}
					{!! Form::number("phone", null, ["class" => "form-control", "placeholder" => "Enter Phone No"]) !!}
				</div>
			</div>
		
			
		</div>




			<br>	
		<div class="panel-footer">
			{!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
		</div>
	</div>
</div>

{!! Form::close() !!}

<script type="text/javascript">
$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true
	});
</script>

@endsection