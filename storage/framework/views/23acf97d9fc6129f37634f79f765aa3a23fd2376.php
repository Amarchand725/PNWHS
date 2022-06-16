<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open([
    'route' => 'Userpermission.store',
    'files' => 'true'
]); ?>

<div class="col-md-12">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Create Permessions</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label("name", "Role:", ["class" => "control-label"]); ?>

                        <span style='color:red'>*</span>
                        <?php echo Form::text("name", null, ["class" => "form-control"]); ?>

                        <span style='color:red'><?php echo e($errors->first('name')); ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label("description", "Description:", ["class" => "control-label"]); ?>

                        <span style='color:red'>*</span>
                        <?php echo Form::text("description", null, ["class" => "form-control"]); ?>

                        <span style='color:red'><?php echo e($errors->first('description')); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                <?php echo Form::submit('Create New Users', ['class' => 'btn btn-primary']); ?>

            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>