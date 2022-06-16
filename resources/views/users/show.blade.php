@extends('admin.master')
@section('content')

    <div class="contentpanel">

        <div class="panel panel-default">
            <div class="panel-body editable-list-group">


                <div class="row editable-list-item">
                    <h1>View</h1>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Name</b></div>
                    <div class="col-sm-9">{{$model->name}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Email</b></div>
                    <div class="col-sm-9">{{$model->email}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>User Type</b></div>
                    <div class="col-sm-9">{{$model->user_type}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Date</b></div>
                    <div class="col-sm-9">{{date('d-F-Y',strtotime($model->created_at))}}</div>
                </div>
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Image</b></div>
                    <?php
                     $jsonimage = json_decode($model->image);
                     if(!empty($jsonimage)){
                        foreach ( $jsonimage as $key => $value) {
                            ?>
    <div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="{{url('/')}}/public/attachment/{{$value}}" /></div>
                            <?php
                         }
                        
                     }
                     else{
                             
                    }
                    
                     ?>
                    
                </div>
                
                <!-- row -->


            </div><!-- panel-body -->
        </div><!-- panel -->

    </div><!-- contentpanel -->
@endsection

