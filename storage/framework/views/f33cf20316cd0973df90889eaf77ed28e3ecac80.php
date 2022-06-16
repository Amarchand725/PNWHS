<?php echo e(Form::open(array('url' => 'search_membership_members', 'method' => 'get'))); ?>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <?php echo Form::label("p_no", "PJ No:", ["class" => "control-label"]); ?>

                <?php echo Form::number("p_no", null, ["class" => "form-control", "min" => "0", "placeholder" => "Search by PJ.No"]); ?>

            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <?php echo Form::label("house_no", "House No:", ["class" => "control-label"]); ?>

                <?php echo Form::text("house_no", null, ["class" => "form-control", "placeholder" => "Search by House No"]); ?>

            </div>
        </div>
        <br />
        <div class="col-md-2">
            <div class='form-group'>
                <?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit','style' => 'margin-top: 7px;']); ?>

            </div>
        </div>
    </div>
<?php echo Form::close(); ?>



