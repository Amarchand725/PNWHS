@extends('admin.master')
@section('content')

<div class="contentpanel">

    <div class="panel panel-default">
        <div class="panel-body editable-list-group">


            <div class="row editable-list-item">
                <h1>View</h1>
            </div><!-- row -->

            <div class="row editable-list-item">
                <div class="col-sm-3"><b>ID</b></div>
                <div class="col-sm-9">{{$model->id}}</div>
            </div><!-- row -->

            <div class="row editable-list-item">
                <div class="col-sm-3"><b>Name</b></div>
                <div class="col-sm-9">{{$model->name}}</div>
            </div><!-- row -->

            <div class="row editable-list-item">
                <div class="col-sm-3"><b>Description</b></div>
                <div class="col-sm-9">{{$model->description}}</div>
            </div><!-- row -->

            <!-- row -->


        </div><!-- panel-body -->
    </div><!-- panel -->

</div><!-- contentpanel -->
@endsection

