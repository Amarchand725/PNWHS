{!! Form::model($formModel, [
    'route' => 'CsvFile.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        {!! Form::label("file_name", "File_name:", ["class" => "control-label"]) !!}
        {!! Form::text("file_name", null, ["class" => "form-control", "placeholder" => "Search by CSV File Name"]) !!}</div>
    </div>

    <br />
    <div class="col-sm-4">
        <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div>
</div>

{!! Form::close() !!}