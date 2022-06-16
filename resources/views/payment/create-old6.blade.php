@extends('admin.master')
@section('content')
  @include('flash_msgs')

  <style>
    input[type=date], input[type=time], input[type=datetime-local], input[type=month]{
      line-height: 10px;
    }
  </style>
  
  {!! Form::open([
    'route' => 'Payment.store'
  ]) !!}

    <div class="panel panel-dark">
      <div class="panel-heading">
        <h4 class="panel-title">Create Payment</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-10">
            <div class="form-group">
              {!! Form::label("p_no", "P/PJO/O No:", ["class" => "control-label"]) !!}
              
              @if(isset($member_details))
                @if(!empty($member_details->hasPromotedMember))
                  {{ Form::number('p_no', $member_details->hasPromotedMember->new_p_no, array('class' => 'form-control', 'id' => 'p-no','placeholder' => 'Enter P NO.') ) }}
                @else 
                  {{ Form::number('p_no', $member_details->p_no, array('class' => 'form-control', 'id' => 'p-no','placeholder' => 'Enter P NO.') ) }}
                @endif
              @else
                {{ Form::number('p_no', null, array('class' => 'form-control', 'id' => 'p-no','placeholder' => 'Enter P NO.') ) }}
              @endif

              <input type="hidden" name='status' value='searched'>
            </div>
          </div>
          <div class="col-sm-1">
            <br />
            <div class="form-group">
              <button class='btn btn-info' id='search-btn' style='margin-top: 5px;'><i class='fa fa-search'></i> Search</button>
            </div>
          </div>
        </div>
        @if(isset($member_details))
          <br />
          <div class="row">
            <div class="col-sm-6">
              <table class='table'>
                <tr>
                  <th>P/PJO/O No</th>
                  <td>
                    @if(!empty($member_details->hasPromotedMember))
                      {{ $member_details->hasPromotedMember->new_p_no }}
                    @else
                      {{ $member_details->p_no }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Name</th>
                  <td>{{ $member_details->name??'N/A' }}</td>
                </tr>
                <tr>
                  <th>Rank/Rate</th>
                  <td>
                    @if(!empty($member_details->hasPromotedMember))
                      {{ $member_details->hasPromotedMember->hasPromotedRank->name??'N/A' }}
                    @else
                    {{ $member_details->hasRank->name??'N/A' }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>File Number</th>
                  <td>
                    @if(!empty($member_details->hasPromotedMember))
                      {{ $member_details->hasPromotedMember->file_registration_no??'N/A' }}
                    @else
                    {{ $member_details->reg_file_no??'N/A' }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Cat</th>
                  <td>
                    @if(!empty($member_details->hasPromotedMember))
                      {{ $member_details->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'N/A' }}
                    @else
                      {{ $member_details->hasRank->hasHouseCategory->name }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Member From: </th>
                  <td>
                    <span class='label label-info'>{{ date('d-F-Y', strtotime($member_details->created_at)) }}</span>
                  </td>
                </tr>
                <tr>
                  <th>Membership Status: </th>
                  <td>
                    @if(!empty($member_payment) && $member_payment->is_active==1)
                      <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                    @else
                      <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Active From: </th>
                  <td>
                    @if(isset($is_active) && $is_active->is_active==1)
                      <span class='label label-success'><i class='fa fa-check'></i>{{ date('d-F-Y', strtotime($is_active->created_at)) }}</span>
                    @else
                      <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Registration Fee</th>
                  <td>
                    <span class='label label-primary'>
                    @if(!empty($member_details->hasPromotedMember))
                      {{ number_format($member_details->hasPromotedMember->hasPromotedRank->hasPolicy->hasPaymentPolicy->registration_payment) }}
                    @else
                      {{ number_format($member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment) }}
                    @endif
                    </span>
                  </td>
                </tr>
                <tr>
                  <th>Insurance Amount</th>
                  <td>
                    <span class='label label-primary'>
                    @if(!empty($member_details->hasPromotedMember))
                      {{ number_format($member_details->hasPromotedMember->hasPromotedRank->hasPolicy->hasPaymentPolicy->insurance_payment) }}
                    @else
                      {{ number_format($member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment) }}</span>
                    @endif
                  </td>
                </tr>
                @if($member_details->plotassigned != 1)
                  @if(!empty($member_payment) && $member_payment->is_active==1)
                    <tr>
                      <th>Monthly Install <small>As Per Policy</small>: </th>
                      <th>
                        <span class='label label-success'>
                          @if(!empty($member_details->hasPromotedMember))
                            {{ $member_details->hasPromotedMember->hasPromotedRank->hasPolicy->hasPaymentPolicy->monthly_instalment }}
                          @else 
                            {{ $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment }}
                          @endif
                        </span>
                      </th>
                    </tr>
                  @endif

                  <tr>
                    <th>Payable Payment: </th>
                    <td>
                      <span class='label label-danger'>
                      @if($total_installs_amount < 0 )
                        @if($insurance_difference < 0 )
                          {{ $total_installs_amount+$insurance_difference }}
                        @else
                          {{ $total_installs_amount }}
                        @endif
                      @else 
                        @if($insurance_difference < 0 )
                          {{ $insurance_difference }}
                        @else
                          {{ '0' }}
                        @endif
                      @endif
                      </span>
                    </td>
                  </tr>
                  
                  <tr>
                    <th>Last Submitted Amount</th>
                    <td>
                      <span class='label label-info'>
                        @if(!empty($member_payment))
                          {{ number_format($member_payment->current_paid) }}
                        @else
                          {{ '0' }}
                        @endif
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th>Total Submitted Amount <small>(Exclusive Of Reg & Insur)</small>: </th>
                    <td>
                      <span class='label label-primary'>
                        @if(!empty($member_details))
                          {{ number_format($member_total_paid_amount) }}
                        @else
                          {{ '0' }}
                        @endif
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th>Total Outstanding Install/Dues</th>
                    <td>
                      <span class='label label-danger'>
                      @if($total_installs_amount < 0 )
                        @if($insurance_difference < 0)
                          {{ $total_installs_amount+$insurance_difference }}</span>
                        @else
                          {{ $total_installs_amount }}
                        @endif
                      @else 
                        @if($insurance_difference < 0 )
                          {{ $insurance_difference }}
                        @else
                          {{ '0' }}
                        @endif
                      @endif
                    </td>
                  </tr>
                @else
                  <tr>
                    <th>House Status</th>
                    <th>
                      <span class='label label-success'>House Alloted</span>
                    </th>
                  </tr>
                  <tr>
                    <th>House Price</th>
                    @php 
                      $house_price = $member_payment->hasHouse->amount+$member_payment->hasHouse->hasConstruction->initial_price
                    @endphp
                    <th>
                      <span class='label label-info'>{{ $house_price }}</span>
                    </th>
                  </tr>
                  <tr>
                    <th>Total Dues installment</th>
                    <th>
                      <span class='label label-primary'>{{ $paid_amount-$house_price }}</span>
                    </th>
                  </tr>
                  <tr>
                    <th>Last submitted amount</th>
                    <td>
                      <span class='label label-info'>{{ number_format($total) }}</span>
                    </td>
                  </tr>
                  <tr>
                    <th>Total Submitted Amount</th>
                    <th>
                      <span class='label label-success'>{{ $paid_amount }}</span>
                    </th>
                  </tr>
                @endif
              </table>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                {!! Form::label("Payment Type", "Payment Type:", ["class" => "control-label"]) !!}
                <select name="payment_type" class='form-control payment-type' required>
                  <option selected value=''>Select Payment Type</option>
                  <option value='cash'>Cash</option>
                  <option value='Instrument'>Instrument</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div id="instrument_no"></div>
            <div id="deposit_date"></div>
            <div id="remarks"></div>
          </div>

          <div class='row'>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                {!! Form::label("submit_amount", "Amount:", ["class" => "control-label"]) !!}
                {!! Form::number("submit_amount", null, ["class" => "form-control amountts",  'required' => 'required', 'id' => 'enter-amount', "Placeholder" => "Enter Amount:"]) !!}
                <input type="hidden" name='status' value='New'>
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
        @endif
      </div>
    </div>
  {!! Form::close() !!}

  <script>
    $(document).ready( function(){

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

          html = '<div class="col-sm-4">'+
                    '<div class="form-group">'+
                      '<label for="slip_no" class="control-label">Slip No:</label>'+
                      '<input class="form-control" type="number" name="slip_no" placeholder="Enter slip_no no" />'+
                    '</div>'+
                  '<div>';
          $('#instrument_no').html(html);

          html = '<div class="col-sm-4">'+
                    '<div class="form-group">'+
                      '<label for="deposit_date" class="control-label">Deposit Date:</label>'+
                      '<input class="form-control" type="date" name="deposit_date" />'+
                    '</div>'+
                  '<div>';
          $('#deposit_date').html(html); 

          html = '<div class="col-sm-4">'+
                    '<div class="form-group">'+
                      '<label for="remarks" class="control-label">Remarks:</label>'+
                      '<textarea name="remarks" class="form-control" placeholder="Enter Remarks"></textarea>'
                    '</div>'+
                  '</div>';
          $('#remarks').html(html);
        }
      });
    });
  </script>
@endsection