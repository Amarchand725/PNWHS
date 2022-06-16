{!! Form::model($formModel, [
    'route' => 'MemberProfit.index',
    'method' => 'get'
]) !!}

<style>
    input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
        line-height: 10px;
    }
</style>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("rate", "Rate:", ["class" => "control-label"]) !!}
        {!! Form::number("rate", null, ["class" => "form-control", "placeholder" => "Search by profit rate"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("effected_date", "Effected_date:", ["class" => "control-label"]) !!}
        {!! Form::date("effected_date", null, ["class" => "form-control", "placeholder" => "Search by effected date"]) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div>
</div>
{!! Form::close() !!}