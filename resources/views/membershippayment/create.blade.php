@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'Membershippayment.store'
]) !!}

<style>
	input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
		line-height: 13px;
		line-height: 1.42857143 \0;
	}
</style>

<div class="panel panel-dark">
	<div class="panel-heading">

		<h4 class="panel-title">Membership Payment</h4>
	</div>
	
	<div class="panel-body">
		<div class="row">
        
			<div class="col-sm-4">
				<div class="form-group">
					{!! Form::label("Membership Payment", "Membership Payment:", ["class" => "control-label"]) !!}
					{!! Form::text("mpayment", null, ["class" => "form-control", "Placeholder" => "Enter Membership Payment"]) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("m_rank", "Rank/Rate:", ["class" => "control-label"]) !!}
					{!! Form::select('m_rank', $ranks, null, array('class' => 'form-control', 'placeholder' => 'Select Rank')) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label("Effective Date", "Effective Date:", ["class" => "control-label"]) !!}
					{!! Form::Date("effective_date", null, ["class" => "form-control"]) !!}
				</div>
			</div>
		<br>
        </div>
        <div class='row'>
		<div class="panel-footer">
			<div class='form-group'>
				{!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}

@endsection