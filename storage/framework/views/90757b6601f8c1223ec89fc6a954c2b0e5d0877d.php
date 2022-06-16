
<?php $__env->startSection('content'); ?>
	<?php if(Auth::user()->userType->name=='Admin'): ?>
		<?php echo $__env->make('GalleryImage._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<br />
		<div class="panel panel-dark">
			<div class="panel-heading">
			<a href="<?php echo e(route('GalleryImage.create')); ?>" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Upload Images</a>
			<h4 class="panel-title">Manage Image Gallery</h4>
			</div>
			<div class="panel-body">
			<div class="row">
				<table class="table table-bordered">
				<thead>
					<tr>
					<th><b>#</b></th>
					<th><b>Image</b></th>
					<th><b>Name</b></th>
					<th><b>Status</b></th>
					<th><b>Created_by</b></th>
					<th><b>Created_at</b></th>
					<th><b>Action</b></th>
					</tr>
				</thead>
				<tbody class='ajax_content'>
					<?php $counter = 1; ?>
					<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($counter++); ?>.</td>
							<td>
								<img src="<?php echo e(url('public/gallery/'.$model->name)); ?>" class='circle' style='width:100px' class="img-responsive thumbnail"/>
							</td>
							<td><?php echo e($model->name); ?></td>
							<td>
								<?php if($model->status==1): ?>
									<span class='label label-success'>Active</span>
								<?php else: ?>
									<span class='label label-danger'>Inactive</span>
								<?php endif; ?>
							</td>
							<td><?php echo e($model->hasUserCreatedBy->name); ?> | <?php echo e($model->hasUserCreatedBy->hasRole->role); ?></td>
							<td><?php echo e(date('d, F-Y', strtotime($model->created_at))); ?></td>
							<td>
								<a href="<?php echo e(route('GalleryImage.edit', $model->id)); ?>" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
								<a title="Delete" class="btn btn-danger deleteGalleryImage" value="<?php echo e($model->id); ?>" >
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
	<?php else: ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

		<div class="contentpanel">
			<div class="photo-gallery">
				<div class="container">
					<div class="intro">
						<h2 class="text-center">Picture Gallery</h2>
						<p class="text-center"></p>
					</div>
					<div class="row photos">
						<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-sm-4 item">
								<a href="<?php echo e(url('/public/gallery/'.$model->name)); ?>" data-lightbox="photos">
									<img class="img-fluid" src="<?php echo e(url('/public/gallery/'.$model->name)); ?>" style='width:100%; height:300px'>
								</a>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
	<?php endif; ?>
	
	<script>
		$(document).on('click','.deleteGalleryImage',function(e){
			e.preventDefault();
			var id = $(this).attr('value');
			var deleted = $(this);
			$.ajax({
				url: '/GalleryImage/'+id,
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