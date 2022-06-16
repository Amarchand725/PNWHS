@extends('admin.master')
@section('content')
    @include('flash_msgs')

    {!! Form::model($model, [
        'method' => 'PATCH',
        'route' => ['CsvFile.update', $model->id],
        'enctype' => 'multipart/form-data'
    ]) !!}

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading" style='background-color:#428bca; color: #fff; border-color: #357ebd;'><i class='fa fa-file'></i> Update Excel Import <small style='color:yellow'>(Note: If you will upload again sheet will be replaced)</small></div>
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label"> Excel file to import</label>

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Parse Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection