{!! Form::model($formModel, [
    'route' => 'MonthlyInstalment.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("p_no", "P_no:", ["class" => "control-label"]) !!}
        {!! Form::text("p_no", null, ["class" => "form-control", 'placeholder' => 'Search by P. No']) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("amount", "Amount:", ["class" => "control-label", 'placeholder' => 'Search by Amount']) !!}
        {!! Form::text("amount", null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("paid_date", "Paid_date:", ["class" => "control-label"]) !!}
        {!! Form::text("paid_date", null, ["class" => "form-control", 'placeholder' => 'Search by Paid Date']) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div>
</div>


{!! Form::close() !!}