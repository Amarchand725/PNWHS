@extends('admin.master')
@section('content')
@include('flash_msgs')

{!! Form::open([
'route' => 'Plot.store',
'files' => 'true',
'class' => 'plot_form'
]) !!}
<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
	
			<a href="" class="minimize">&minus;</a>
		</div>
		<h4 class="panel-title">Create Plot</h4>
	</div>
	
	<div class="panel-body">
		<div class="row">

			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("plotno", "Plot No:", ["class" => "control-label"]) !!}
					{!! Form::text("plot_no", null, ["class" => "form-control plotunique", "Placeholder" => "Enter Plot No", 'required' => 'required']) !!}
				</div>
			</div>
           
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("propertytype", "Property Type", ["class" => "control-label "]) !!}
					<select name="type" id="type" class='form-control select porperty' required>
					<option value=''>Select Type</option>
					<?php
						$property_id= DB::table('property_type')->get(); 
						foreach ($property_id as $key => $type) {
							?>
							<option value='<?= $type->id?>'>{{$type->name}}</option>
							<?php
						}
					?>
					</select>
				</div>
			</div>
            </div>
            <div class="row">
			
			
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Size", "Size", ["class" => "control-label "]) !!}
					<select name="size" id="size" class='form-control select porperty' required>
					<option value=''>Select Size</option>
					
					</select>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Personel Type", "Personel Type", ["class" => "control-label "]) !!}
					<select name="personel_type" id="personel_type" class='form-control select porperty' required>
						<option value=''>Personel Type</option>
						<option value='officer'>Officer</option>
						<option value='Civilian'>Civilian</option>
						<option value='Soldier'>Soldier</option>
					</select>
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
			<div class="form-group">
					{!! Form::label("Phase", "Phase", ["class" => "control-label "]) !!}
					<select name="phase" id="phase" class='form-control select porperty' required>
						<option value=''>Phase Type</option>
						<option value='1'>phase 1</option>
						<option value='2'>phase 2</option>
						<option value='3'>phase 3</option>
						<option value='4'>phase 4</option>
					</select>
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					<?php  $block = DB::table('block')->pluck('name','id'); ?>
                        {!! Form::label("block", "Block:", ["class" => "control-label"]) !!}
                        {{ Form::select('block',$block, null, array('class' => 'form-control','placeholder' => 'Select Block', 'required' => 'required') ) }}
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("amount", "Amount:", ["class" => "control-label"]) !!}
                    {!! Form::text("amount", null, ["class" => "form-control", "Placeholder" => "Enter Amount", 'required' => 'required']) !!}
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
				{!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
<script>
$("#type").change(function(){
    var selected_value = $(this).val();
      
        var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
        $.ajax({
            type: "POST",
			datatype: 'html',
            url: "<?php echo url('plotget'); ?>",
            data: {_token: CSRF_TOKEN,
            selected_value: selected_value
        },
        success: function(data){
            if(data){
				$('#size').html(data);
            }
        }
    });
});
$("#size").change(function(){
    var sizes = $(this).val();
    var plotunique = $('.plotunique').val();
    var property_type = $('.porperty').val();
      
        var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
        $.ajax({
            type: "POST",
			datatype: 'html',
            url: "<?php echo url('checkplotavailable'); ?>",
            data: {_token: CSRF_TOKEN,
				sizes: sizes,
				plotunique: plotunique,
				property_type: property_type,

        },
        success: function(data){
            if(data){
				if(data == 1){
					alert('Plot Was Created Not Again');
					$(this).val('');
					$('.plotunique').val('');
					$('.porperty').val('');

				}
            }
        }
    });
});

	//Client side validation
	$('.plot_form').validate({
        submitHandler: function(form) {
          form.submit();
        }
    });

</script>
	
@endsection