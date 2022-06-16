{!! Form::model($formModel, [
    'route' => 'Plot.index',
    'method' => 'get'
]) !!}

<div class="row">
<div class="col-md-4">
    <div class="form-group">
        {!! Form::label("plot", "Plot No:", ["class" => "control-label"]) !!}
        {!! Form::number("plot_no", null, ["class" => "form-control", "placeholder" => "Search by plot no"]) !!}</div>
</div>

<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div></div>
{!! Form::close() !!}