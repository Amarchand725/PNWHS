@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'GalleryImage.store',
    'enctype' => "multipart/form-data"
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label("name", "Select Image(s):", ["class" => "control-label"]) !!}
            <input type="file" name="images[]" multiple class="form-control">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("imgstatus", "Status:", ["class" => "control-label"]) !!}
        {!! Form::select("status", ['1' => 'Active', '0' => 'Inactive'], null, ["class" => "form-control"]) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Create New GalleryImage', ['class' => 'btn btn-primary']) !!}</div>
    </div>
</div>

{!! Form::close() !!}

@endsection