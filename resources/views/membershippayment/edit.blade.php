@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Membershippayment.update', $model->id]
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
					{!! Form::label("Membership Payment", "Membership Payment:", ["class" => "control-label"]) !!}
					{!! Form::text("mpayment", null, ["class" => "form-control", "Placeholder" => "Enter Block"]) !!}
				</div>
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