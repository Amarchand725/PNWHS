 <?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::open([
    'route' => 'crud.store'
]); ?>


<div class="form-group">
    <?php echo Form::label('title', 'Database Name:', ['class' => 'control-label']); ?>

    <?php echo Form::text('dbname', null, ['class' => 'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('description', 'Table Name:', ['class' => 'control-label']); ?>

    <?php echo Form::textarea('tbname', null, ['class' => 'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('description', 'Model Name:', ['class' => 'control-label']); ?>

    <?php echo Form::textarea('modelname', null, ['class' => 'form-control']); ?>

</div>

<?php echo Form::submit('Create New Task', ['class' => 'btn btn-primary']); ?>


<?php echo Form::close(); ?>