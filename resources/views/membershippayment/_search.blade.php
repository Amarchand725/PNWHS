{!! Form::model($formModel, [
    'route' => 'Membershippayment.index',
    'method' => 'get'
]) !!}



<div class="row">
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label("Membership Payment", "Registration Fees:", ["class" => "control-label"]) !!}
        {!! Form::text("mpayment", null, ["class" => "form-control"]) !!}
        </div>
</div>
</div>
<div class='clearfix'></div>
<div class='row'>
<div class="col-md-4">
    <div class="form-group">
    {!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit','style' => 'margin-top: 4%;']) !!}
        </div>
</div>
</div>


{!! Form::close() !!}
