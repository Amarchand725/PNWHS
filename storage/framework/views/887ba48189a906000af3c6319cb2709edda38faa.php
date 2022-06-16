<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo Form::open([
        'route' => 'CsvFile.store',
        'enctype' => 'multipart/form-data'
    ]); ?>


	<?php if($submit_name != 'conflected-list'): ?>
		<input type="hidden" name='csv_file_id' value='<?php echo e($csv_raw_file_id); ?>'>
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php if($submit_name=='registered-list'): ?>
						Registered Members Record
					<?php elseif($submit_name=='unregistered-list'): ?>
						Unregistered Members Record
					<?php endif; ?>
				</h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<table class="table table-bordered">
						<thead>
							<tr>
							<td><b><label for='selectAll'><input type="checkbox" id="selectAll" />&nbsp;<strong> Select All</strong></label></b></td>
							<th><b>P/PJO No</b></th>
							<th><b>Name</b></th>
							<th><b>Rank</b></th>
							<!-- <th><b>Reg:Fee (PKR)</b></th>
							<th><b>Insurance (PKR)</b></th> -->
							<th><b>Amount (PKR)</b></th>
							<!-- <th><b>Date</b></th> -->
							</tr>
						</thead>
						<tbody class='ajax_content'>
							<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td><input type="checkbox" name="records[]" value="<?php echo e($member['pjo']); ?>" /></td>
									<td><?php echo e($member['pjo']); ?></td>
									<td><?php echo e($member['name']??'N/A'); ?></td>
									<td><?php echo e($member['rank']??'N/A'); ?></td>
									<!-- <td><?php echo e(number_format($member['reg_fee'])??'N/A'); ?></td>
									<td><?php echo e(number_format($member['insurance'])??'N/A'); ?></td> -->
									<td>
										<?php $__currentLoopData = $members_paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$paid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($key==$member['pjo']): ?>
												<?php echo e(number_format($paid)); ?>

											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</td>
									<!-- <td>
										<?php if($member['date']=='January-1970'): ?>
											<?php echo e(date('d, M-Y')); ?>

										<?php else: ?>
											<?php echo e(date('d, M-Y', strtotime($member['date']))); ?>

										<?php endif; ?>
									</td> -->
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
				<div class="form-group">
					<button class='btn btn-success' type='submit'><i class='fa fa-save'></i> Save</button>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">
					Conflected Records
				</h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><b>P/PJO No</b></th>
								<th><b>Name</b></th>
								<th><b>Rank</b></th>
								<th><b>Amount (PKR)</b></th>
								<th><b>Date</b></th>
							</tr>
						</thead>
						<tbody class='ajax_content'>
							<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($conflected_records[$member['pjo']]>1): ?>
									<tr>
										<td><?php echo e($member['pjo']); ?></td>
										<td><?php echo e($member['name']??'N/A'); ?></td>
										<td><?php echo e($member['rank']??'N/A'); ?></td>
										<td>
										<?php $__currentLoopData = $members_paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$paid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if($key==$member['pjo']): ?>
												<?php echo e(number_format($paid)); ?>

											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</td>
										<td>
											<?php if($member['date']=='January-1970'): ?>
												<?php echo e(date('d, M-Y')); ?>

											<?php else: ?>
												<?php echo e(date('d, M-Y', strtotime($member['date']))); ?>

											<?php endif; ?>
										</td>
									</tr>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif; ?>

    <?php echo Form::close(); ?>


	<script>
		$('#selectAll').click(function(e){
			var table= $(e.target).closest('table');
			$('td input:checkbox',table).prop('checked',this.checked);
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>