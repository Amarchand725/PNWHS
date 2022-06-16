<?php if(Session::has('flash_message')): ?>
    <div class="alert alert-success">
        <?php echo e(Session::get('flash_message')); ?>

    </div>
<?php endif; ?>
<?php if(Session::has('record_exists')): ?>
    <div class="alert alert-danger">
        <?php echo e(Session::get('record_exists')); ?>

    </div>
<?php endif; ?>

