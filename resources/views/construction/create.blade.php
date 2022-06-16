@extends('admin.master')
@section('content')
@include('flash_msgs')

    {!! Form::open([
        'route' => 'Construction.store',
        'files' => 'true',
        'class' => "construction_form"
    ]) !!}
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h4 class="panel-title">Create Construction</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <?php  $constructor = DB::table('constructor')->pluck('name','id'); ?>
                                {!! Form::label("constructor", "Constructor:", ["class" => "control-label"]) !!}
                                <span style='color:red'>*</span>
                                {{ Form::select('constructor_id',$constructor, null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Select Constructor (Builder)') ) }}
                                <span style='color:red'>{{ $errors->first('constructor') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            {!! Form::label("category", "Category:", ["class" => "control-label"]) !!}
                            <span style='color:red'>*</span>
                            <select name="category" class="form-control" id="" required>
                                <option value="">Select Category</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                            <span style='color:red'>{{ $errors->first('category') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                                {!! Form::label("plot", "Plot:", ["class" => "control-label"]) !!}
                                <span style='color:red'>*</span>
                                {{ Form::select('plot_id',$plots, null, array('class' => 'form-control','placeholder' => 'Select Plot') ) }}
                                <span style='color:red'>{{ $errors->first('plot') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            {!! Form::label("initial_price", "Initial Price:", ["class" => "control-label"]) !!}
                            <span style='color:red'>*</span>
                            {!! Form::number("initial_price", null, ["class" => "form-control only-numeric", "Placeholder" => "Enter Initial Price", 'required' => 'required']) !!}
                            <span style='color:red'>{{ $errors->first('initial_price') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            {!! Form::label("Duration", "Duration", ["class" => "control-label "]) !!}
                            <span style='color:red'>*</span>
                            <select name="duaration" id="duaration" class='form-control select duaration' required>
                                <option value=''>Duration Type</option>
                                @for($i=6; $i<=24; $i++)
                                    <option value='{{ $i }} Months'>{{ $i }} Months</option>
                                @endfor
                            </select>
                            <span style='color:red'>{{ $errors->first('duration') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            {!! Form::label("Status", "Status", ["class" => "control-label "]) !!}
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
                            {!! Form::submit('Submit', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
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
@endsection
