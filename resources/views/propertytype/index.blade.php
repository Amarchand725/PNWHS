
@extends('admin.master')
@section('content')
@include('propertytype._search')


<br>
<div class="panel panel-dark">
  <div class="panel-heading">
     @if(Auth::user()->user_type != 3) 
    <a href="{{ route('Propertytype.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Property Type</a>
    @endif
    <h4 class="panel-title">Property Type</h4>
  </div>
  
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Name</b></th>
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
            <td><?= ucwords($model->name); ?></td>
            <td><?= ucwords($model->description); ?></td>
         
            <td>
              <div class="row" style="width:150px !important;">
               @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
                <div class="col-sm-4">
                  <a href="{{ route('Propertytype.edit', $model->id) }}" data-toggle="tooltip"  title="Edit" class="btn btn-primary btn-sm"><i class='fa fa-edit'></i>
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