@extends('admin.master')
@section('content')
    <div class="contentpanel">
        <div class="panel panel-default">
            <div class="panel-body editable-list-group">
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Name</b></div>
                    <div class="col-sm-9">{{$model->name}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Email</b></div>
                    <div class="col-sm-9">{{$model->email}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Mobile Number</b></div>
                    <div class="col-sm-9">{{$model->mobile_no}}</div>
                </div><!-- row -->
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Description</b></div>
                    <div class="col-sm-9">{{$model->description}}</div>
                </div>
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Address</b></div>
                    <div class="col-sm-9">{{$model->address??'N/A'}}</div>
                </div>
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Date</b></div>
                    <div class="col-sm-9">{{date('d-F-Y',strtotime($model->created_at))}}</div>
                </div>
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Company Logo</b></div>
                    <div class="col-sm-9">
                        @if(!empty($model->image))
                            <div class='col-md-4'>
                                <a href='<?= url('public/attachment/'.$model->image); ?>'>
                                    <img class='img-responsive img-thumbnail' style='width:100%;height:170px;' src='<?= url('public/attachment/'.$model->image); ?>' />
                                </a>
                            </div>
                        @else
                            <span>No Found Logo</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
