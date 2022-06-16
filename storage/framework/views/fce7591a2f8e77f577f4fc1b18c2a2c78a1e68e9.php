
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('csvFile._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <a href="<?php echo e(url('/import_file')); ?>" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Upload CSV/Excel File</a>
		  <h4 class="panel-title">Manage Payment Files</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>CsvFile</b></th>
				  <th><b>Uploaded By</b></th>
				  <th><b>Created_at</b></th>
				  <th><b>Action</b></th>
				</tr>
			  </thead>
			  <tbody class='ajax_content'>
			  	<?php $counter = 1; ?>
				<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($counter++); ?>.</td>
						<td><?php echo e($model->file_name); ?></td>
						<td><?php echo e($model->hasUserCreatedBy->name); ?> | <?php echo e($model->hasUserCreatedBy->hasRole->role); ?></td>
						<td><?php echo e($model->created_at); ?></td>
						<td>
							<a href="<?php echo e(route('CsvFile.edit', $model->id)); ?>" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
							<a href="<?php echo e(route('CsvFile.show', $model->id)); ?>" title="Display Amount List" class="btn btn-info"><i class="fa fa-eye"></i></a>
							<a title="Delete" class="btn btn-danger deleteCsvFile" value="<?php echo e($model->id); ?>"><i class="fa fa-trash-o"></i></a>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td colspan="7">
						<?php echo e($models->links()); ?>

					</td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<!-- <script>
		$(document).on('click','.deleteCsvFile',function(e){
			e.preventDefault();
			var id = $(this).attr('value');
			var deleted = $(this);
			$.ajax({
				url: '/CsvFile/'+id,
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
	</script> -->
	<script>
	    $(document).on('click', '.member-status', function(){
			var member_id = $(this).attr('data-member-id');
			$('#member_id').val(member_id);
			$('.member_status_modal').modal('show');
		});
		
		$(document).on('click','.deleteCsvFile',function(){
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
                        url: '<?php echo e(url("delete_uplodated_file")); ?>/'+id,
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
		
		$('.donwload_members_record').on('click', function(e){
			$("#example").table2excel({
				exclude: ".noExport",
				filename: "members.xls"
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>