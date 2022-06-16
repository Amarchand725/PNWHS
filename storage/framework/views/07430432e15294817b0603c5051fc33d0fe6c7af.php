<?php echo Form::model($formModel, [
    'route' => 'Userpermission.index',
    'method' => 'get'
]); ?>




<div class="row">
<div class="col-md-4">
    <div class="form-group">
        <?php echo Form::label("name", "Name:", ["class" => "control-label"]); ?>

        <?php echo Form::text("name", null, ["class" => "form-control"]); ?></div>
</div>
    <div class="col-md-4">

        <div class="form-group">
            <?php echo Form::label("description", "Description:", ["class" => "control-label"]); ?>

            <?php echo Form::text("description", null, ["class" => "form-control"]); ?></div>
    </div>

<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>
    </div></div>

<?php echo Form::close(); ?>