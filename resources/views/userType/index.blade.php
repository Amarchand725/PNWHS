@extends('admin.master')
@section('content')
@include('usertype._search')
<br><br>
<div class="panel panel-dark">
  <div class="panel-heading">
    <div class="panel-btns">
      <a href="" class="panel-close">×</a>
      <a href="" class="minimize">−</a>
    </div>
    <a href="{{ route('UserType.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create User Type</a>
    <h4 class="panel-title">Manage UserType </h4>
  </div>
  
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Name</b></th>
          <th><b>User Rights</b></th>
          <th><b>Date</b></th>
          <th><b>Action</b></th>
        </thead>
        @if(!empty($models))
        <tbody class='ajax_content'>
          <?php $counter = 1; ?>
          @foreach($models as $model)
          <?php $right_ids = json_decode($model->rights_id); ?>
          <tr>
            <td>{{$counter++}}</td>
            <td>{{$model->name}}</td>
            <td>
              @if(!empty($right_ids))
                @foreach($right_ids as $right_id)
                    <?php $right_name = DB::table('rights')->where('id', $right_id)->first(); ?>
                   - {{!empty($right_name->name) ? $right_name->name : "-"}} <br>
                @endforeach
              @endif
            </td>
            <td>{{!empty($model->created_at) ? date('l jS F Y', strtotime($model->created_at)) : "-"}}</td>
            <td>
              <div class="row" style="width:150px !important;">
                <div class="col-sm-4">
                  <a href="{{ route('UserType.edit', $model->id) }}" data-toggle="tooltip"  title="Edit" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span>
                  </a>
                </div>
                <div class="col-sm-4">
                  <a href="{{ route('UserType.show', $model->id) }}" data-toggle="tooltip"  title="View" class="btn btn-info"> <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
                </div>
                <div class="col-sm-4">
                    {!!Form::open(['action' => ['UserTypeController@destroy', $model->id], 'method' => 'POST' ,'onclick' => 'return confirm("Are you sure you want to delete?");'])!!}
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