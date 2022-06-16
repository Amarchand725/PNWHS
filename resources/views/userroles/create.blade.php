@extends('admin.master')
@section('content')
@include('flash_msgs')
{!! Form::open([
    'route' => 'Userroles.store',
    'files' => 'true'
]) !!}
<div class="col-md-12">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Create Roles</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("role", "Role:", ["class" => "control-label"]) !!}
                        <span style='color:red'>*</span>
                        {!! Form::text("role", null, ["class" => "form-control"]) !!}
                        <span style='color:red'>{{$errors->first('role')}}</span>
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