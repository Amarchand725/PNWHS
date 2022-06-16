
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('construction._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
				<div style="float: right;">
					<a href="<?php echo e(url('Construction/create')); ?>" class="btn btn-default c">Create Construction</a>
				</div>

				<div class="">
					<h4 class='panel-title'>Manage Constructions</h4>
				</div>
			</div>
		</div>
		<div class="">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><b>#</b></th>
						<th><b>Constructor</b></th>
						<th><b>Plot</b></th>
						<th><b>Category</b></th>
						<th><b>Duaration</b></th>
						<th><b>Initial Price</b></th>
						<th><b>Final Price</b></th>
						<th><b>Status</b></th>
						<th><b>Date</b></th>
						<th><b>Action</b></th>
					</tr>
				</thead>
				<tbody class='ajax_content'>
					<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($loop->index +1); ?></td>
							<td>
								<?php $cons =  DB::table('constructor')->where('id',$model->constructor_id)->first(); ?>
								<?php echo e($cons->name); ?>

							</td> 
							<td>
								<?php
									$plot =  DB::table('plots')->where('id',$model->plot_id)->first();
								?>
								<?php if(!empty($plot)): ?>
									<?php echo e($plot->plot_no); ?>

								<?php endif; ?>	 
							</td>
							<td>
								<?php echo e($model->category); ?>

							</td>
							<td>
								<?php echo e($model->duaration); ?>

							</td>
							<td>
								<?php if(!empty($model->initial_price)): ?>
									<?php echo e($cnr->gettypenumber($model->initial_price)); ?>

								<?php else: ?>
									<?php echo e('0'); ?>

								<?php endif; ?>
							</td>
							<td>
								<?php if(!empty($model->final_price)): ?>
									<?php echo e($cnr->gettypenumber($model->final_price)); ?>

								<?php else: ?>
									<?php echo e('0'); ?>

								<?php endif; ?>
							</td>
							<?php 
								$exp =  explode(' ',$model->duaration);
								$updatedate = date('Y-m-d', strtotime(date('Y-m-d') .'+'.$exp[0].' month')); 
								$created_date =  date('Y-m-d',strtotime($model->created_at));
							?>

							<?php if(date('Y-m-d') > $updatedate && $model->status != 'Working'): ?>
								<td style='color:red'>
									<?php echo e('Construction Period is over'); ?>				 
								</td>
							<?php else: ?>
								<td>
									<?php if($model->status=='progress'): ?>
										<span class='label label-info'><i class='fa fa-spinner'></i> Progress</span>	
									<?php else: ?>
										<span class='label label-success'><i class='fa fa-check'></i> Completed</span>
									<?php endif; ?>
								</td>
							<?php endif; ?>
							<td>
								<?php echo e(date('d-F-Y',strtotime($model->created_at))); ?>

							</td>
							<td>
								<a href="<?php echo e(route('Construction.show', $model->id)); ?> " class="btn btn-success btn-sm" title='Show'><i class='fa fa-eye'></i></a>
								<button type="button" class="btn btn-primary update-status btn-sm" data-status='<?php echo e($model->status); ?>' title='Update Status' data-construction-id='<?php echo e($model->id); ?>'><i class='fa fa-pencil'></i></button>
								<a href="<?php echo e(route('Construction.edit', $model->id)); ?>" class="btn btn-info btn-sm" title='Edit'><i class='fa fa-edit'></i></a>
								<a title="Delete" class="btn btn-danger btn-sm deleteConstraction" value="<?php echo e($model->id); ?>">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<tr style="align-content: center">
						<td colspan="6">
							<?php echo e($models->appends($_GET)->links()); ?>

						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style='background-color: #428bca; border-color: #357ebd;'>
					<h5 class="modal-title" style='color:white' id="exampleModalLabel"><i class='fa fa-pencil'></i> Update Status</h5>
				</div>
				<form action="<?php echo e(url('construction_status')); ?>">
					<div class="modal-body">
						<input type="hidden" name='construction_id' id='construction-id'>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<?php echo Form::label("Status", "Status", ["class" => "control-label "]); ?>

								<select name="status" id="construction-status" class='form-control construction-status'>
									<option value=''>Status</option>
									<option value='progress'>In Progress</option>
									<option value='completed'>Completed</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type='submit' class='btn btn-info'><i class='fa fa-pencil'></i> Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$('.update-status').on('click', function(){
			var construction_id = $(this).attr('data-construction-id');
			var construction_status = $(this).attr('data-status');
			$('#construction-id').val(construction_id);
			var html = '<option value="progress"'+construction_status+'=="progress"?"selected":"">In Progress</option>'+
						'<option value="completed"'+construction_status+'=="completed"?"selected":"">Completed</option>';
			$('#construction-status').html(html);		
			$('#exampleModal').modal('show');
		});
	</script>
 	<?php echo $__env->make('ajax_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).on('click','.deleteConstraction',function(){
			var id = $(this).attr('value');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo e(url("delete_constraction")); ?>/'+id,
                        type: 'get',
                        success: function(result) {
                            if(result==1){
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        }
                    });
					
					$(this).closest("tr").remove();
                }
            })
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>