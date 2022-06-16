@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Rank.update', $model->id]
]) !!}

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
        {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
        {!! Form::text("name", null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label("category", "Category:", ["class" => "control-label"]) !!}
            <select name="category" class="form-control" id="">
                <option value="">Select Category</option>
                @foreach ($house_categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id==$model->category?'selected':'' }}>{{ $category->name }}</option>
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
        <div class='form-group'>{!! Form::submit('Update Rank', ['class' => 'btn btn-primary']) !!}</div>
    </div>
</div>

{!! Form::close() !!}

@endsection