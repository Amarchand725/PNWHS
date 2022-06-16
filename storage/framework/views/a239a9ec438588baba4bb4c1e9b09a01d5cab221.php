<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 <tr>
				 <td>
					 <?php echo e($model->name); ?>

				 </td>
				 <td>
					 <?php echo e($model->description); ?>

				 </td>
				 
				 <td>
					 <a href="<?php echo url('/Userpermission/show'.'/'. $model->id);; ?> " class="btn btn-success">View</a>
					 <a href="<?php echo e(route('Userpermission.edit', $model->id)); ?>" class="btn btn-info">Update</a>
					 <a href="javascript:void(0)" id='deleterow' class='btn btn-danger' data-account-id='<?php echo $model->id; ?>' >Delete</a>
				 </td>
			 </tr>
		
		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<tr>
	<td colspan="2">
		<?php echo e($models->appends($_GET)->links()); ?>

	</td>
</tr>