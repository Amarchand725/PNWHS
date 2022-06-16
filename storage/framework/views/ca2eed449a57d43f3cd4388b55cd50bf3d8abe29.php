<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo Form::open([
    'route' => 'Teste.store'
]); ?>



<div class="form-group">
<?php echo Form::label("id", "Id:", ["class" => "control-label"]); ?>

<?php echo Form::text("id", null, ["class" => "form-control"]); ?></div>
<div class="form-group">
<?php echo Form::label("name", "Name:", ["class" => "control-label"]); ?>

<?php echo Form::text("name", null, ["class" => "form-control"]); ?></div>
<div class='form-group'><?php echo Form::submit('Create New Teste', ['class' => 'btn btn-primary']); ?></div>

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>