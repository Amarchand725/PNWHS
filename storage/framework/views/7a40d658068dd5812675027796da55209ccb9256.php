<?php echo Form::model($formModel, [
    'route' => 'Teste.index',
    'method' => 'get'
]); ?>




<div class="form-group">
<?php echo Form::label("id", "Id:", ["class" => "control-label"]); ?>

<?php echo Form::text("id", null, ["class" => "form-control"]); ?></div>
<div class="form-group">
<?php echo Form::label("name", "Name:", ["class" => "control-label"]); ?>

<?php echo Form::text("name", null, ["class" => "form-control"]); ?></div>
<div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>


<?php echo Form::close(); ?>