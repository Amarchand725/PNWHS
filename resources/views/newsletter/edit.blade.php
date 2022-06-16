@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Newsletter.update', $model->id]
]) !!}

<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("user_id", "User_id:", ["class" => "control-label"]) !!}
{!! Form::text("user_id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("subject", "Subject:", ["class" => "control-label"]) !!}
{!! Form::text("subject", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("title", "Title:", ["class" => "control-label"]) !!}
{!! Form::text("title", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("file", "File:", ["class" => "control-label"]) !!}
{!! Form::text("file", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("expiry_date", "Expiry_date:", ["class" => "control-label"]) !!}
{!! Form::text("expiry_date", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Update Newsletter', ['class' => 'btn btn-primary']) !!}</div>



{!! Form::close() !!}

@endsection