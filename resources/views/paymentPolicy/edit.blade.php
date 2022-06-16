@extends('admin.master')
@section('content')
    @include('flash_msgs')
    <style>
        #date-input{
            line-height: 10px;
        }
        /* The container */
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default radio button */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .container .checkmark:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }
    </style>

    {!! Form::model($model, [
        'method' => 'PATCH',
        'route' => ['PaymentPolicy.update', $model->id]
    ]) !!}

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("ranks[]", "Rank_id:", ["class" => "control-label"]) !!}
                {!! Form::select("ranks[]", $ranks, $selected, ["class" => "form-control", "placeholder" => "Select Rank", "multiple" => "multiple"]) !!}</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                {!! Form::label("registration_payment", "Registration_payment (PKR):", ["class" => "control-label"]) !!}
                {!! Form::number("registration_payment", null, ["class" => "form-control"]) !!}</div>
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
                {!! Form::number("monthly_instalment", null, ["class" => "form-control"]) !!}</div>
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
                {!! Form::select("status", ['1' => 'Enable', '0' => 'Disable'], null, ["class" => "form-control", "id" => "date-input"]) !!}</div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-sm-6">
                <div class='form-group'>{!! Form::submit('Update PaymentPolicy', ['class' => 'btn btn-primary']) !!}</div>
            </div>
        </div>

    {!! Form::close() !!}

    <script>
        $(document).on('change', '.insurance-status', function(){
            var insorunce_status = $(this).attr('data-status');
            var html = '';
            if(insorunce_status=='no'){
                $('#insurance').html('');
            }else{
                html +='<div class="form-group">'+
                            '<label>Insurance</label>'+
                            '<input class="form-control" type="number" name="insurance-instalment" placeholder="Enter insurance instalment" />'+
                        '</div>';
                $('#insurance').html(html);
            }
        });
    </script>
@endsection