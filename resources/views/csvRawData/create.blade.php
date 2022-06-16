@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'CsvRawData.store'
]) !!}


<div class="form-group">
{!! Form::label("csv_raw_file_id", "Csv_raw_file_id:", ["class" => "control-label"]) !!}
{!! Form::text("csv_raw_file_id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("p_no", "P_no:", ["class" => "control-label"]) !!}
{!! Form::text("p_no", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("rank", "Rank:", ["class" => "control-label"]) !!}
{!! Form::text("rank", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
{!! Form::text("name", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("submitted_amount", "Submitted_amount:", ["class" => "control-label"]) !!}
{!! Form::text("submitted_amount", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("date", "Date:", ["class" => "control-label"]) !!}
{!! Form::text("date", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Create New CsvRawData', ['class' => 'btn btn-primary']) !!}</div>

{!! Form::close() !!}

@endsection