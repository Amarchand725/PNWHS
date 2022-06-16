@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['UserType.update', $model->id]
]) !!}

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-close">&times;</a>
			<a href="" class="minimize">&minus;</a>
		</div>
		<h4 class="panel-title">Update User Type</h4>
	</div>
	
	<div class="panel-body">
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
					{!! Form::text("name", null, ["class" => "form-control"]) !!}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label("statuss", "Status:", ["class" => "control-label"]) !!}
					<?php $status = array('1' => 'Active', '0' => 'Inactive');?>
					{!! Form::select('statuss',  $status, null, array('class' => 'form-control')) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label("rights_id", "Rights", ["class" => "control-label"]) !!}
					<?php $rights = DB::table('rights')->get(); 
						$ids = json_decode($model->rights_id);
					?>
					<select name="rights_id[]" class="form-control" multiple="multiple">
						@foreach($rights as $right)
						<option value="{{$right->id}}"@if($ids)  @foreach ($ids as $id) @if ($right->id == $id)selected="selected" @endif @endforeach @endif>{{$right->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					{!! Form::label("description", "Description:", ["class" => "control-label"]) !!}
					{!! Form::textarea("description", null, ["class" => "form-control", "rows" => "4"]) !!}
				</div>
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