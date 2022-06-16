<?php $models = DB::table('orders')->where('order_for', Auth::id())->get(); ?>
<div class="panel panel-dark">
  <div class="panel-heading">
    <div class="panel-btns">
      <a href="" class="panel-close">×</a>
      <a href="" class="minimize">−</a>
    </div>
    <h4 class="panel-title">{{Auth::user()->user_name}} Orders</h4>
  </div>
  
  <div class="panel-body">
    <div class="row">
      <table class="table table-bordered">
        <thead>
          <th><b>#</b></th>
          <th><b>Product Name</b></th>
          <th><b>Date</b></th>
          <th><b>Action</b></th>
        </thead>
        @if(!empty($models))
        <tbody class='ajax_content'>
          <?php $counter = 1; ?>
          @foreach($models as $model)
          	<?php 
          		$order_details = DB::table('order_details')->where('order_id', $model->id)->first();
          		$product = DB::table('product')->where('id', $order_details->product_id)->first();
          		$notification = DB::table('notification')->where('order_for', $model->order_for)->first();
          	?>
          <tr>
            <td>{{$counter++}}</td>
            <td>{{$product->name}}</td>
            <td>{{!empty($model->created_at) ? date('l jS F Y', strtotime($model->created_at)) : "-"}}</td>
            <td>
              <div class="row" style="width:150px !important;">
                <div class="col-sm-4">
               <!--  -->
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
