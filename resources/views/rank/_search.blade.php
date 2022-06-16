{!! Form::model($formModel, [
    'route' => 'Rank.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
        {!! Form::text("name", null, ["class" => "form-control", "placeholder" => "Search by Rank"]) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div>
</div>

{!! Form::close() !!}