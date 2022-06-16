@extends('admin.master')
@section('content')
    @include('flash_msgs')
    
    {!! Form::open([
        'route' => 'HouseCost.store'
    ]) !!}

	<br>
	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title"> Add New House</h4>
		</div>
		<div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("category_id", "House Category:", ["class" => "control-label"]) !!}
                        <select name="category_id" id="" class='form-control'>
                            <option value="" selected>Select house category</option>
                            @foreach($house_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <span style='color:red'>{{ $errors->first('category_id') }}</span>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("initial_cost", "House Initial Cost:", ["class" => "control-label"]) !!}
                        {!! Form::number("initial_cost", null, ["class" => "form-control", "placeholder" => "Enter House Cost"]) !!}
                        <span style='color:red'>{{ $errors->first('initial_cost') }}</span>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-sm-6">
                    <div class='form-group'>{!! Form::submit('Create New HouseCost', ['class' => 'btn btn-primary']) !!}</div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection