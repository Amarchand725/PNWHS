@extends('admin.master')
@section('content')
    @include('flash_msgs')
    <div class="container">
        <div class="col-md-9 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading" style='color: #fff; background-color: #428bca; border-color: #357ebd;'><i class='fa fa-file'></i> Excel Import</div>

                <div class="panel-body">
                    <div class='row'>
                        <div class='col-sm-12'>
                            <div style='float:right'>
                                <a href="{{ url('download_sheet_sample') }}" title='Download sheet sample from here.'><i class='fa fa-download'></i> Download Sheet Sample</a>
                            </div>
                        </div>
                    </div>

                    <!-- Monthly Record Sheet -->
                    <form class="form-horizontal" method="POST" action="{{ url('parse_file') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">    
                                    <label for="csv_file" class="control-label"><b><i class="fa fa-check"></i> Upload Monthly Records Sheet</b></label>
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    <span id='error' style='color:red'>{{ $errors->first('csv_file') }}</span>
                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-1">
                                    <button type="submit" name="submit" value="monthly-sheet" title="Monthly Record Sheet" class="btn btn-primary">
                                        Parse Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br />
                    </form>
                    <hr />
                    <!-- Six Month Record Sheet -->
                    <form class="form-horizontal" method="POST" action="{{ url('parse_file') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">    
                                    <label for="csv_file" class="control-label"><b><i class="fa fa-check"></i> Upload Six Month's Records Sheet</b></label>
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    <span id='error' style='color:red'>{{ $errors->first('csv_file') }}</span>
                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-1">
                                    <button type="submit" name="submit" value="six-month-sheet" title="Six Month's Record Sheet" class="btn btn-primary">
                                        Parse Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br />
                    </form>
                    <hr />
                    <!-- Monthly Previouse Record Sheet -->
                    <form class="form-horizontal" method="POST" action="{{ url('parse_file') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">    
                                    <label for="csv_file" class="control-label"><b><i class="fa fa-check"></i> Upload Monthly Previous Records Sheet</b></label>
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    <span id='error' style='color:red'>{{ $errors->first('csv_file') }}</span>
                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-1">
                                    <button type="submit" name="submit" value="monthly-previouse-sheet" title="Monthly Previouse Record Sheet" class="btn btn-primary">
                                        Parse Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br />
                    </form>
                    <hr />
                    <!-- Six Month's Previouse Record Sheet -->
                    <form class="form-horizontal" method="POST" action="{{ url('parse_file') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">    
                                    <label for="csv_file" class="control-label"><b><i class="fa fa-check"></i> Upload Six Month's Previous Records Sheet</b></label>
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    <span id='error' style='color:red'>{{ $errors->first('csv_file') }}</span>
                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('csv_file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-1">
                                    <button type="submit" name="submit" value="six-month-previouse-sheet" title="Six Month's Previouse Record Sheet" class="btn btn-primary">
                                        Parse Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" language="javascript">
        function checkfile(sender) {
            var validExts = new Array(".xlsx", ".xls");
            var fileExt = sender.value;
            fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
            if (validExts.indexOf(fileExt) < 0) {
                $('#error').text("* Invalid file selected, valid files are of " +
                validExts.toString() + " types.");
                $("#csv_file").val(null);
                return false;
            }else return true;
        }
    </script>
@endsection
