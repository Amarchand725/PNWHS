@extends('admin.master')
@section('content')
@include('flash_msgs')
 {{-- @include('payment._search') --}}
 <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div class="panel panel-dark">
 <div class="panel panel-default">
        <div class="panel-heading" style='margin-top:20px;'>

		<div style="float: right;">

	 <a href="{{url('Payment/create')}}" class="btn btn-default c">Create Payment</a>
 </div>

 <div class="">

	 <h4 class='panel-title'>Manage Payment</h4>
</div>
  </div>
		</div>
 <div class="">
	 <table class="table table-striped">
		 <thead>
		 <tr>
		 <th><b>#</b></th>
			 <th><b>P No</b></th>
			 <th><b>Amount Type</b></th>
             <th><b>Payment Type</b></th>
             <th><b>Amount</b></th>
			 <th><b>Action</b></th>
		 </tr>
		 </thead>

     @if(!empty($models))
        <tbody class='ajax_content'>
          <?php $counter = 1; ?>
          @foreach($models as $model)
          <tr>

            <td>{{$counter++}}</td>
            <td>{{!empty($model->p_no) ? $model->p_no : '-'}} </td>
            <td>{{!empty($model->amount_type) ? $model->amount_type : '-'}} </td>
                  <td>{{!empty($model->payment_type) ? $model->payment_type : '-'}}</td>
                  <td>{{!empty($model->amounts) ? $model->amounts : '-'}}</td>
            <td>
              <div class="row" style="width:150px !important;">

                <a href="{{ route('Payment.edit', $model->id) }}" data-toggle="tooltip"  title="Create Payment" class="btn btn-info"> <span class="glyphicon glyphicon-edit"></span>
                  </a>
                <div class="col-sm-4">
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

 @include('ajax_pagination')

@endsection


