
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('getProfit._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<style>
		input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
			line-height: 10px;
		}
	</style>
<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <a href="<?php echo e(route('GetProfit.create')); ?>" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Create Return Fund</a>
		  <h4 class="panel-title">Manage Returned Fund</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>P/PJO No</b></th>
				  <th><b>Name | Rank</b></th>
				  <th><b>Profit Rate</b></th>
				  <th><b>Paid Amount</b></th>
				  <th><b>Profit Amount</b></th>
				  <th><b>Refundable Amount</b></th>
				  <th><b>Status</b></th>
				  <th><b>Created_at</b></th>
				  <th><b>Action</b></th>
				</tr>
			  </thead>
			  <tbody class='ajax_content'>
			  	<?php $counter = 0; ?>
				<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $counter++; ?>
					<tr>
						<td><?php echo e($counter); ?>.</td>
						<td>
							<?php if(!empty($model->hasPromotedMember)): ?>
								<?php echo e($model->hasPromotedMember->new_p_no??'--'); ?>

							<?php else: ?>
								<?php echo e($model->p_no??'--'); ?>

							<?php endif; ?>
						</td>	
						<td>
							<?php if(!empty($model->hasPromotedMember)): ?>
								<?php echo e($model->hasPromotedMember->hasMember->name??'N/A'); ?> | 
								<?php echo e($model->hasPromotedMember->hasPromotedRank->name??'N/A'); ?>

							<?php else: ?>
								<?php echo e($model->hasMember->name??'N/A'); ?> | 
								<?php echo e($model->hasMember->hasRank->name??'N/A'); ?>

							<?php endif; ?>
						</td>
						<td>
							<label for="" class="label label-info"><?php echo e($model->hasProfitRate->rate??'--'); ?>%</label>
						</td>
						<td>
							<label for="" class="label label-primary"><?php echo e(number_format((int)$model->paid_amount)??'--'); ?></label>
						</td>
						<td>
							<label for="" class="label label-info"><?php echo e(number_format((int)$model->profit_amount)??'--'); ?></label>
						</td>
						<td>
							<label for="" class="label label-primary"><?php echo e($model->total_amount??'--'); ?></label>
						</td>
						<td>
							<?php if($model->payment_status=='pending'): ?>
								<span class='label label-danger'><i class='fa fa-clock-o'></i> Pending</span>
							<?php else: ?>
								<span class='label label-success'><i class='fa fa-check'></i> Payment Released</span>
							<?php endif; ?>
						</td>
						<td><?php echo e(!empty($model->created_at) ? $model->created_at : "-"); ?></td>
						<td>
							<!-- <a href="<?php echo e(route('GetProfit.edit', $model->id)); ?>" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a> -->
							<!-- <a title="Delete" class="btn btn-danger deleteGetProfit" value="<?php echo e($model->id); ?>">
								<i class="fa fa-trash-o"></i>
							</a> -->
							<?php if($model->payment_status=='pending'): ?>
								<button type="button" data-profit-id="<?php echo e($model->id); ?>" class="btn btn-info btn-sm release-payment" title="Release Payment" data-toggle="modal" data-target="#myModal"><i class="fa fa-money"></i> Release Payment</button>
							<?php else: ?>
								<button type="button" data-profit-id="<?php echo e($model->id); ?>" class="btn btn-success btn-sm released-payment-details" title="Payment Released Details" data-toggle="modal" data-target="#myModalDetails"><i class="fa fa-eye"></i> Released Payment</button>
								<a href="<?php echo e(url('reciept')); ?>/<?php echo e($model->id); ?>" class="btn btn-info btn-sm" title="Payment Released Reciept"><i class="fa fa-eye"></i> Reciept</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<tr style="align-content: center">
				  <td colspan="12">
				  	<?php echo e($models->links()); ?>

				  </td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>

	<!-- Payment Release Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style='background-color: #428bca; border-color: #357ebd;'>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style='color:white'><i class='fa fa-money'></i> Release Payment Form</h4>
				</div>
				<div class="modal-body">
					<form action="<?php echo e(url('release_profit_payment')); ?>" method="post" class="release_payment_form">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="get_profit_id" id="profit_id">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">Payment Method <span style='color:red'>*</span></label>
									<select name="payment_method" id="" class="form-control" required>
										<option value="">Select Payment Method</option>
										<option value="pay-order">Pay Order</option>
										<option value="cheque">Cheque</option>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">	
									<label for="">Bank Name <span style='color:red'>*</span></label>
									<input type="text" name='bank_name' class="form-control" placeholder="Enter Bank Name" required>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">Date <span style='color:red'>*</span></label>
									<input type="date" class="form-control" name="date" id="" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">	
									<label for="">Ref/Cheque No <span style='color:red'>*</span></label>
									<input type="text" name='ref_cheque_no' class="form-control" placeholder="Enter Reference/cheque No" required>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="">Reciever's Name <span style='color:red'>*</span></label>
									<input type="text" class="form-control" placeholder="Enter Reciever's Name" name="reciever_name" id="" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">	
									<label for="">Reciever's CNIC <span style='color:red'>*</span></label>
									<input type="text" name='reciever_cnic' class="form-control" placeholder="Enter Reciever CNIC No" required>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="">Remarks</label>
									<textarea name="remarks" id="" placeholder="Enter remarks" class="form-control" cols="50" style="margin: 0px 1px 0px 0px; height: 65px; width: 568px;" rows="5"></textarea>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<button class="btn btn-success"><i class='fa fa-submit'></i> Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Display Payment Released Details Modal -->
	<div id="myModalDetails" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style='background-color: #428bca; border-color: #357ebd;'>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style='color:white'><i class='fa fa-check'></i> Payment Released Details</h4>
				</div>
				<div class="modal-body">
					<div class="display-data"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		$('.released-payment-details').on('click', function(){
			var profit_id = $(this).attr('data-profit-id');
			$.ajax({
				type: "POST",
				url: "<?php echo e(url('get_profit_details')); ?>",
				data: {_token: "<?php echo e(csrf_token()); ?>", profit_id:profit_id },
				success: function( response ) {
					console.log(response);
					var html = '';
					html = '<table class="table table-bordered">'+
						'<tr>'+
							'<th>Reciever Name: </th>'+
							'<td>'+response.reciever_name+'</div>'+
						'</tr>'+
						'<tr>'+
							'<th>Reciever CNIC: </th>'+
							'<td>'+response.reciever_cnic+'</div>'+
						'</tr>'+
						'<tr>'+
							'<th>Bank: </th>'+
							'<td>'+response.bank_name+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Payment Method: </th>'+
							'<td>'+response.payment_method+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Ref/cheque No: </th>'+
							'<td>'+response.ref_cheque_no+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Date: </th>'+
							'<td>'+response.date+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Remarks: </th>'+
							'<td>'+response.remarks+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Payment Status: </th>'+
							'<td><span class="label label-success"><i class="fa fa-check"></i> Payment Released</span></td>'+
						'</tr>'+
						'<tr>'+
							'<th>Payment Released Date: </th>'+
							'<td>'+response.created_at+'</td>'+
						'</tr>'+
					'</table>';
					$('.display-data').html(html);
				}
			});
		});

		$('.release-payment').on('click', function(){
			var profit_id = $(this).attr('data-profit-id');
			$('#profit_id').val(profit_id);
		});
		
		//Client side validation
		$('.release_payment_form').validate({
			submitHandler: function(form) {
			form.submit();
			}
		});

		$(document).on('click','.deleteGetProfit',function(e){
			e.preventDefault();
			var id = $(this).attr('value');
			var deleted = $(this);
			$.ajax({
				url: '/GetProfit/'+id,
				type: 'DELETE',  // user.destroy
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					
				success: function(result) {
				if(result.msg!='fail'){
					window.location.reload();
				}else{
					alert('Sorry something wrong.!');
				}
				// Do something with the result
				},
				error:function(e){
				window.location.reload();
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>