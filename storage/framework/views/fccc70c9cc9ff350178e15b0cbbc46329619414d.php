<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('newsletter._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
			<?php if($usertype != 'user'): ?>
				<a href="<?php echo e(route('Newsletter.create')); ?>" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Add Newsletter</a>
			<?php endif; ?>

			<h4 class="panel-title">View Newsletter</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
                  <th><b>#</b></th>
                  <th><b>Title</b></th>
				  <th><b>Subject</b></th>
                  <th><b>Expiry Date</b></th>
                  <th><b>Action</b></th>
				</tr>
			  </thead>
			  <tbody>
                <?php $counter = 0; ?>

				<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $counter++; ?>
					<tr>
						<td><?php echo e($counter); ?>.</td>
						<td><?php echo e($model->title); ?></td>
                        <td> <?php echo e($model->subject); ?> </td>

                        <?php $expiryddate =  date('d-M-Y',strtotime($model->expiry_date)) ?>
                        <td><?php echo e(!empty($model->expiry_date) ? $expiryddate : "-"); ?></td>
                        <td>
                            <a href="<?php echo e(route('Newsletter.show', $model->id)); ?>" title="Show" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <?php if($usertype != 'user'): ?>
                            	<a href="<?php echo url('/Newsletter/destroy'.'/'. $model->id);; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>