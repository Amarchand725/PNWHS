<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo Form::open([
    'route' => 'File.store'
]); ?>



<div class="form-group">
<?php echo Form::label("id", "Id:", ["class" => "control-label"]); ?>

<?php echo Form::text("id", null, ["class" => "form-control"]); ?></div>
<div class="form-group">
<?php echo Form::label("file_name", "File_name:", ["class" => "control-label"]); ?>

<?php echo Form::text("file_name", null, ["class" => "form-control"]); ?></div>
<div class="form-group">
<?php echo Form::label("status", "Status:", ["class" => "control-label"]); ?>

<?php echo Form::text("status", null, ["class" => "form-control"]); ?></div>
<div class="form-group">
<?php echo Form::label("created_at", "Created_at:", ["class" => "control-label"]); ?>

<?php echo Form::text("created_at", null, ["class" => "form-control"]); ?></div>
<div class="form-group">
<?php echo Form::label("updated_at", "Updated_at:", ["class" => "control-label"]); ?>

<?php echo Form::text("updated_at", null, ["class" => "form-control"]); ?></div>
<div class='form-group'><?php echo Form::submit('Create New File', ['class' => 'btn btn-primary']); ?></div>

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>