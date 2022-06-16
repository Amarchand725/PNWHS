{!! Form::model($formModel, [
    'route' => 'GalleryImage.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
        {!! Form::text("name", null, ["class" => "form-control", "placeholder" => "Search by Image Name"]) !!}</div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        {!! Form::label("img_status", "Status:", ["class" => "control-label"]) !!}
        {!! Form::select("status",['1' => 'Active', '0' => 'Inactive'], null, ["class" => "form-control", "placeholder" => "Search by Status"]) !!}</div>
    </div>
    <br />
    <div class="col-sm-4">
        <div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div>
</div>

{!! Form::close() !!}