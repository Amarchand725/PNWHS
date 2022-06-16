
@extends('admin.master')
@section('content')
@include('plot._search')


<br>
<div class="panel panel-dark">
  <div class="panel-heading">
    <a href="{{ route('Plot.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Plot</a>
 
    <h4 class="panel-title">Manage Plots</h4>
  </div>
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Plot No</b></th>
          <th><b>Type</b></th>
          <th><b>Size</b></th>
          <th><b>Block</b></th>
          <th><b>Amount</b></th>
          <th><b>Plot Status</b></th>
          <th><b>Action</b></th>
        </thead>
        @if(!empty($models))
        <tbody class='ajax_content'>
          <?php $counter = 1; ?>
          @foreach($models as $model)
          <tr>
            <td>{{$counter++}}</td>
            <td>{{$model->plot_no}}</td>
            <?php $typee =  DB::table('property_type')->where('id',$model->type)->first(); ?>
            <td>{{$typee->name}}</td>
            <?php $sizee =  DB::table('size')->where('id',$model->size)->first(); ?>
            <td>{{$model->hasSize->name}}</td>
            <td>
            <?php
              $blocks =  DB::table('block')->where('id',$model->block)->first();
              if(!empty($blocks)){
                echo  $blocks->name;
              }
            ?>
            </td>
            <td>{{ number_format($model->amount) }}</td>
            <td>
              @if($model->plot_status==1)
                <span class='label label-success'> Available</span>
              @else
                <span class='label label-danger'> Not Available</span>
              @endif
            </td>
            <td>
              <div class="row" style="width:150px !important;">
                <div class="col-sm-4">
                  <a href="{{ route('Plot.edit', $model->id) }}" data-toggle="tooltip"  title="Edit" class="btn btn-primary btn-sm"><i class='fa fa-edit'></i>
                  </a>
                </div>
              </div>
            </td> 
          </tr>
          @endforeach
        </tbody>
        @endif
      </table>
    </div>
  </div>
</div>

@endsection