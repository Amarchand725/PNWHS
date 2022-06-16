@extends('admin.master')
@section('content')
@include('flash_msgs')
{!! Form::open([
'route' => 'Size.store',
 'name' => 'sizeform'
]) !!}
<div class="panel panel-dark">
    <div class="panel-heading">
        <h4 class="panel-title">Create Plot Size</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    {!! Form::label("Size", "Size:", ["class" => "control-label"]) !!}
                    <span style='color:red;'>*</span>
                    {!! Form::text("name", null, ["class" => "form-control", "Placeholder" => "Enter Size"]) !!}
                </div>
            </div>
        <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    {!! Form::label("description", "Description:", ["class" => "control-label"]) !!}
                    {!! Form::textarea("description", null, ["class" => "form-control", "rows" => 3, "Placeholder" => "Enter Description"]) !!}
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    {!! Form::label("propertytype", "Property Type", ["class" => "control-label "]) !!}
                    <span style='color:red;'>*</span>
                    <select name="type" id="type" class='form-control select porperty'>
                    <option value=''>Select Type</option>
                    <?php
                        $property_id= DB::table('property_type')->get(); 
                        foreach ($property_id as $key => $type) {
                            ?>
                            <option value='<?= $type->id?>'>{{$type->name}}</option>
                            <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div class="panel-footer">
            <div class='form-group'>
                {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
<script>
$(function() {
        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='sizeform']").validate({
            rules: {
                name: "required",
                type: "required",
            },
            // Specify validation error messages
            messages: {
                name: "Please enter your name",
                type: "Please enter type",
            },
            errorPlacement: function(error, element){
                if ( element.is(":radio") )
                {
                    error.appendTo( element.parents('.form-group') );
                }
                else
                { // This is the default behavior
                    error.insertAfter( element );
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection