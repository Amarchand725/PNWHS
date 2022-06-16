<style>
    #date-input{
        line-height: 10px;
    }
</style>

{!! Form::model($formModel, [
    'route' => 'PaymentPolicy.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("registration_payment", "Registration_payment:", ["class" => "control-label"]) !!}
        {!! Form::number("registration_payment", null, ["class" => "form-control", "placeholder" => "Search by Registration Payment"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("monthly_instalment", "Monthly_instalment:", ["class" => "control-label"]) !!}
        {!! Form::number("monthly_instalment", null, ["class" => "form-control", "placeholder" => "Search by Monthly Instalment"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">    
        {!! Form::label("effective_date", "Effective_date:", ["class" => "control-label"]) !!}
        {!! Form::date("effective_date", null, ["class" => "form-control", "id" => "date-input", "placeholder" => "Search by Effective Date"]) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div>
</div>
{!! Form::close() !!}