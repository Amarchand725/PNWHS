@extends('admin.master')
@section('content')
@include('rights._search')
<br>
<div class="panel panel-dark">
  <div class="panel-heading">
    <div class="panel-btns">
      <a href="" class="panel-close">×</a>
      <a href="" class="minimize">−</a>
    </div>
    <a href="{{ route('Rights.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Rights</a>
    <h4 class="panel-title">Manage Rights </h4>
  </div>
  
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Name</b></th>
          <th><b>Date</b></th>
          <th><b>Action</b></th>
        </thead>
        @if(!empty($models))
        <tbody class='ajax_content'>
          <?php $counter = 1; ?>
          @foreach($models as $model)
          <tr>
            <td>{{$counter++}}</td>
            <td>{{$model->name}}</td>
            <td>{{!empty($model->created_at) ? date('l jS F Y', strtotime($model->created_at)) : "-"}}</td>
            <td>
              <div class="row" style="width:150px !important;">
                <div class="col-sm-4">
                  <a href="{{ route('Rights.edit', $model->id) }}" data-toggle="tooltip"  title="Edit" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span>
                  </a>
                </div>
                <div class="col-sm-4">
                  <a href="{{ route('Rights.show', $model->id) }}" data-toggle="tooltip"  title="View" class="btn btn-info"> <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
                </div>
                <div class="col-sm-4">
                    {!!Form::open(['action' => ['RightsController@destroy', $model->id], 'method' => 'POST' ,'onclick' => 'return confirm("Are you sure you want to delete?");'])!!}
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