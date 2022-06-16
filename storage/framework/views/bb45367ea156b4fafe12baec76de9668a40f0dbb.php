<?php $__env->startSection('content'); ?>

 <?php echo $__env->make('File._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class='ajax_content'>
<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<p>
       						<a href="<?php echo e(route('File.edit', $model->id)); ?>" class="btn btn-primary"><?php echo e($model->id); ?></a>
    				 </p><p>
       						<a href="<?php echo e(route('File.edit', $model->id)); ?>" class="btn btn-primary"><?php echo e($model->file_name); ?></a>
    				 </p><p>
       						<a href="<?php echo e(route('File.edit', $model->id)); ?>" class="btn btn-primary"><?php echo e($model->status); ?></a>
    				 </p><p>
       						<a href="<?php echo e(route('File.edit', $model->id)); ?>" class="btn btn-primary"><?php echo e($model->created_at); ?></a>
    				 </p><p>
       						<a href="<?php echo e(route('File.edit', $model->id)); ?>" class="btn btn-primary"><?php echo e($model->updated_at); ?></a>
    				 </p><hr>
    <hr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($models->appends($_GET)->links()); ?>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>



 <?php echo $__env->make('ajax_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>