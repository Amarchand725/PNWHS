@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'Teste.store'
]) !!}


<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
{!! Form::text("name", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Create New Teste', ['class' => 'btn btn-primary']) !!}</div>

{!! Form::close() !!}

@endsection