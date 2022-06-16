



<?php echo Form::model($formModel, [
    'route' => 'Newsletter.index',
    'method' => 'get'
]); ?>


<div class="row">
<div class="col-md-4">
    <div class="form-group">
        <?php echo Form::label("title", "Title:", ["class" => "control-label"]); ?>

        <?php echo Form::text("title", null, ["class" => "form-control",'placeholder' => 'Search title']); ?></div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <?php echo Form::label("subject", "Subject:", ["class" => "control-label"]); ?>

        <?php echo Form::text("subject", null, ["class" => "form-control",'placeholder' => 'Search subject']); ?></div>
</div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>
    </div></div>

<?php echo Form::close(); ?>

