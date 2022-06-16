@extends('admin.master')
@section('content')
@include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Rights.update', $model->id]
]) !!}

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-close">&times;</a>
			<a href="" class="minimize">&minus;</a>
		</div>
		<h4 class="panel-title">Update User Rights</h4>
	</div>
	
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				{!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
				{!! Form::text("name", null, ["class" => "form-control"]) !!}
			</div>
			<div class="col-md-6 col-sm-6">
				{!! Form::label("statuss", "Status:", ["class" => "control-label"]) !!}
				{{Form::select('statuss', array('1' => 'Active','0' => 'Inactive'),null,['class' => 'form-control'])}}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6">
				{!! Form::label("description", "Description:", ["class" => "control-label"]) !!}
				{!! Form::textarea("description", null, ["class" => "form-control", "rows" => 2]) !!}
			</div>
		</div>
			<br>
		<div class="panel-footer">
			{!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
		</div>
	</div>
</div>

{!! Form::close() !!}

@endsection