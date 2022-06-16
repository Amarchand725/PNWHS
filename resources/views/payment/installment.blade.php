@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'Payment.store'
]) !!}

<input type="hidden" name="member_id" value='{{$member_id}}' id="member_id">
<?php
 $possessioncount =  DB::table('payment')->where('plot_no',$registeruser->plot_id)
->where('member_id',$registeruser->member_id)->whereNotNull('possession')->count(); 

?>
<?php $bookingcount =  DB::table('payment')->where('plot_no',$registeruser->plot_id)->where('member_id',$registeruser->member_id)->whereNotNull('booking')->count(); ?>
<?php $monthlyinstallment =  DB::table('payment')->where('plot_no',$registeruser->plot_id)->where('member_id',$registeruser->member_id)->whereNotNull('monthly_installments')->count(); ?>
<?php $halfyearcount  =  DB::table('payment')->where('plot_no',$registeruser->plot_id)->where('member_id',$registeruser->member_id)->whereNotNull('half_yearly_installments')->count(); ?>
<?php $totalcount =  $monthlyinstallment+1; ?>
<?php $halfyearcountplus =  $halfyearcount+1; ?>

<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">Create Payment</h4>
	</div>
	<div class="panel-body">
		<div class="row">

		<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("p No", "P No:", ["class" => "control-label"]) !!}
                    {!! Form::text("p_no", $pno, ["class" => "form-control", "Placeholder" => "Enter P No:" , 'readonly' => 'readonly']) !!}
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Payment Type", "Payment Type:", ["class" => "control-label"]) !!}
                   <select name="payment_type" class='form-control'>
                   <option >Select Amount Type</option>
                   <option value='cash'>Cash</option>
                   <option value='deposite'>Deposite</option>
                   <option value='cheque'>Cheque</option>
                   </select>
				</div>
			</div>
	</div>
    <div class='row'>
    <div class="col-md-6 col-sm-6">
            <div class="form-group">
		{!! Form::label("d_o_b", "Month:", ["class" => "control-label"]) !!}
		<div class="input-group form-control">
        <select class="input-group form-control" id="monthdob" name='month'></select>
		</div>
		</div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="form-group">
		{!! Form::label("d_o_b", "Year:", ["class" => "control-label"]) !!}
		<div class="input-group form-control">
        <select class="input-group form-control" id="yeardob" name='year'></select>
		</div>
		</div>
        </div>
      
    </div>
    <div class='row'>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Payment", "Payment:", ["class" => "control-label"]) !!}
                   <select name="amount_type" class='form-control'>
                   <option >Select Payment Type</option>
                   <option value='penalty'>Penalty</option>
                   <option value='membershipfees'>Membership Fess</option>
                   </select>
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Plot No", "Plot No:", ["class" => "control-label"]) !!}
					<?php $plotname = DB::table('plots')->where('id',$registeruser->plot_id)->value('plot_no'); ?>
                    {!! Form::text("plot_no",$plotname , ["class" => "form-control", "Placeholder" => "Enter Monthly Installment:",'readonly' => 'readonly']) !!}
				</div>
			</div>
            </div>
            <div class='row'>
            
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Amount", "Amount:", ["class" => "control-label"]) !!}
                    {!! Form::text("amounts", null, ["class" => "form-control amountts", "Placeholder" => "Enter Amount:"]) !!}
				</div>
			</div>
            </div>
            <div class='row'>
        
            </div>
			<div class='row'>
			<div class="panel-footer">
			<div class='form-group'>
				{!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
			</div>
		</div>
</div>

            </div>
          
           
		
	</div>
</div>





{!! Form::close() !!}

<script>
$(document).ready(function() {
    $('.possession_cheque').change(function(){
		if(this.checked) {
		var bookingchequw = $('.booking_cheque').val();
		var monthly_instalment = $('.monthly_installment_cheque').val();
		var halfyearly = $('.half_installment_cheque').val();
		var possession_deposit = $(this).val();
		var bookcheque = parseInt(bookingchequw);
		var monthinstallment = parseInt(monthly_instalment);
		var halfyearly = parseInt(halfyearly);
		var possession_deposite = parseInt(possession_deposit);
		var finalcalculation = bookcheque+monthinstallment+halfyearly+possession_deposite;
		$('.amountts').val(finalcalculation);
		}
		else{
			var bookingchequw = $('.booking_cheque').val();
		var monthly_instalment = $('.monthly_installment_cheque').val();
		var halfyearly = $('.half_installment_cheque').val();
		var possession_deposit = 0;
		var bookcheque = parseInt(bookingchequw);
		var monthinstallment = parseInt(monthly_instalment);
		var halfyearly = parseInt(halfyearly);
		var possession_deposite = parseInt(possession_deposit);
		var finalcalculation = bookcheque+monthinstallment+halfyearly+possession_deposite;
		$('.amountts').val(finalcalculation);
		}

	});
    $(".booking_cheque").change(function() {
    if(this.checked) {
       var bookval = $(this).val();
	   $('.amountts').val(bookval);
    }
	else{
		var bookval = 0;
	   $('.amountts').val(bookval);
	}
});
    $(".monthly_installment_cheque").change(function() {
    if(this.checked) {
		var bookingchequw = $('.booking_cheque').val();
		var monthly_instalment = $(this).val();
		var bookcheque = parseInt(bookingchequw);
		var monthinstallment = parseInt(monthly_instalment);
		var finalcalculation = bookcheque+monthinstallment;
	   $('.amountts').val(finalcalculation);
    }
	else{
		var bookingchequw = $('.booking_cheque').val();
		var monthly_instalment = $(this).val();
		var bookcheque = parseInt(bookingchequw);
		var monthinstallment = 0;
		var finalcalculation = bookcheque-monthinstallment;
	   $('.amountts').val(finalcalculation);
	}
});
    $('.half_installment_cheque').change(function() {
	if(this.checked) {
		var bookingchequw = $('.booking_cheque').val();
		var monthly_instalment='';
		if($('.monthly_installment_cheque').checked){
			 monthly_instalment = $('.monthly_installment_cheque').val();
		}
		else{
			monthly_instalment = 0;
		}
		
		var halfyearly = $(this).val();
		var bookcheque = parseInt(bookingchequw);
		var monthinstallment = parseInt(monthly_instalment);
		var halfyearly = parseInt(halfyearly);
		var finalcalculation = bookcheque+monthinstallment+halfyearly;
		$('.amountts').val(finalcalculation);
	}
	else{
		var bookingchequw = $('.booking_cheque').val();
		var monthly_instalment = $('.monthly_installment_cheque').val();
		var halfyearly = 0;
		var bookcheque = parseInt(bookingchequw);
		var monthinstallment = parseInt(monthly_instalment);
		var halfyearly = parseInt(halfyearly);
		var finalcalculation = bookcheque+monthinstallment+halfyearly;
		$('.amountts').val(finalcalculation);
	}
	});
const monthNames = ["January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];
  var qntYears = 74;
  var selectYear = $("#yeardob");
  var selectMonth = $("#monthdob");
  var selectDay = $("#daydob");
  var currentYear = new Date().getFullYear();
  for (var y = 0; y < qntYears; y++){
    let date = new Date(currentYear);
    var yearElem = document.createElement("option");
    yearElem.value = currentYear 
    yearElem.textContent = currentYear;
    selectYear.append(yearElem);
    currentYear--;
  } 

  for (var m = 0; m < 12; m++){
      let monthNum = new Date(2018, m).getMonth()
      let month = monthNames[monthNum];
      var monthElem = document.createElement("option");
      monthElem.value = monthNum; 
      monthElem.textContent = month;
      selectMonth.append(monthElem);
	  
    }

    var d = new Date();
    var month = d.getMonth();
    var year = d.getFullYear();
    var day = d.getDate();

    selectYear.val(year); 
    selectYear.on("change", AdjustDays);  
    selectMonth.val(month);    
    selectMonth.on("change", AdjustDays);

    AdjustDays();
    selectDay.val(day)
    
    function AdjustDays(){
      var year = selectYear.val();
      var month = parseInt(selectMonth.val()) + 1;
      selectDay.empty();
      
      //get the last day, so the number of days in that month
      var days = new Date(year, month, 0).getDate(); 
      
      //lets create the days of that month
      for (var d = 1; d <= days; d++){
        var dayElem = document.createElement("option");
        dayElem.value = d; 
        dayElem.textContent = d;
        selectDay.append(dayElem);
      }
    }    
});
</script>
@endsection