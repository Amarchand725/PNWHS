@extends('admin.master')
@section('content')
@include('flash_msgs')
{!! Form::open([
'route' => 'assignedplotsubmit',
'files' => 'true'
]) !!}
<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">Assign Plot</h4>
	</div>
	<div class="panel-body">
		<div class="row">
<!-- <input type="hidden" name='memberid' value='{{ Request::segment(3) }}'/> -->
	
            <div class="col-md-6 col-sm-6">
            <div class="form-group">
					<?php  $plot = DB::table('plots')->where('assign_plot',0)->pluck('plot_no','id'); ?>
                        {!! Form::label("plot", "Plot:", ["class" => "control-label"]) !!}
                        {{ Form::select('plot_id',$plot, null, array('class' => 'form-control plotno','placeholder' => 'Select Plot') ) }}
				</div>
			</div>
            		
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
					<?php  $contractor = DB::table('constructor')->pluck('name','id'); ?>
                    
                        {!! Form::label("Contractor", "Contractor:", ["class" => "control-label"]) !!}
                       <input type="text" name='contractor_id' value='' class='contractor form-control' id='contractor' readonly>
				</div>
			</div>
            </div>
            <div class="row">

         

 <div class="col-md-6 col-sm-6">
            <div class="form-group">
            {!! Form::label("Plot Amount", "Plot Amount:", ["class" => "control-label"]) !!}
            {!! Form::text('plot_amount','',array('class' => 'form-control plot_amount','id' => 'plotamount','readonly' => 'readonly')) !!}
            </div>
            </div>
            <div class="col-md-6 col-sm-6">
            <div class="form-group">
            {!! Form::label("Contractor Amount", "Contractor Amount:", ["class" => "control-label"]) !!}
            {!! Form::text('constructor','',array('class' => 'form-control constructoramount','readonly' => 'readonly')) !!}
            </div>
            </div>
            </div>
            <div class="row">
            
            <div class="col-md-6 col-sm-6">
            <div class="form-group">
            <?php $members =  DB::table('allottee_particulars')->where('id',$memberid)->first(); ?>
            {!! Form::label("Member Name", "Member Name:", ["class" => "control-label"]) !!}
            {!! Form::text('member_id',$members->name,array('class' => 'form-control','readonly' => 'readonly')) !!}
            </div>
            </div>
            <div class="col-md-6 col-sm-6">
            <div class="form-group">
            {!! Form::label("Total Amount", "Total Amount:", ["class" => "control-label"]) !!}
            {!! Form::text('total_amount','',array('class' => 'form-control total_amount','readonly' => 'readonly')) !!}
            </div>
            </div>
            </div>

            <div class='row'>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Membership Fees", "Membership Fees:", ["class" => "control-label"]) !!}
					{!! Form::number("membership_id", $membershippayment, ["class" => "form-control membershipfees", "Placeholder" => "Membership Amount",'readonly' => 'readonly']) !!}
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("pendingamount", "Pending Amount:", ["class" => "control-label"]) !!}
                    {!! Form::text("pendingamount",'', ["class" => "form-control pendingamount", "Placeholder" => "Enter Pending Amount", "required" => "required","readonly"]) !!}
				</div>
			</div>
            </div>
            <div class='row'>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Member Paid Amount", "Member Paid Amount:", ["class" => "control-label"]) !!}
                    {!! Form::number("memberpaidamount",$memberpayment, ["class" => "form-control memberpaidamount", "Placeholder" => "Enter Paid Amount", "required" => "required","readonly" => "readonly"]) !!}
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("posession", "Posession:", ["class" => "control-label"]) !!}
                    {!! Form::text("possession",'', ["class" => "form-control posession", "Placeholder" => "Enter Posession", "required" => "required","readonly"]) !!}
				</div>
			</div>
            </div>
            <div class="row">
            <div class='clearfix'></div>
		<br>
		<div class="panel-footer">
			<div class='form-group'>
				{!! Form::submit('Submit', ['class' => 'btn btn-success btnsubmit']) !!}
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}
<script>
$(".plotno").change(function(){

    $('.total_amount').val('');
    $('#contractor').val('');
    $('.plot_amount').val('');
    $('.constructoramount').val('');
    $('.total_amount').val('');
   
    var selected_value = $(this).val();
      
        var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
       
    //Second ajax request for construction
   
   var datacheck = $.ajax({
       
            type: "POST",
			datatype: 'json',
            url: "<?php echo url('getconstruction'); ?>",
            data: {_token: CSRF_TOKEN,
            selected_value: selected_value
        },
        success: function(data){
            if(data != 0){
                  $('#plotamount').val(data.plotamount);
                $('#contractor').val(data.contractorname);
                var checkdata = $('.constructoramount').val(data.construction_amount);

                
               if(checkdata){
                var plotamount =  $('#plotamount').val();
   var constructionamount = $('.constructoramount').val();
   $('.total_amount').val(parseInt(plotamount)+parseInt(constructionamount));
   var membersjipfees =  $('.membershipfees').val();
    var memberpaidamount = $('.memberpaidamount').val();
    var pendingamount = parseInt(memberpaidamount) - parseInt(membersjipfees);
    var totalamount = $('.total_amount').val();
    var finalpending = parseInt(totalamount)-parseInt(pendingamount);
    $('.pendingamount').val(finalpending);
    $('.posession').val(finalpending);
    
               } 
               $(".btnsubmit").removeAttr("disabled");
                
            }
            else{
                $('.btnsubmit').attr("disabled","disabled");
                alert('Please Assign Plot To Constructions');
                $('.pendingamount').val('');
    $('.posession').val('');
            }
        }
        
    });

    
});
$(".contractor").change(function(){
    var contractor = $(this).val();
    var plotid = $('.plotno').val();
        var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
        $.ajax({
            type: "POST",
			datatype: 'html',
            url: "<?php echo url('getconstructor'); ?>",
            data: {_token: CSRF_TOKEN,
				contractor: contractor,
				plotid: plotid

        },
        success: function(data){
            if(data){
			alert(data);
            }
        }
    });
});


</script>
	
@endsection