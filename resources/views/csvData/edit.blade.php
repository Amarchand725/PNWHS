@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['CsvData.update', $model->id]
]) !!}

<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("csv_file_id", "Csv_file_id:", ["class" => "control-label"]) !!}
{!! Form::text("csv_file_id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("p_no", "P_no:", ["class" => "control-label"]) !!}
{!! Form::text("p_no", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("deducted_amount", "Deducted_amount:", ["class" => "control-label"]) !!}
{!! Form::text("deducted_amount", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("deducted_date", "Deducted_date:", ["class" => "control-label"]) !!}
{!! Form::text("deducted_date", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Update CsvData', ['class' => 'btn btn-primary']) !!}</div>



{!! Form::close() !!}

@endsection