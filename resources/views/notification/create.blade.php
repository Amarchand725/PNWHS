@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'Notification.store'
]) !!}


<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("record_id", "Record_id:", ["class" => "control-label"]) !!}
{!! Form::text("record_id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("order_for", "Order_for:", ["class" => "control-label"]) !!}
{!! Form::text("order_for", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("seen", "Seen:", ["class" => "control-label"]) !!}
{!! Form::text("seen", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("seperate_view", "Seperate_view:", ["class" => "control-label"]) !!}
{!! Form::text("seperate_view", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("title", "Title:", ["class" => "control-label"]) !!}
{!! Form::text("title", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Create New Notification', ['class' => 'btn btn-primary']) !!}</div>

{!! Form::close() !!}

@endsection