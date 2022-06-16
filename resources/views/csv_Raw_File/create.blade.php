@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'Csv_Raw_File.store'
]) !!}


<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("file_name", "File_name:", ["class" => "control-label"]) !!}
{!! Form::text("file_name", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_by", "Created_by:", ["class" => "control-label"]) !!}
{!! Form::text("created_by", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Create New Csv_Raw_File', ['class' => 'btn btn-primary']) !!}</div>

{!! Form::close() !!}

@endsection