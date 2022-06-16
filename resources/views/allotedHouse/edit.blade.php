@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['AllotedHouse.update', $model->id]
]) !!}

<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("p_no", "P_no:", ["class" => "control-label"]) !!}
{!! Form::text("p_no", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("allocated_house", "Allocated_house:", ["class" => "control-label"]) !!}
{!! Form::text("allocated_house", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("allocated_account_of", "Allocated_account_of:", ["class" => "control-label"]) !!}
{!! Form::text("allocated_account_of", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("house_dues_instalment", "House_dues_instalment:", ["class" => "control-label"]) !!}
{!! Form::text("house_dues_instalment", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("allocated_by", "Allocated_by:", ["class" => "control-label"]) !!}
{!! Form::text("allocated_by", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Update AllotedHouse', ['class' => 'btn btn-primary']) !!}</div>



{!! Form::close() !!}

@endsection