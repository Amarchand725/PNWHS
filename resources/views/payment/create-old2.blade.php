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
              {!! Form::label("p No", "P No:", ["class" => "control-label"]) !!}

              @if(isset($member_details))
                {{ Form::number('p_no', $member_details->p_no, array('class' => 'form-control', 'id' => 'p-no','placeholder' => 'Enter P NO.') ) }}
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
                  <th>P.No</th>
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
                    <th>Category</th>
                    <td>
                      @if(!empty($member_details->hasPromotedMember))
                        {{ $member_details->hasPromotedMember->hasPromotedRank->category??'N/A' }}
                      @else
                        {{ $member_details->hasRank->category??'N/A' }}
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
                  <th>Member From: </th>
                  <td>
                    <span class='label label-info'>{{ date('F-Y', strtotime($member_details->created_at)) }}</span>
                  </td>
                </tr>
                <tr>
                  <th>Membership Status: </th>
                  <td>
                    @if(!empty($member_payment))
                      @if($member_payment->is_active==1)
                        <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                      @else
                        <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                      @endif
                    @else
                      <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Active From: </th>
                  <td>
                    @if(!empty($member_payment))
                      @if($member_payment->is_active==1)
                        <span class='label label-success'><i class='fa fa-check'></i>{{ date('F-Y', strtotime($member_payment->created_at)) }}</span>
                      @else
                        <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                      @endif
                    @else
                      <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                    @endif
                  </td>
                </tr>
                @if($member_details->plotassigned != 1)
                  @php $total = 0; @endphp

                  <tr>
                    @if(empty($member_payment))
                      <th>Registration Payment</th>
                      @php $total += $member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment??0; @endphp
                      <td>
                        <span class='label label-primary'>{{ number_format($member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment) }}</span>
                      </td>
                    @else
                      @if($member_payment->is_active==0)
                        <th>Registration Payment</th>
                        @php $total += $member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment; @endphp
                        <td><span class='label label-primary'>{{ number_format($member_details->hasRank->hasPolicy->hasPaymentPolicy->registration_payment) }}</span> </td>
                      @else
                        <th>Total Dues Installs</th>
                        <td>
                          @if($total_installs_amount<0)
                            @php $total += $total_installs_amount; @endphp
                            <span class='label label-success'>{{ number_format($total_installs_amount) }} .PKR</span>
                          @else
                            <span class='label label-danger'>0 .PKR</span>
                          @endif
                        </td>
                      @endif
                    @endif
                  </tr>
                  @if(empty($member_payment))
                    <tr>
                      <th>Insurance Payment</th>
                      <td>
                        @php $total += $member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment; @endphp
                        <span class='label label-primary'>{{ number_format($member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment) }}</span>
                      </td>
                    </tr>
                  @else
                    @if($member_payment->is_active==0)
                      <tr>
                        <th>Insurance Payment</th>
                        <td>
                          @php $total += $member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment; @endphp
                          <span class='label label-primary'>{{ number_format($member_details->hasRank->hasPolicy->hasPaymentPolicy->insurance_payment) }}</span>
                        </td>
                      </tr>
                    @endif
                  @endif

                  @if(!empty($member_payment) && $member_payment->is_active==1)
                    <tr>
                      <th>Monthly Installment<small>as per policy</small> </th>
                      <th>
                        @php $total += $member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment; @endphp
                        <span class='label label-success'>{{ number_format($member_details->hasRank->hasPolicy->hasPaymentPolicy->monthly_instalment) }}</span>
                      </th>
                    </tr>
                  @endif
                  <tr>
                    <th>Total Outstanding Amount: </th>
                    <td>
                      <span class='label label-info'>{{ number_format($total) }}</span>
                    </td>
                  </tr>
                  <tr>
                    <th>Last submitted amount</th>
                    <td>
                      <span class='label label-info'>{{ number_format($member_payment->submitted_amount??0) }}</span>
                    </td>
                  </tr>
                  <tr>
                    <th>Total Submitted Amount: </th>
                    <td>
                      <span class='label label-primary'>{{ number_format($paid_amount )}}</span>
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
                  {{-- <tr>
                    <th>Total Dues installment</th>
                    <th>
                      <span class='label label-primary'>{{ $paid_amount-$house_price }}</span>
                    </th>
                  </tr> --}}
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
                <select name="payment_type" class='form-control payment-type'>
                  <option selected disabled>Select Payment Type</option>
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
                {!! Form::number("submit_amount", null, ["class" => "form-control amountts", 'id' => 'enter-amount', "Placeholder" => "Enter Amount:"]) !!}
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
                      '<input class="form-control" type="date" id="deposit_date" name="deposit_date" />'+
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
                      '<input class="form-control" type="date" id="deposit_date" name="deposit_date" />'+
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
    });

    // $(document).ready(function () {
    //     $('input[id$=date]').datepicker({
    //       dateFormat: 'dd-mm-yy'
    //     });
    //  });
  </script>
@endsection
