<?php $__env->startSection('content'); ?>
<?php echo $__env->make('promotedMember._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <a href="<?php echo e(route('PromotedMember.create')); ?>" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Create Member Promotion</a>
		  <h4 class="panel-title">Manage Promoted Members</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>Reg.File.No</b></th>
				  <th><b>Old P/PJO No</b></th>
				  <th><b>New P/PJO No</b></th>
				  <th><b>Name</b></th>
				  <th><b>Person</b></th>
				  <th><b>Tot Service</b></th>
				  <th><b>Rank</b></th>
				  <th><b>Promotion Date</b></th>
				  <th><b>Created By</b></th>
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
						<td><?php echo e($model->file_registration_no??'N/A'); ?></td>
						<td><?php echo e($model->old_p_no??'N/A'); ?></td>
						<td><?php echo e($model->new_p_no??'N/A'); ?></td>
						<td><?php echo e(!empty($model->hasMember)?ucfirst($model->hasMember->name):'N/A'); ?></td>
						<td><?php echo e(ucfirst($model->soldier)??'N/A'); ?></td>
						<td><?php echo e($model->total_service??'N/A'); ?></td>
						<td>
							<?php echo e($model->hasPromotedRank->name??'N/A'); ?>

						</td>
						<td>
							<?php echo e(date('d, M- Y', strtotime($model->d_o_p))); ?>

						</td>
						<td><?php echo e($model->hasUserCreatedBy->name??'N/A'); ?> | <?php echo e($model->hasUserCreatedBy->hasRole->role??'N/A'); ?></td>
						<td><?php echo e(!empty($model->created_at) ? date('d, M-y | H:g A', strtotime($model->created_at)) : "-"); ?></td>
						<td>
							<a href="<?php echo e(route('PromotedMember.edit', $model->id)); ?>" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
							<a title="Delete" class="btn btn-danger btn-sm deletePromotedMember" value="<?php echo e($model->id); ?>">
							<i class="fa fa-trash-o"></i>
							</a>
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
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).on('click','.deletePromotedMember',function(){
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
                        url: '<?php echo e(url("delete_promoted_member")); ?>/'+id,
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