<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <style>
    input[type=date], input[type=time], input[type=datetime-local], input[type=month]{
      line-height: 10px;
    }
  </style>
  
  <?php echo Form::open([
    'route' => 'Payment.store'
  ]); ?>


    <div class="panel panel-dark">
      <div class="panel-heading">
        <h4 class="panel-title">Create Payment</h4>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-10">
            <div class="form-group">
              <?php echo Form::label("p_no", "P/PJO/O No:", ["class" => "control-label"]); ?>

              
              <?php if(isset($member_details)): ?>
                <?php echo e(Form::number('p_no', $member_details->hasPromotedMember->new_p_no, array('class' => 'form-control', 'id' => 'p-no','placeholder' => 'Enter P NO.') )); ?>

              <?php else: ?>
                <?php echo e(Form::number('p_no', null, array('class' => 'form-control', 'id' => 'p-no','placeholder' => 'Enter P NO.') )); ?>

              <?php endif; ?>

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
        <?php if(isset($member_details)): ?>
          <br />
          <div class="row">
            <div class="col-sm-6">
              <table class='table'>
                <tr>
                  <th>P/PJO/O No</th>
                  <td>
                    <?php echo e($member_details->hasPromotedMember->new_p_no); ?>

                  </td>
                </tr>
                <tr>
                  <th>Name</th>
                  <td><?php echo e($member_details->name??'N/A'); ?></td>
                </tr>
                <tr>
                  <th>Rank/Rate</th>
                  <td>
                    <?php echo e($member_details->hasPromotedMember->hasPromotedRank->name??'N/A'); ?>

                  </td>
                </tr>
                <tr>
                  <th>File Number</th>
                  <td>
                    <?php echo e($member_details->hasPromotedMember->file_registration_no??'N/A'); ?>

                  </td>
                </tr>
                <tr>
                  <th>Cat</th>
                  <td>
                    <?php echo e($member_details->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'N/A'); ?>

                  </td>
                </tr>
                <tr>
                  <th>Member From: </th>
                  <td>
                    <span class='label label-info'><?php echo e(date('d-F-Y', strtotime($member_details->created_at))); ?></span>
                  </td>
                </tr>
                <tr>
                  <th>Membership Status: </th>
                  <td>
                    <?php if($member_details->payment_status==1): ?>
                      <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                    <?php else: ?>
                      <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <th>Active From: </th>
                  <td>
                    <?php if($member_details->payment_status==1): ?>
                      <span class='label label-success'><i class='fa fa-check'></i><?php echo e(date('d-F-Y', strtotime($member_details->active_date))); ?></span>
                    <?php else: ?>
                      <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <tr>
                  <th>Registration Fee</th>
                  <td>
                    <span class='label label-primary'>
                    <?php echo e(number_format($policy->hasPaymentPolicy->registration_payment)); ?>

                    </span>
                  </td>
                </tr>
                <tr>
                  <th>Insurance Amount</th>
                  <td>
                    <span class='label label-primary'>
                      <?php echo e(number_format($policy->hasPaymentPolicy->insurance_payment)); ?>

                  </td>
                </tr>
                <?php if($member_details->plotassigned != 1): ?>
                  <?php if($member_details->payment_status==1): ?>
                    <tr>
                      <th>Monthly Install <small>As Per Policy</small>: </th>
                      <th>
                        <span class='label label-success'>
                          <?php echo e(number_format($current_monthly_policy->hasPaymentPolicy->monthly_instalment)); ?>

                        </span>
                      </th>
                    </tr>
                  <?php endif; ?>

                  <tr>
                    <th>Payable Payment: </th>
                    <td>
                      <span class='label label-danger'>
                        <?php if($member_details->payment_status==1): ?>
                            <?php echo e(number_format($total_payabale)); ?>

                        <?php else: ?>
                          <?php echo e($policy->payable_amount-$reg_insurance_total_paid); ?>

                        <?php endif; ?>
                      </span>
                    </td>
                  </tr>
                  
                  <tr>
                    <th>Last Submitted Amount</th>
                    <td>
                      <span class='label label-info'>
                        <?php if(!empty($last_trasaction)): ?>
                          <?php echo e(number_format($last_trasaction->current_paid)); ?>

                        <?php else: ?>
                          <?php echo e('0'); ?>

                        <?php endif; ?>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th>Total Submitted Amount <small>(Exclusive Of Reg & Insur)</small>: </th>
                    <td>
                      <span class='label label-primary'>
                        <?php if(!empty($last_trasaction)): ?>
                          <?php if($member_details->payment_status == 1): ?>
                            <?php echo e(number_format($total_monthly_paid)); ?>

                          <?php else: ?>
                            <?php echo e(number_format($reg_insurance_total_paid)); ?>

                          <?php endif; ?>
                        <?php else: ?>
                          <?php echo e('0'); ?>

                        <?php endif; ?>
                      </span>
                    </td>
                  </tr>
                <?php else: ?>
                  <tr>
                    <th>House Status</th>
                    <th>
                      <span class='label label-success'>House Alloted</span>
                    </th>
                  </tr>
                  <tr>
                    <th>House Price</th>
                    <?php 
                      $house_price = $member_payment->hasHouse->amount+$member_payment->hasHouse->hasConstruction->initial_price
                    ?>
                    <th>
                      <span class='label label-info'><?php echo e($house_price); ?></span>
                    </th>
                  </tr>
                  <tr>
                    <th>Total Dues installment</th>
                    <th>
                      <span class='label label-primary'><?php echo e($paid_amount-$house_price); ?></span>
                    </th>
                  </tr>
                  <tr>
                    <th>Last submitted amount</th>
                    <td>
                      <span class='label label-info'><?php echo e(number_format($total)); ?></span>
                    </td>
                  </tr>
                  <tr>
                    <th>Total Submitted Amount</th>
                    <th>
                      <span class='label label-success'><?php echo e($paid_amount); ?></span>
                    </th>
                  </tr>
                <?php endif; ?>
              </table>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <?php echo Form::label("Payment Type", "Payment Type:", ["class" => "control-label"]); ?>

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
                <?php echo Form::label("submit_amount", "Amount:", ["class" => "control-label"]); ?>

                <?php echo Form::number("submit_amount", null, ["class" => "form-control amountts",  'required' => 'required', 'id' => 'enter-amount', "Placeholder" => "Enter Amount:"]); ?>

                <input type="hidden" name='status' value='New'>
              </div>
            </div>
          </div>

          <div class='row'>
            <div class="panel-footer">
              <div class='form-group'>
                <?php echo Form::submit('Submit', ['class' => 'btn btn-success']); ?>

              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php echo Form::close(); ?>


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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>