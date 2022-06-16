@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['MonthlyInstalment.update', $model->id]
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("p_no", "P_no:", ["class" => "control-label"]) !!}
        {!! Form::number("p_no", null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("amount", "Amount:", ["class" => "control-label"]) !!}
        {!! Form::number("amount", null, ["class" => "form-control"]) !!}</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">  
        <div class="form-group">
        {!! Form::label("paid_date", "Paid_date:", ["class" => "control-label"]) !!}
        {!! Form::date("paid_date", null, ["class" => "form-control"]) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Update MonthlyInstalment', ['class' => 'btn btn-primary']) !!}</div>
    </div>
</div>



{!! Form::close() !!}

@endsection