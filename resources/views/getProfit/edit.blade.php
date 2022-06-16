@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['GetProfit.update', $model->id]
]) !!}

<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("profit_rate_id", "Profit_rate_id:", ["class" => "control-label"]) !!}
{!! Form::text("profit_rate_id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("p_no", "P_no:", ["class" => "control-label"]) !!}
{!! Form::text("p_no", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("account_of", "Account_of:", ["class" => "control-label"]) !!}
{!! Form::text("account_of", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("paid_amount", "Paid_amount:", ["class" => "control-label"]) !!}
{!! Form::text("paid_amount", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("profit_amount", "Profit_amount:", ["class" => "control-label"]) !!}
{!! Form::text("profit_amount", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("total_amount", "Total_amount:", ["class" => "control-label"]) !!}
{!! Form::text("total_amount", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Update GetProfit', ['class' => 'btn btn-primary']) !!}</div>



{!! Form::close() !!}

@endsection