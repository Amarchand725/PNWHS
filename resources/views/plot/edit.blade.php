@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Plot.update', $model->id],
	'files' => 'true'
]) !!}
<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">Update Plot</h4>
	</div>
	
	<div class="panel-body">
		<div class="row">
        
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("plotno", "Plot No:", ["class" => "control-label"]) !!}
					{!! Form::text("plot_no", null, ["class" => "form-control", "Placeholder" => "Enter Plot No"]) !!}
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					<?php  $property_id = DB::table('property_type')->pluck('name','id'); ?>
					{!! Form::label("propertytype", "Property Type", ["class" => "control-label "]) !!}
					{!! Form::select('type',  $property_id , null, array('class' => 'form-control')) !!}
				</div>
			</div>
            </div>
            <div class="row">
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Size", "Size", ["class" => "control-label "]) !!}
					<select name="size" id="size" class='form-control select porperty' required>
					<option value=''>Select Size</option>
					@foreach($plot_sizes as $size)
						<option value="{{ $size->id }}" {{ $model->size==$size->id?'selected':'' }}>{{ $size->name }}</option>
					@endforeach
					</select>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
			<div class="form-group">
					{!! Form::label("Personel Type", "Personel Type", ["class" => "control-label "]) !!}
					<select name="personel_type" id="personel_type" class='form-control select porperty'>
					<option value=''>Personel Type</option>
					<option <?php if($model->personel_type == 'officer'){echo 'selected';} ?> value='officer'>Officer</option>
					<option <?php if($model->personel_type == 'Civilian'){echo 'selected';} ?> value='Civilian'>Civilian</option>
					<option <?php if($model->personel_type == 'Soldier'){echo 'selected';} ?> value='Soldier'>Soldier</option>

				</div>
			</div>
			<div class='clearfix'></div>
			<div class="col-md-6 col-sm-6">
			<div class="form-group">
					{!! Form::label("Phase", "Phase", ["class" => "control-label "]) !!}
					<select name="phase" id="phase" class='form-control select porperty'>
					<option  value=''>Phase Type</option>
					<option <?php if($model->phase == 1){echo 'selected';} ?> value='1'>phase 1</option>
					<option <?php if($model->phase == 2){echo 'selected';} ?> value='2'>phase 2</option>
					<option <?php if($model->phase == 3){echo 'selected';} ?> value='3'>phase 3</option>
					<option <?php if($model->phase == 4){echo 'selected';} ?> value='4'>phase 4</option>
					</select>
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
			<div class="form-group">
					<?php  $block = DB::table('block')->pluck('name','id'); ?>
                        {!! Form::label("block", "Block:", ["class" => "control-label"]) !!}
                        {{ Form::select('block',$block, null, array('class' => 'form-control') ) }}
				</div>
			</div>
			
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("amount", "Amount:", ["class" => "control-label"]) !!}
                    {!! Form::text("amount", null, ["class" => "form-control", "Placeholder" => "Enter Amount"]) !!}
				</div>
			</div>
		
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("features", "Features:", ["class" => "control-label"]) !!}
                    {!! Form::textarea("features", null, ["class" => "form-control", "placeholder" => "Enter Features", 'cols' => "2" , "rows" => "4"]) !!}
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