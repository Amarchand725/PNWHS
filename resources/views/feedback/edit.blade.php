

@extends('admin.master')
@section('content')
@include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Feedback.update', $model->id]
]) !!}


<div class="col-md-12">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Create Feedback</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        {!! Form::label("title", "Title:", ["class" => "control-label"]) !!}
                        {!! Form::text("title", null, ["class" => "form-control"]) !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    {!! Form::label("description", "Description:", ["class" => "control-label"]) !!}

                <textarea id="description" name="description" class="form-control" placeholder="Feedback description" >{{ $model->description }}</textarea>

                </div>
                </div>
            </div>


        </div>
        <div class="panel-footer">
            <div class="form-group">
                {!! Form::submit('Create New Feedback', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
@endsection
