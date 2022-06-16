@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Payment.update', $model->id]
]) !!}

<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">Edit Payment</h4>
	</div>
	<div class="panel-body">
		<div class="row">

		<div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("p No", "P No:", ["class" => "control-label"]) !!}
                    {!! Form::text("p_no", null, ["class" => "form-control", "Placeholder" => "Enter P No:"]) !!}
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Nature Of Payment", "Nature Of Payment:", ["class" => "control-label"]) !!}
                   <select name="payment_type" id='payment_type' class='form-control'>
                   <option >Select Amount Type</option>
                   <option <?php if($model->payment_type == 'cash'){echo 'selected';} ?>  value='cash' >Cash</option>
                   <option <?php if($model->payment_type == 'deposite'){echo 'selected';} ?>  value='deposite'>Deposite</option>
                   <option <?php if($model->payment_type == 'cheque'){echo 'selected';} ?>  value='cheque'>Cheque</option>
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
					{!! Form::label("Payment Type", "Payment Type:", ["class" => "control-label"]) !!}
                   <select name="amount_type"  class='form-control'>
                   <option >Select Payment Type</option>
                   <option <?php if($model->amount_type == 'penalty'){echo 'selected';} ?>  value='penalty'>Penalty</option>
                   <option <?php if($model->amount_type == 'membershipfees'){echo 'selected';} ?> value='membershipfees'>Membership Fess</option>
                   </select>
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					{!! Form::label("Payment Type", "Payment Type:", ["class" => "control-label"]) !!}
                    {!! Form::text("amounts", null, ["class" => "form-control", "Placeholder" => "Enter Amount:"]) !!}
				</div>
			</div>
            </div>

<div class='row' id='payment_status' style="display: none">
    <div class="col-md-6 col-sm-6">
        <div class="form-group">
            {!! Form::label("Payment Type", "Payment Type:", ["class" => "control-label"]) !!}
           <select name="payment_status" id='payment_statusdata' class='form-control'>
           <option  value='1'>Select Payment Status</option>
           <option  <?php if($model->payment_status == '2'){echo 'selected';} ?> value='2'>Pending</option>
           <option  <?php if($model->payment_status == '1'){echo 'selected';} ?> value='1'>Approved</option>
           <option <?php if($model->payment_status == '0'){echo 'selected';} ?>  value='0'>Bounce</option>

           </select>
        </div>
    </div>
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
    if($('#payment_type').val() == 'cheque'){
        $('#payment_status').show();
    }
 $('#payment_type').change(function(){


if($(this).val() == 'cheque'){
    $('#payment_status').show();
}
if($(this).val() == 'cash'){
    $('#payment_statusdata').find('option:first').attr('selected', 'selected');


    $('#payment_status').hide();
}
if($(this).val() == 'deposite'){
    $('#payment_statusdata').find('option:first').attr('selected', 'selected');

    $('#payment_status').hide();
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

{!! Form::close() !!}

@endsection
