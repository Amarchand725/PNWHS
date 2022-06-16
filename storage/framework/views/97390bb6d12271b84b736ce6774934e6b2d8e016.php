<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
<?php echo Form::open([
    'route' => 'Rank.store',
    'class' => "rank_form"
]); ?>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <?php echo Form::label("name", "Name:", ["class" => "control-label"]); ?>

            <?php echo Form::text("name", null, ["class" => "form-control", "placeholder" => "Enter Rank", 'required' => 'required']); ?>

            <span style='color:red'><?php echo e($errors->first('name')); ?></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <?php echo Form::label("category", "Category:", ["class" => "control-label"]); ?>

            <select name="category" class="form-control" id="" required>
                <option value="">Select Category</option>
                <?php $__currentLoopData = $house_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <?php echo Form::label("rank_status", "Status:", ["class" => "control-label"]); ?>

        <?php echo Form::select("status", ['1' => 'Enable', '0' => 'Disable'], null, ["class" => "form-control"]); ?></div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'><?php echo Form::submit('Create New Rank', ['class' => 'btn btn-primary']); ?></div>
    </div>
</div>
<?php echo Form::close(); ?>


<script>
    //Client side validation
    $('.rank_form').validate({
        submitHandler: function(form) {
          form.submit();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>