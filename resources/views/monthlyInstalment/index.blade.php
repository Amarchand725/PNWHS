@extends('admin.master')
@section('content')

 	@include('MonthlyInstalment._search')
 	<br />
	 <div class="panel panel-dark">
		<div class="panel-heading">
		<a href="{{ route('MonthlyInstalment.create') }}" class="btn btn-default" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Create </a>
		<h4 class="panel-title">Manage Monthly Instalments</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<table class="table table-bordered">
					<thead>
						<tr>
						<th><b>#</b></th>
						<th><b>P. NO</b></th>
						<th><b>Paid Amount</b></th>
						<th><b>Paid Date</b></th>
						<th><b>Created_at</b></th>
						<th><b>Action</b></th>
						</tr>
					</thead>
					<tbody class='ajax_content'>
						@php $counter = 0; @endphp
						@foreach($models as $model)
							@php $counter++; @endphp
							<tr>
								<td>{{ $counter }}.</td>
								<td>{{ $model->p_no }}</td>
								<td>{{ $model->amount }}</td>
								<td>{{ $model->paid_date }}</td>
								<td>{{!empty($model->created_at) ? $model->created_at : "-"}}</td>
								<td>
									<a href="{{ route('MonthlyInstalment.edit', $model->id) }}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
									<a title="Delete" class="btn btn-danger deleteMonthlyInstalment" value="{{ $model->id }}" >
									<i class="fa fa-trash-o"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	  </div>
	  
	  <script>
		$(document).on('click','.deleteMonthlyInstalment',function(e){
		  e.preventDefault();
			var id = $(this).attr('value');
			var deleted = $(this);
			$.ajax({
			  url: '/MonthlyInstalment/'+id,
			  type: 'DELETE',  // user.destroy
			  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				  
			  success: function(result) {
				if(result.msg!='fail'){
				  window.location.reload();
				}else{
				  alert('Sorry something wrong.!');
				}
				// Do something with the result
			  },
			  error:function(e){
				window.location.reload();
			  }
			});
		});
	  </script>
 	@include('ajax_pagination')
@endsection