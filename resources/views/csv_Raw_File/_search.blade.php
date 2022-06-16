{!! Form::model($formModel, [
    'route' => 'Csv_Raw_File.index',
    'method' => 'get'
]) !!}



<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("file_name", "File_name:", ["class" => "control-label"]) !!}
{!! Form::text("file_name", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_by", "Created_by:", ["class" => "control-label"]) !!}
{!! Form::text("created_by", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>


{!! Form::close() !!}