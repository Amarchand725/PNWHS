<?php echo Form::model($formModel, [
    'route' => 'File.index',
    'method' => 'get'
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
<div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>


<?php echo Form::close(); ?>