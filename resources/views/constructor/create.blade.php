@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'Contractor.store',
    'files' => 'true'
]) !!}


<div class="col-md-12">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Create Contractor</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
                        {!! Form::text("name", null, ["class" => "form-control", "placeholder" => "Enter Name"]) !!}
                        <span style='color:red'>{{ $errors->first('name') }}</span>
                    </div>
                </div>
            
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("mobile_no", "Mobile Number:", ["class" => "control-label"]) !!}
                        {!! Form::text("mobile_no", null, ["class" => "form-control mobile", "maxlength" => "11", "placeholder" => "Enter Mobile No"]) !!}
                        <span style='color:red'>{{ $errors->first('mobile_no') }}</span>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("email", "Email:", ["class" => "control-label"]) !!}
                        {!! Form::email("email", null, ["class" => "form-control", "placeholder" => "Enter Correct Email"]) !!}
                        <span style='color:red'>{{ $errors->first('email') }}</span>
                    </div>
                </div>
           
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("description", "Description:", ["class" => "control-label"]) !!}
                        {!! Form::textarea("description", null, ["class" => "form-control" , 'cols' => "2" , "rows" => "4", "placeholder" => "Enter description"]) !!}
                    </div>
                </div>
           
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("Address", "Address:", ["class" => "control-label"]) !!}
                        {!! Form::textarea("address", null, ["class" => "form-control" , 'cols' => "2" , "rows" => "4", "placeholder" => "Enter Full Address"]) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("image", "Images:", ["class" => "control-label"]) !!}
                        <input type="file" name="image" class="form-control" accept="image/x-png,image/jpeg">
                        <span style='color:red'>{{ $errors->first('image') }}</span>
                    </div>
                </div>
           </div>
        </div>
        <div class="panel-footer">
            <div class="form-group">
                {!! Form::submit('Create New Users', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}

@endsection