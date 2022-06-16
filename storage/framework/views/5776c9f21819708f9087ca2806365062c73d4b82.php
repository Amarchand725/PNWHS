<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('payment._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>

  <div class="panel panel-dark">
    <div class="panel panel-default">
        <div class="panel-heading" style='margin-top:20px;'>
          <button class='btn btn-success donwload_members_record' style="float: right; margin-right: 1%;margin-top: -8px;"><i class='fa fa-download'></i> Download Members Record</button>
			<a href="<?php echo e(url('Payment/create')); ?>" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Payment</a>
          <h4 class='panel-title'>Manage Payment</h4>
        </div>
    </div>

    <div class="">
      <table class="table table-striped">
        <thead>
          <tr>
              <th><b>#</b></th>
              <th><b>P.No</b></th>
              <th><b>Name | Rank</b></th>
              <th><b>Payment Type</b></th>
              <th><b>Submitted Amount</b></th>
              <th><b>Create_at</b></th>
              <th><b>Ledger</b></th>
            </tr>
        </thead>
        <?php if(!empty($models)): ?>
          <tbody class='ajax_content'>
            <?php $counter = 1; ?>
            <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($counter++); ?>.</td>
                <td>
                  <?php if(!empty($model->hasPromotedMember)): ?>
                    <?php echo e($model->hasPromotedMember->new_p_no); ?>

                  <?php else: ?>
                    <?php echo e(!empty($model->p_no) ? $model->p_no : '-'); ?> 
                  <?php endif; ?>    
                </td>
                <td>
                  <?php echo e($model->hasMember->name??'N/A'); ?> | 
                  <?php if(!empty($model->hasPromotedMember)): ?>
                    <?php echo e($model->hasPromotedMember->hasPromotedRank->name??'N/A'); ?>

                  <?php else: ?>
                    <?php echo e($model->hasMember->hasRank->name??'N/A'); ?>

                  <?php endif; ?>
                </td>
                <td><?php echo e($model->payment_type); ?></td>
                <td>
                  <span class='label label-success'><?php echo e(number_format($model->total_instalments_amount)); ?></span>
                </td>
                <td>
                  <?php echo e(date('d-M-Y | H:i A', strtotime($model->created_at))); ?>

                </td>
                <td>
                  <div class="row" style="width:150px !important;">
                    <a href="<?php echo e(url('Ledger', $model->member_id)); ?>" data-toggle="tooltip"  title="Ledger" class="btn btn-warning"> <span class="glyphicon glyphicon-align-justify"></span></a>
                  </div>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        <?php endif; ?>
      </table>
      <!-- Download Excel Sheet All Records -->
      <div class="row" style='display:none'>
        <table class="table table-striped" id='example'>
          <thead>
            <tr>
                <th><b>P/PJO/O</b></th>
                <th><b>Name</b></th>
                <th><b>Rank/Rate</b></th>
                <th><b>File No</b></th>
                <th><b>Cat</b></th>
                <th><b>Person</b></th>
                <th><b>Branch</b></th>
                <th><b>Total Paid Amount</b></th>
                <th><b>Remaining Dues/Over Paid Amount</b></th>
              </tr>
          </thead>
          <?php if(!empty($models)): ?>
            <tbody class='ajax_content'>
              <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <?php echo e($model->hasPromotedMember->new_p_no??'N/A'); ?>   
                  </td>
                  <td><?php echo e($model->hasMember->name??'N/A'); ?></td>
                  <td> 
                    <?php echo e($model->hasPromotedMember->hasPromotedRank->name??'N/A'); ?>

                  </td>
                  <td><?php echo e($model->hasMember->reg_file_no??'N/A'); ?></td>
                  <td><?php echo e($model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'N/A'); ?></td>
                  <td><?php echo e($model->hasMember->soldier??'N/A'); ?></td>
                  <td><?php echo e($model->hasPromotedMember->rank_rate??'N/A'); ?></td>
                  <td>
                    <?php echo e(number_format($model->total_instalments_amount)); ?>

                  </td>
                  <td>
                    <?php echo e(number_format($model->amount)); ?>

                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          <?php endif; ?>
        </table>
      </div>
      <!-- Download Excel Sheet All Records -->
      <span><?php echo e($models->links()); ?></span>
    </div>
  </div>
  <?php echo $__env->make('ajax_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <script>
    $('.donwload_members_record').on('click', function(e){
			$("#example").table2excel({
				exclude: ".noExport",
				filename: "members.xls"
			});
		});
  </script>
  <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>