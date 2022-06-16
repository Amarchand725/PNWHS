<?php echo Form::model($formModel, [
	'route' => 'AllotteeParticular.index',
	'method' => 'get'
]); ?>

	<div class="row">
		<div class="col-md-2">
			<div class="form-group">
				<?php echo Form::label("p_no", "P/PJ/O No:", ["class" => "control-label"]); ?>

				<?php echo Form::text("p_no", null, ["class" => "form-control", "placeholder" => "Search by P.No#"]); ?>

			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<?php echo Form::label("name", "Name:", ["class" => "control-label"]); ?>

				<?php echo Form::text("name", null, ["class" => "form-control", "placeholder" => "Search by Name"]); ?>

			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<?php echo Form::label("rank_rate", "Ranks:", ["class" => "control-label"]); ?>

				<?php echo Form::select("rank_rate", $ranks, null, ["class" => "form-control", "placeholder" => "Search by Rank"]); ?>

			</div>
		</div>
		<br />
		<div class="col-md-2">
			<div class='form-group'>
				<?php echo Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']); ?>

			</div>
		</div>
	</div>
<?php echo Form::close(); ?>