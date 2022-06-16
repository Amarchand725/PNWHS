{!! Form::model($formModel, [
    'route' => 'AllotedHouse.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("p_no", "P.No:", ["class" => "control-label"]) !!}
        {!! Form::number("p_no", null, ["class" => "form-control", "placeholder" => "Search by P.NO"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("allocated_house", "Allocated House:", ["class" => "control-label"]) !!}
        {!! Form::text("allocated_house", null, ["class" => "form-control", "placeholder" => "Search by Allocated House No"]) !!}</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("allocated_account_of", "Allocated Account Of:", ["class" => "control-label"]) !!}
        {!! Form::text("allocated_account_of", null, ["class" => "form-control", "placeholder" => "Search by Allocated Account Of"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("house_dues_instalment", "House Instalment:", ["class" => "control-label"]) !!}
        {!! Form::number("house_dues_instalment", null, ["class" => "form-control", "placeholder" => "Search by House Installment"]) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div>
</div>

{!! Form::close() !!}