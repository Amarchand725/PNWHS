@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Block.update', $model->id]
]) !!}
<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="minimize">&minus;</a>
		</div>
		<h4 class="panel-title">Property Type</h4>
	</div>
	
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Block", "Block:", ["class" => "control-label"]) !!}
					{!! Form::text("name", null, ["class" => "form-control", "Placeholder" => "Enter Block"]) !!}
				</div>
			</div>
        	<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("description", "Description:", ["class" => "control-label"]) !!}
                    {!! Form::textarea("description", null, ["class" => "form-control", "rows" => 3, "Placeholder" => "Enter Description"]) !!}
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
				{!! Form::label("block_status", "Status:", ["class" => "control-label"]) !!}
				{!! Form::select("status", ['1' => 'Enable', '0' => 'Disable'], null, ["class" => "form-control"]) !!}</div>
			</div>
		</div>
		<br>
		<div class="panel-footer">
			<div class='form-group'>
				{!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection