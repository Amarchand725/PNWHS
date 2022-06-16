<?php $__env->startSection('content'); ?>
	<style>
		th, td {
			padding: 20px;
		}
	</style>

	<div class="panel panel-dark" id="printablearea" class='printablearea'>
		<div class="panel-heading">
			<button class='btn btn-success' id='print_out_this_page' class='btn btn-success' title='Print Ledger' style="float: right; margin-right: 1%;margin-top: -8px;">
				<i class='fa fa-print'></i> Print ledger
			</button>
			<h4 class="panel-title">Payment Ledger</h4>
		</div>
		<div class="panel-body" >
			<span id='member_info'></span>
			<div class="row" style='width:100% !important'>
				<table class="table table-bordered table-resposive" style='width:100% !important'>
					<tbody>
						<tr>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>P/PJO/O</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important; '>Name</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Rank/Rate</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>File Number</th>
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;' colspan="2">Cat</th>
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Person</th>
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Branch</th>
						</tr>
						<tr>
							<td style='border:1px solid black;width:10% !important;'>
								<?php if(!empty($member_info->hasPromotedMember)): ?>
									<?php echo e($member_info->hasPromotedMember->new_p_no); ?>

								<?php else: ?>
									<?php echo e($member_info->p_no); ?>

								<?php endif; ?>
							</td>
							<td style='border:1px solid black;width:10% !important;'><?php echo e($member_info->name); ?></td>
							<td style='border:1px solid black;width:10% !important;'>
								<?php if(!empty($member_info->hasPromotedMember)): ?>
									<?php echo e($member_info->hasPromotedMember->hasPromotedRank->name); ?>

								<?php else: ?>
									<?php echo e($member_info->hasRank->name); ?>

								<?php endif; ?>
							</td>
							<td style='border:1px solid black;width:10% !important;'>
								<?php if(!empty($member_info->hasPromotedMember)): ?>
									<?php echo e($member_info->hasPromotedMember->file_registration_no); ?>

								<?php else: ?>
									<?php echo e($member_info->reg_file_no??'N/A'); ?>

								<?php endif; ?>
							</td>
							<td style='border:1px solid black; !important;' colspan="2">
								<?php echo e($member_info->hasPromotedMember->hasPromotedRank->hasHouseCategory->name); ?>

							</td>
							<td style='border:1px solid black; !important;'><?php echo e($member_info->hasPromotedMember->soldier??'N/A'); ?></td>
							<td style='border:1px solid black; !important;'><?php echo e($member_info->hasPromotedMember->rank_rate??'N/A'); ?></td>
						</tr>
						<tr>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>S.No#</th>
							<!-- <th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Instrument No / <br /> Slip No</th> -->
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important; '>Date</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Payment Type</th>
							<!-- <th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Payable</th> -->
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Payment Made(Rs)</th>
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Total Paid Amount</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Remaining Dues/Over Paid Amount</th>
							<th colspan='2' style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Remarks</th>
						</tr>
						<?php $counter = 0; ?>
                        <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php $counter++; ?>
							<tr>
								<td style='border:1px solid black;width:10% !important;'><?php echo e($counter); ?>.</td>
								
								<td style='border:1px solid black;width:10% !important;'><?= date('d-m-Y',strtotime($model->created_at)) ?></td>
								<td style='border:1px solid black; !important;'><?= ucwords($model->payment_type??'--'); ?></td>
								<!-- <td style='border:1px solid black;width:10% !important;'><?php echo e(number_format($model->total_amount)); ?></td> -->
								<td style='border:1px solid black;width:10% !important;'>
                                    <?php echo e(number_format($model->current_paid)); ?>

								</td>
								<td style='border:1px solid black;width:10% !important;'>
									<?php if($model->amount>0): ?>
										<?php echo e(number_format($model->submitted_amount)); ?>

									<?php else: ?>
										<?php echo e(number_format($model->submitted_amount)); ?>

									<?php endif; ?>
								</td>
								<td style='border:1px solid black;width:5% !important;'>
									<?php echo e(number_format($model->amount)); ?>

								</td>
								<td colspan='2' style='border:1px solid black;width:5% !important;'><?php echo e($model->remarks??'N/A'); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td colspan="5" style="text-align: right;"><b></b></td>
							<th style="color: green"></th>
						</tr>
					</tbody>
				</table>
				<span><?php echo e($models->links()); ?></span>
			</div>
		</div>
	</div>

	<script>
		$('#print_out_this_page').click(function(e){
			e.preventDefault();
			$('#print_out_this_page').hide();
			$('#printablearea').css('display','block');
			$('.panel-btns').css('display','none');
			$('.panel-title').css('font-size','25px');
			$('.maindata').css('margin-left','0px');
			$('.panel-title').css('text-align','center');

			var content = document.getElementById('printablearea').innerHTML;
			var mywindow = window.open('', 'Print', 'height=900,width=1300');
			mywindow.document.write('<html><head><title>Print</title>');
			mywindow.document.write('</head><body style="margin-left:0px !important;">');
			mywindow.document.write(content);
			mywindow.document.write('</body></html>');
			mywindow.document.close();
			mywindow.focus()
			mywindow.print();
			mywindow.close();
			return false;
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>