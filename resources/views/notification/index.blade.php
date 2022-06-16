@extends('admin.master')
@section('content')

<div class="panel panel-dark">
  <div class="panel-heading">
    <div class="panel-btns">
      <a href="" class="panel-close">×</a>
      <a href="" class="minimize">−</a>
    </div>
    <h4 class="panel-title">Notifications</h4>
  </div>
  
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Added By</th>
            <th>Order For</th>
            <th>Notification Type</th>
            <th>Admin Seen</th>
            <th>Seen</th>
            <th>Seperate View</th>
            <th>Date</th>
            <th>Created By</th>
            <th>Action</th>
          </tr>
        </thead>
        @if(!empty($models))
        <tbody class="ajax_content">
          @foreach($models as $model)
          <?php 
              $user = DB::table('users')->where('id',$model->created_by)->first(); 
              $order_for = DB::table('users')->where('id',$model->order_for_user_id)->first(); 
              
          ?>
          <tr>
            <td><?php if(!empty($model->id)){echo $model->id;}?></td>
            <td><?php if(!empty($user->user_name)){echo $user->user_name;}?></td>
            <td><?php if(!empty($order_for->user_name)){echo $order_for->user_name;}?></td>
            <td><?php if(!empty($model->title)){echo $model->title ;}?></td>
            <td>
              @if($model->admin_seen == 1)
                {{'Yes'}}
              @else
              {{'No'}}
              @endif
            </td>
            <td>
              @if($model->seen == 1)
                {{'Yes'}}
              @else
              {{'No'}}
              @endif
            </td>
            <td><?php if(!empty($model->seperate_view)){echo $model->seperate_view;} ?></td>
            <td><?php if(!empty($model->created_at)){echo date('d-F-Y',strtotime($model->created_at));}?></td>
            <td style="color: green">{{!empty(!empty($user->user_name)) ? $user->user_name : "-"}}</td>
            <td>
              <div class="col-sm-6">
                <a href="{{ url($model->seperate_view) }}" data-toggle="tooltip"  title="View" class="btn btn-success">
                  <span class="fa fa-eye"></span>
                </a>
              </div>
            </td>
          </tr>
          @endforeach
          <tr>
            <td colspan="12">
              <center>
              <?php echo $models->appends($_GET)->links() ?>
              </center>
            </td>
          </tr>
        </tbody>
        @endif
      </table>
    </div>
  </div>
</div>
@endsection