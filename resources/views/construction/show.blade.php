@extends('admin.master')
@section('content')

    <div class="contentpanel">

        <div class="panel panel-default">
            <div class="panel-body editable-list-group">


                <div class="row editable-list-item">
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Constructor</b></div>
                    <?php $cons =  DB::table('constructor')->where('id',$model->constructor_id)->first(); ?>
					 
                    <div class="col-sm-9">{{$cons->name}} </div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Plot</b></div>
                    <?php $plot =  DB::table('plots')->where('id',$model->plot_id)->first(); ?>
                    <div class="col-sm-9">{{$plot->plot_no??'--'}}</div>
                </div><!-- row -->

                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Duaration</b></div>
                    <div class="col-sm-9">{{$model->duaration}}</div>
                </div><!-- row -->
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Price</b></div>
                    <div class="col-sm-9">
                    <?php
				 if(!empty($model->price)){
				echo $cnr->gettypenumber($model->price);
				 }
				 else{
					echo '-';
				 }
				?>
                    
                    </div>
                </div>
                
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>
                    Initial Price
                    </b></div>
                    <div class="col-sm-9">
                    
                    <?php
				 if(!empty($model->initial_price)){
				echo $cnr->gettypenumber($model->initial_price);
				 }
				 else{
					echo '-';
				 }
				?>
                    </div>
                </div>
                <div class="row editable-list-item">
                    <div class="col-sm-3"><b>Date</b></div>
                    <div class="col-sm-9">{{date('d-F-Y',strtotime($model->created_at))}}</div>
                </div>
                
                
                <!-- row -->


            </div><!-- panel-body -->
        </div><!-- panel -->

    </div><!-- contentpanel -->
@endsection