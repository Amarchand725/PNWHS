<?php echo Form::model($formModel, [
    'route' => 'Rank.index',
    'method' => 'get'
]); ?>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        <?php echo Form::label("name", "Name:", ["class" => "control-label"]); ?>

        <?php echo Form::text("name", null, ["class" => "form-control", "placeholder" => "Search by Rank"]); ?></div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'><?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?></div>
    </div>
</div>

<?php echo Form::close(); ?>