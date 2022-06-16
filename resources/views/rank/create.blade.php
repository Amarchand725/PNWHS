@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => 'Rank.store',
    'class' => "rank_form"
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
            {!! Form::text("name", null, ["class" => "form-control", "placeholder" => "Enter Rank", 'required' => 'required']) !!}
            <span style='color:red'>{{ $errors->first('name') }}</span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label("category", "Category:", ["class" => "control-label"]) !!}
            <select name="category" class="form-control" id="" required>
                <option value="">Select Category</option>
                @foreach ($house_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("rank_status", "Status:", ["class" => "control-label"]) !!}
        {!! Form::select("status", ['1' => 'Enable', '0' => 'Disable'], null, ["class" => "form-control"]) !!}</div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-sm-6">
        <div class='form-group'>{!! Form::submit('Create New Rank', ['class' => 'btn btn-primary']) !!}</div>
    </div>
</div>
{!! Form::close() !!}

<script>
    //Client side validation
    $('.rank_form').validate({
        submitHandler: function(form) {
          form.submit();
        }
    });
</script>
@endsection