<?php $__env->startSection('signin'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="row">
        <div class="col-md-5 center">
            <h1 align="center"><span style="color: #1caf9a "></span><b> LOGIN</b><span style="color: #1caf9a "></span></h1>
        </div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <label for="email">Email / User Name / P.No</label>
            <input id="email" type="text" class="form-control uname" placeholder='Enter Email or User Name' name="email" >
            <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
            <input id="password" type="password" class="form-control pword" placeholder='Enter correct password' name="password">
            <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Login</button>
            <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">Forgot Your Password?</a>
            <!--<a class="btn btn-link" href="<?php echo e(url('/create_new_user')); ?>"><i class='fa fa-arrow-right'></i> Create New Account</a>-->
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.masterlogin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>