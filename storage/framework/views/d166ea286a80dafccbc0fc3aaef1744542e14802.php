<?php echo Form::model($formModel, [
    'route' => 'Userroles.index',
    'method' => 'get'
]); ?>




<div class="row">
<div class="col-md-4">
    <div class="form-group">
        <?php echo Form::label("role", "Role:", ["class" => "control-label"]); ?>

        <?php echo Form::text("role", null, ["class" => "form-control"]); ?></div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>
    </div></div>

<?php echo Form::close(); ?>