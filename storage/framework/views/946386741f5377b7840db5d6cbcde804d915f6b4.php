<?php echo Form::model($formModel, [
    'route' => 'PromotedMember.index',
    'method' => 'get'
]); ?>


<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
        <?php echo Form::label("old_p_no", "Old P/PJO No:", ["class" => "control-label"]); ?>

        <?php echo Form::text("old_p_no", null, ["class" => "form-control", "placeholder" => "Search by Old P.No"]); ?></div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
        <?php echo Form::label("new_p_no", "New P/PJO No:", ["class" => "control-label"]); ?>

        <?php echo Form::text("new_p_no", null, ["class" => "form-control", "placeholder" => "Search by New P.No"]); ?></div>
    </div>
    <div class="col-sm-2">
        <label for=""></label>
        <div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>
    </div>
</div>

<?php echo Form::close(); ?>