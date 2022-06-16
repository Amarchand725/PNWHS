<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo Form::open([
        'route' => 'Construction.store',
        'files' => 'true',
        'class' => "construction_form"
    ]); ?>

        <div class="panel panel-dark">
            <div class="panel-heading">
                <h4 class="panel-title">Create Construction</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php  $constructor = DB::table('constructor')->pluck('name','id'); ?>
                                <?php echo Form::label("constructor", "Constructor:", ["class" => "control-label"]); ?>

                                <span style='color:red'>*</span>
                                <?php echo e(Form::select('constructor_id',$constructor, null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Constructor (Builder)') )); ?>

                                <span style='color:red'><?php echo e($errors->first('constructor')); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label("category", "Category:", ["class" => "control-label"]); ?>

                            <span style='color:red'>*</span>
                            <select name="category" class="form-control" id="" required>
                                <option value="">Select Category</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                            <span style='color:red'><?php echo e($errors->first('category')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                                <?php echo Form::label("plot", "Plot:", ["class" => "control-label"]); ?>

                                <span style='color:red'>*</span>
                                <?php echo e(Form::select('plot_id',$plots, null, array('class' => 'form-control','placeholder' => 'Select Plot') )); ?>

                                <span style='color:red'><?php echo e($errors->first('plot')); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label("initial_price", "Initial Price:", ["class" => "control-label"]); ?>

                            <span style='color:red'>*</span>
                            <?php echo Form::number("initial_price", null, ["class" => "form-control only-numeric", "Placeholder" => "Enter Initial Price", 'required' => 'required']); ?>

                            <span style='color:red'><?php echo e($errors->first('initial_price')); ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label("Duration", "Duration", ["class" => "control-label "]); ?>

                            <span style='color:red'>*</span>
                            <select name="duaration" id="duaration" class='form-control select duaration' required>
                                <option value=''>Duration Type</option>
                                <?php for($i=6; $i<=24; $i++): ?>
                                    <option value='<?php echo e($i); ?> Months'><?php echo e($i); ?> Months</option>
                                <?php endfor; ?>
                            </select>
                            <span style='color:red'><?php echo e($errors->first('duration')); ?></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php echo Form::label("Status", "Status", ["class" => "control-label "]); ?>

                            <select name="status" id="duaration" class='form-control select duaration'>
                                <option value=''>Status</option>
                                <option value='progress'>In Progress</option>
                                <option value='completed'>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                    <br>
                    <div class="panel-footer">
                        <div class='form-group'>
                            <?php echo Form::submit('Submit', ['class' => 'btn btn-success']); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php echo Form::close(); ?>

    <script>
        //Client side validation
        $('.construction_form').validate({
            submitHandler: function(form) {
            form.submit();
            }
        });
        $("#type").change(function(){
            var selected_value = $(this).val();

                var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type: "POST",
                    datatype: 'html',
                    url: "<?php echo url('plotget'); ?>",
                    data: {_token: CSRF_TOKEN,
                    selected_value: selected_value
                },
                success: function(data){
                    if(data){
                        $('#size').html(data);
                    }
                }
            });
        });
        $("#size").change(function(){
            var sizes = $(this).val();
            var plotunique = $('.plotunique').val();
            var property_type = $('.porperty').val();

                var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
                $.ajax({
                    type: "POST",
                    datatype: 'html',
                    url: "<?php echo url('checkplotavailable'); ?>",
                    data: {_token: CSRF_TOKEN,
                        sizes: sizes,
                        plotunique: plotunique,
                        property_type: property_type,

                },
                success: function(data){
                    if(data){
                        if(data == 1){
                            alert('Plot Was Created Not Again');
                            $(this).val('');
                            $('.plotunique').val('');
                            $('.porperty').val('');

                        }
                    }
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>