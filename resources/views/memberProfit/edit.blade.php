@extends('admin.master')
@section('content')
    @include('flash_msgs')

    <style>
        input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
            line-height: 10px;
        }
    </style>

    {!! Form::model($model, [
        'method' => 'PATCH',
        'route' => ['MemberProfit.update', $model->id]
    ]) !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            {!! Form::label("rate", "Rate (%):", ["class" => "control-label"]) !!}
            {!! Form::number("rate", null, ["class" => "form-control"]) !!}</div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
            {!! Form::label("effected_date", "Effected_date:", ["class" => "control-label"]) !!}
            {!! Form::date("effected_date", null, ["class" => "form-control"]) !!}</div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
            {!! Form::label("profit_status", "Status:", ["class" => "control-label"]) !!}
            {!! Form::select("status", [1=>'Enable', 0=>'Disable'], null, ["class" => "form-control"]) !!}</div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-6">
            <div class='form-group'>{!! Form::submit('Update MemberProfit', ['class' => 'btn btn-primary']) !!}</div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection