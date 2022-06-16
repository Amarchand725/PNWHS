<?php echo Form::model($formModel, [
    'route' => 'GetProfit.index',
    'method' => 'get'
]); ?>


<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
        <?php echo Form::label("p_no", "P/PJO No:", ["class" => "control-label"]); ?>

        <?php echo Form::text("p_no", null, ["class" => "form-control", "placeholder" => "Search by P/PJO No"]); ?></div>
    </div>
    <div class="col-sm-2">
        <label for=""></label>
        <div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>
    </div>
</div>

<?php echo Form::close(); ?>