@extends('admin.master')
@section('content')
@include('flash_msgs')

<style>
    input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
    line-height: 10px;
}
</style>
 
{!! Form::open([
    'route' => 'GetProfit.store'
]) !!}

    <div class="panel panel-dark">
      <div class="panel-heading">
        <h4 class="panel-title">Create Returned Refund</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-10">
            <div class="form-group">
                {!! Form::label("p_no", "P/PJO/O No:", ["class" => "control-label"]) !!}
                {!! Form::number("p_no", null, ["class" => "form-control", "placeholder" => "Enter P/PJO/O No"]) !!}
                <input type="hidden" name='status' value='searched'>
            </div>
          </div>
          <div class="col-sm-1">
            <br />
            <div class="form-group">
              <button class='btn btn-info' id='search-btn' style='margin-top: 5px;' name='search'><i class='fa fa-search'></i> Search</button>
            </div>
          </div>
        </div>
        @if(isset($paid_amount))
            <br />
            <input type="hidden" name='status' value='profit'>
            <table class="table">
                <tr>
                    <th>Profit Rate (%) </th>
                    <th>  Member Paid Amount (PKR) </th>
                    <th> Profit Amount (PKR) </th>
                    <th>  Total Amount (PKR) </th>
                </tr>
                <tr>
                    <th>
                        <label for="" class='label label-primary'>{{ $profit_rate->rate }}%</label>
                    </th>
                    <th>
                        <label for="" class='label label-success'>{{ number_format($paid_amount) }}</label>
                    </th>
                    <th>
                        <label for="" class='label label-info'>{{ number_format(($profit_rate->rate/100)*$paid_amount) }}</label>
                    </th>
                    <th>
                        <label for="" class='label label-success'>{{ number_format($paid_amount+($profit_rate->rate/100)*$paid_amount) }}</label>
                    </th>
                </tr>
            </table>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">P/PJO/O No</label>
                        <input type="text" readonly class="form-control" value="{{ $p_no }}" name="p_no" id="">
                        <input type="hidden" class="form-control" value="{{ $profit_rate->id }}" name="profit_rate_id" id="">
                        <input type="hidden" class="form-control" value="{{ ($profit_rate->rate/100)*$paid_amount }}" name="profit_amount" id="">
                        <input type="hidden" class="form-control" value="{{ $paid_amount }}" name="submitted_amount" id="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Refundable Amount</label>
                        <input type="text" readonly class="form-control" value="{{ number_format($paid_amount+($profit_rate->rate/100)*$paid_amount) }}" name="refundable_amount" id="">
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("Payment Type", "Payment Type:", ["class" => "control-label"]) !!}
                        <select name="payment_type" class='form-control payment-type'>
                            <option selected disabled>Select Payment Type</option>
                            <option value='cash'>Cash</option>
                            <option value='Instrument'>Instrument</option>
                        </select>
                    </div>
                </div> -->
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("reciever_name", "Reciever's Name:", ["class" => "control-label"]) !!}
                        <input type="text" class="form-control" value="" placeholder="Enter Reciever's Name" name="reciever_name" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("reciver_relation", "Reciever's Relation:", ["class" => "control-label"]) !!}
                        <input type="text" class="form-control" value="" placeholder="Enter Reciever's Relation" name="reciver_cnic" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("reciver_cnic", "Reciever's CNIC:", ["class" => "control-label"]) !!}
                        <input type="text" class="form-control" value="" placeholder="Enter Reciever's CNIC" name="reciver_cnic" id="">
                    </div>
                </div> -->
            </div>
            <!-- <div class="row">
                <div id="instrument_no"></div>
                <div id="deposit_date"></div>
                <div id="remarks"></div>
            </div> -->

            <div class='row'>
                <div class="panel-footer">
                <div class='form-group'>
                    {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                </div>
                </div>
            </div>
        @endif
    </div>
<!-- 
    <script>
        $('.payment-type').on('change', function(){
            var payment_type = $(this).val();
            var html = '';
            if(payment_type =='Instrument'){
            html = '<div class="col-sm-4">'+
                        '<div class="form-group">'+
                        '<label for="instrument_no" class="control-label">Instrument No:</label>'+
                        '<input class="form-control" type="number" name="instrument_no" placeholder="Enter instrument no" />'+
                        '</div>'+
                    '<div>';
            $('#instrument_no').html(html);

            html = '<div class="col-sm-4">'+
                        '<div class="form-group">'+
                        '<label for="deposit_date" class="control-label">Deposit Date:</label>'+
                        '<input class="form-control" type="date" name="deposit_date" />'+
                        '</div>'+
                    '</div>';
                $('#deposit_date').html(html); 

                html = '<div class="col-sm-4">'+
                        '<div class="form-group">'+
                            '<label for="remarks" class="control-label">Remarks:</label>'+
                            '<textarea name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>'
                        '</div>'+
                        '</div>';
                $('#remarks').html(html);
            }else{
            $('#instrument_no').html('');
            $('#deposit_date').html(''); 
            $('#remarks').html('');

            html = '<div class="col-sm-6">'+
                        '<div class="form-group">'+
                        '<label for="deposit_date" class="control-label">Deposit Date:</label>'+
                        '<input class="form-control" type="date" name="deposit_date" />'+
                        '</div>'+
                    '<div>';
            $('#deposit_date').html(html); 

            html = '<div class="col-sm-6">'+
                        '<div class="form-group">'+
                        '<label for="remarks" class="control-label">Remarks:</label>'+
                        '<textarea name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>'
                        '</div>'+
                    '</div>';
            $('#remarks').html(html);
            }
        });
    </script> -->

{!! Form::close() !!}

@endsection