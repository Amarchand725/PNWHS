@extends('admin.master')
@section('content')
@include('flash_msgs')


{!! Form::open([
'route' => 'Propertytype.store'
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
					{!! Form::label("propertytype", "Property Type:", ["class" => "control-label"]) !!}
					{!! Form::text("name", null, ["class" => "form-control", "Placeholder" => "Enter Category Property"]) !!}
				</div>
			</div>
           
		
        <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("description", "Description:", ["class" => "control-label"]) !!}
                    {!! Form::textarea("description", null, ["class" => "form-control", "rows" => 3, "Placeholder" => "Enter Description"]) !!}
				</div>
			</div>
            
		</div>
		<br>
		<div class="panel-footer">
			<div class='form-group'>
				{!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
@endsection