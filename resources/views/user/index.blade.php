@extends('admin.master')
@section('content')
@include('user._search')
<br><br>
<div class="panel panel-dark">
  <div class="panel-heading">
    <div class="panel-btns">
      <a href="" class="panel-close">×</a>
      <a href="" class="minimize">−</a>
    </div>
    <a href="{{ route('User.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create User</a>
    <h4 class="panel-title">Manage User </h4>
  </div>
  
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Name</b></th>
          <th><b>Email</b></th>
          <th><b>Mobile No</b></th>
          <th><b>User Type</b></th>
          <th><b>Created By</b></th>
          <th><b>Action</b></th>
        </thead>
        @if(!empty($models))
        <tbody class='ajax_content'>
          <?php $counter = 1; ?>
          @foreach($models as $model)
          <tr>
            <?php
                $userType = DB::table('usertype')->where('id', $model->user_type)->first();
                $created_by = DB::table('users')->where('id', $model->created_by)->first();
            ?>
            <td>{{$counter++}}</td>
            <td>{{$model->first_name}} {{$model->last_name}}</td>
            <td>{{$model->email}}</td>
            <td>{{$model->mobile_no}}</td>
            <td>{{!empty($userType->name) ? $userType->name : "Super Admin"}}</td>
            <td style="color: green">{{!empty(!empty($created_by->user_name)) ? $created_by->user_name : "-"}}</td>
            <td>
              <div class="row" style="width:150px !important;">
                <div class="col-sm-4">
                  <a href="{{ route('User.edit', $model->id) }}" data-toggle="tooltip"  title="Edit" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span>
                  </a>
                </div>
                <div class="col-sm-4">
                  <a href="{{ route('User.show', $model->id) }}" data-toggle="tooltip"  title="View" class="btn btn-info"> <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
                </div>
                <div class="col-sm-4">
                    {!!Form::open(['action' => ['UserController@destroy', $model->id], 'method' => 'POST' ,'onclick' => 'return confirm("Are you sure you want to delete?");'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                  <button type='submit' class="btn btn-danger" data-toggle="tooltip"  title="Delete">
                    <span class="glyphicon glyphicon-trash"></span>
                  </button>
                    {!!Form::close()!!}
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