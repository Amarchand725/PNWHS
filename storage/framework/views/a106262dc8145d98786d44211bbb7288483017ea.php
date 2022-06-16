<?php echo Form::model($formModel, [
    'route' => 'Payment.index',
    'method' => 'get'
]); ?>



<div class="row">
<div class="col-md-4">
    <div class="form-group">
        <?php echo Form::label("p_no", "PNo:", ["class" => "control-label"]); ?>

        <?php echo Form::text("p_no", null, ["class" => "form-control", "placeholder" => "Search by PNo"]); ?></div>
</div>
    
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>
    </div></div>

<?php echo Form::close(); ?>