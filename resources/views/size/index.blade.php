@extends('admin.master')
@section('content')
@include('size._search')
<br>
<div class="panel panel-dark">
  <div class="panel-heading">
    <div class="panel-btns">
      <a href="" class="minimize">−</a>
    </div>
    @if(Auth::user()->user_type != 3) 
      <a href="{{ route('Size.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Size</a>
    @endif
    <h4 class="panel-title">Plot Sizes </h4>
  </div>
  
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Plot Size</b></th>
          <th><b>Property Type</b></th>
          <th><b>Description</b></th>
          <th><b>Action</b></th>
        </thead>
        @if(!empty($models))
        <tbody class='ajax_content'>
          <?php $counter = 1; ?>
          @foreach($models as $model)
          <tr>
            <?php
              $shope_user = DB::table('users')->where('id', $model->shop_user_id)->first();
                $shope_sales = DB::table('users')->where('id', $model->sales_id)->first();
              $userType = DB::table('usertype')->where('id', $model->user_type)->first();
            ?>
            <?php
              $created_by = DB::table('users')->where('id', $model->created_by)->first();
            ?>
            <td>{{$counter++}}</td>
            <td>{{$model->name}}</td>
			      <?php
				      $property_types = DB::table('property_type')->where('id', $model->property_type)->first();
            ?>
			      <td>{{ucwords($property_types->name)}}</td>
            <td>{{$model->description}}</td>
            <td>
              <div class="row" style="width:150px !important;">
               @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
                <div class="col-sm-4">
                  <a href="{{ route('Size.edit', $model->id) }}" data-toggle="tooltip"  title="Edit" class="btn btn-primary btn-sm"><i class='fa fa-edit'></i>
                  </a>
                </div>
                @endif
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