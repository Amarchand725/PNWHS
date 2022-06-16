{!! Form::model($formModel, [
    'route' => 'Size.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label("Size", "Size:", ["class" => "control-label"]) !!}
            {!! Form::text("name", null, ["class" => "form-control", 'Search by plot size']) !!}
            </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-4">
            <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
        </div>
    </div>
</div>

{!! Form::close() !!}