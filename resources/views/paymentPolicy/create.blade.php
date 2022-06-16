@extends('admin.master')
@section('content')
    @include('flash_msgs')
    <style>
        #date-input{
            line-height: 10px;
        }
    </style>
 
    {!! Form::open([
        'route' => 'PaymentPolicy.store'
    ]) !!}

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("ranks[]", "Rank:", ["class" => "control-label"]) !!}                
                {!! Form::select("ranks[]", $ranks, null, ["class" => "form-control", "placeholder" => "Select rank", 'data-live-search' => 'true', 'multiple' => 'multiple']) !!}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("registration_payment", "Registration_payment (PKR):", ["class" => "control-label"]) !!}
                {!! Form::number("registration_payment", null, ["class" => "form-control", "placeholder" => "Enter Registration payment"]) !!}</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("insurance_payment", "Insurance (PKR):", ["class" => "control-label"]) !!}
                {!! Form::number("insurance_payment", null, ["class" => "form-control", "placeholder" => "Enter Insurance Payment"]) !!}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("monthly_instalment", "Monthly_instalment (PKR):", ["class" => "control-label"]) !!}
                {!! Form::number("monthly_instalment", null, ["class" => "form-control", "placeholder" => "Enter Monthly Instalment"]) !!}</div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("effective_date", "Effective_date:", ["class" => "control-label"]) !!}
                {!! Form::date("effective_date", null, ["class" => "form-control", "id" => "date-input"]) !!}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("payment_policy_status", "Status:", ["class" => "control-label"]) !!}
                {!! Form::select("status",['1' => 'Enable', '0' => 'Disable'], null, ["class" => "form-control"]) !!}</div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-6">
                <div class='form-group'>{!! Form::submit('Create New PaymentPolicy', ['class' => 'btn btn-primary']) !!}</div>
            </div>
        </div>

    {!! Form::close() !!}
@endsection