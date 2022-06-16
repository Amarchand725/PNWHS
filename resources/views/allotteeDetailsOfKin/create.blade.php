@extends('admin.master')
@section('content')
@include('flash_msgs')


{!! Form::open([
'route' => 'AllotteeDetailsOfKin.store'
]) !!}

<div class="col-md-6">
	<div class="form-group">
		{!! Form::label("application_id", "Application_id:", ["class" => "control-label"]) !!}
		{!! Form::text("application_id", null, ["class" => "form-control"]) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label("nex_of_kin", "Nex_of_kin:", ["class" => "control-label"]) !!}
		{!! Form::text("nex_of_kin", null, ["class" => "form-control"]) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label("father_name_address", "Father_name_address:", ["class" => "control-label"]) !!}
		{!! Form::text("father_name_address", null, ["class" => "form-control"]) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label("mother_name_address", "Mother_name_address:", ["class" => "control-label"]) !!}
		{!! Form::text("mother_name_address", null, ["class" => "form-control"]) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label("present_address", "Present_address:", ["class" => "control-label"]) !!}
		{!! Form::text("present_address", null, ["class" => "form-control"]) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label("permanent_address", "Permanent_address:", ["class" => "control-label"]) !!}
		{!! Form::text("permanent_address", null, ["class" => "form-control"]) !!}
	</div>
</div>

{!! Form::close() !!}
@endsection