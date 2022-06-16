<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open([
    'route' => 'Users.store',
    'files' => 'true'
]); ?>

<div class="panel panel-dark">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Create User</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label("p_no", "P.No#", ["class" => "control-label"]); ?>

                        <span style='color:red'>*</span>
                        <?php echo Form::number("p_no", null, ["class" => "form-control", 'placeholder' => 'Enter User P.No#']); ?>

                        <span style='color:red'><?php echo e($errors->first('p_no')); ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label("name", "Name", ["class" => "control-label"]); ?>

                        <span style='color:red'>*</span>
                        <?php echo Form::text("name", null, ["class" => "form-control", 'placeholder' => 'Enter User Name']); ?>

                        <span style='color:red'><?php echo e($errors->first('name')); ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                <div class="form-group">
                    <?php  $usertype = DB::table('usertype')->pluck('name','id'); ?>
                        <?php echo Form::label("user_type", "User Type", ["class" => "control-label"]); ?>

                        <span style='color:red'>*</span>
                        <?php echo e(Form::select('user_type',$usertype, null, ['class' => 'form-control', 'placeholder' => 'Select User Type'] )); ?>

                        <span style='color:red'><?php echo e($errors->first('user_type')); ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label("email", "Email / User Name", ["class" => "control-label"]); ?>

                        <span style='color:red'>*</span>
                        <?php echo Form::text("email", null, ["class" => "form-control", 'placeholder' => 'Enter Email or User Name ']); ?>

                        <span style='color:red'><?php echo e($errors->first('email')); ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label("password", "Password", ["class" => "control-label"]); ?>

                        <span style='color:red'>*</span>
                        <?php echo Form::text("password", null, ["class" => "form-control", 'placeholder' => '*******']); ?>

                        <span style='color:red'><?php echo e($errors->first('password')); ?></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    <?php
                        $userroles = DB::table('userroles')->pluck('role','id'); 
                    ?>
                    <?php echo Form::label("Userroles", "User Role", ["class" => "control-label "]); ?>

                    <span style='color:red'>*</span>
                    <?php echo Form::select('role', $userroles , null, ['class' => 'form-control', 'placeholder' => 'Select User Role']); ?>

                    <span style='color:red'><?php echo e($errors->first('role')); ?></span>
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