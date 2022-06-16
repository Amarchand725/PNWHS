<?php $__env->startSection('content'); ?>
 <?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Construction.update', $model->id],
	'files' => 'true'
]); ?>

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="minimize">&minus;</a>
		</div>
		<h4 class="panel-title"><i class='fa fa-edit'></i> Update Construction</h4>
	</div>

	<div class="panel-body">
		<div class="row">
        	<div class="col-md-6 col-sm-6">
            	<div class="form-group">
					<?php  $constructor = DB::table('constructor')->pluck('name','id'); ?>
					<?php echo Form::label("constructor", "Constructor:", ["class" => "control-label"]); ?>

					<?php echo e(Form::select('constructor_id',$constructor, null, array('class' => 'form-control','placeholder' => 'Select Constructor (Builder)') )); ?>

				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<?php echo Form::label("category", "Category:", ["class" => "control-label"]); ?>

					<span style='color:red'>*</span>
					<select name="category" class="form-control" id="" required>
						<option value="">Select Category</option>
						<option value="A" <?php echo e($model->category=='A'?'selected':''); ?>>A</option>
						<option value="B" <?php echo e($model->category=='B'?'selected':''); ?>>B</option>
						<option value="C" <?php echo e($model->category=='C'?'selected':''); ?>>C</option>
						<option value="D" <?php echo e($model->category=='D'?'selected':''); ?>>D</option>
						<option value="E" <?php echo e($model->category=='E'?'selected':''); ?>>E</option>
					</select>
					<span style='color:red'><?php echo e($errors->first('category')); ?></span>
				</div>
			</div>
        </div>

        <div class="row">
			<div class="col-md-6 col-sm-6">
            	<div class="form-group">
            		<input type="hidden" name='plot_id' value='<?= $model->plot_id; ?>'>
					<?php  $plot = DB::table('plots')->where('id',$model->plot_id)->first(); ?>
					<?php echo Form::label("plot", "Plot:", ["class" => "control-label"]); ?>

					<?php if(!empty($plot)){
					?>
						<input type='text'   value='<?= $plot->plot_no; ?>' class='form-control' readonly/>
					<?php
					}else{
						?>
						<input type='text' value='Plot Is Empty' class='form-control' readonly/>
						<?php
					} ?>
				</div>
			</div>
            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					<?php echo Form::label("Duration", "Duration", ["class" => "control-label "]); ?>

					<select name="duaration" id="duaration" class='form-control select duaration'>
						<option value=''>Duration Type</option>
						<option <?php if($model->duaration == '6 Months'){echo 'selected';} ?> value='6 Months'>6 Months</option>
						<option <?php if($model->duaration == '7 Months'){echo 'selected';} ?> value='7 Months'>7 Months</option>
						<option <?php if($model->duaration == '8 Months'){echo 'selected';} ?> value='8 Months'>8 Months</option>
						<option <?php if($model->duaration == '9 Months'){echo 'selected';} ?> value='9 Months'>9 Months</option>
						<option <?php if($model->duaration == '10 Months'){echo 'selected';} ?> value='10 Months'>10 Months</option>
						<option <?php if($model->duaration == '11 Months'){echo 'selected';} ?> value='11 Months'>11 Months</option>
						<option <?php if($model->duaration == '12 Months'){echo 'selected';} ?> value='12 Months'>12 Months</option>
						<option <?php if($model->duaration == '13 Months'){echo 'selected';} ?> value='13 Months'>13 Months</option>
						<option <?php if($model->duaration == '14 Months'){echo 'selected';} ?> value='14 Months'>14 Months</option>
						<option <?php if($model->duaration == '15 Months'){echo 'selected';} ?> value='15 Months'>15 Months</option>
						<option <?php if($model->duaration == '16 Months'){echo 'selected';} ?> value='16 Months'>16 Months</option>
						<option <?php if($model->duaration == '17 Months'){echo 'selected';} ?> value='17 Months'>17 Months</option>
						<option <?php if($model->duaration == '18 Months'){echo 'selected';} ?> value='18 Months'>18 Months</option>
						<option <?php if($model->duaration == '19 Months'){echo 'selected';} ?> value='19 Months'>19 Months</option>
						<option <?php if($model->duaration == '20 Months'){echo 'selected';} ?> value='20 Months'>20 Months</option>
						<option <?php if($model->duaration == '21 Months'){echo 'selected';} ?> value='21 Months'>21 Months</option>
						<option <?php if($model->duaration == '22 Months'){echo 'selected';} ?> value='22 Months'>22 Months</option>
						<option <?php if($model->duaration == '23 Months'){echo 'selected';} ?> value='23 Months'>23 Months</option>
						<option <?php if($model->duaration == '24 Months'){echo 'selected';} ?> value='24 Months'>24 Months</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<?php echo Form::label("Initial Price", "Initial Price:", ["class" => "control-label"]); ?>

                    <?php echo Form::text("initial_price", null, ["class" => "form-control", "Placeholder" => "Enter Initial Price"]); ?>

				</div>
			</div>

            <div class="col-md-6 col-sm-6">
				<div class="form-group">
					<?php echo Form::label("Final Price", "Final Price:", ["class" => "control-label"]); ?>

                    <?php echo Form::text("price", null, ["class" => "form-control", "Placeholder" => "Enter Price"]); ?>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<?php echo Form::label("Status", "Status", ["class" => "control-label "]); ?>

					<select name="status" id="duaration" class='form-control select duaration'>
						<option value=''>Status</option>
						<option <?php if($model->status == 'progress'){echo 'selected';} ?> value='progress'>In Progress</option>
						<option <?php if($model->status == 'completed'){echo 'selected';} ?> value='completed'>Completed</option>
					</select>
				</div>
			</div>
		</div>

		<br>
		<div class="panel-footer">
			<div class='form-group'>
				<?php echo Form::submit('Update', ['class' => 'btn btn-success']); ?>

			</div>
		</div>
	</div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>