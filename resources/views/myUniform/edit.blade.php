@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['MyUniform.update', $model->id]
]) !!}

<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
{!! Form::text("name", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("number", "Number:", ["class" => "control-label"]) !!}
{!! Form::text("number", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Update MyUniform', ['class' => 'btn btn-primary']) !!}</div>



{!! Form::close() !!}

@endsection