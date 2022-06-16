@extends('admin.master')
@section('content')
@include('flash_msgs')

@include('getProfit._search')

	<style>
		input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
			line-height: 10px;
		}
	</style>
<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <!-- <a href="{{ route('GetProfit.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Create Member Promotion</a> -->
		  <h4 class="panel-title">Manage Member's Profit</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>P/PJO No</b></th>
				  <th><b>Profit Rate</b></th>
				  <th><b>Paid Amount</b></th>
				  <th><b>Profit Amount</b></th>
				  <th><b>Total Amount</b></th>
				  <th><b>Status</b></th>
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
						<td>
							@if(!empty($model->hasPromotedMember))
								{{ $model->hasPromotedMember->new_p_no }}
							@else
								{{ $model->p_no??'--' }}
							@endif
						</td>
						<td>{{ $model->hasProfitRate->rate??'--' }}%</td>
						<td>{{ number_format($model->paid_amount)??'--' }}</td>
						<td>{{ number_format($model->profit_amount)??'--' }}</td>
						<td>{{ number_format($model->total_amount)??'--' }}</td>
						<td>
							@if($model->payment_status=='pending')
								<span class='label label-danger'><i class='fa fa-clock-o'></i> Pending</span>
							@else
								<span class='label label-success'><i class='fa fa-check'></i> Payment Released</span>
							@endif
						</td>
						<td>{{!empty($model->created_at) ? $model->created_at : "-"}}</td>
						<td>
							<!-- <a href="{{ route('GetProfit.edit', $model->id) }}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a> -->
							<!-- <a title="Delete" class="btn btn-danger deleteGetProfit" value="{{ $model->id }}">
								<i class="fa fa-trash-o"></i>
							</a> -->
							@if($model->payment_status=='pending')
								<button type="button" data-profit-id="{{ $model->id }}" class="btn btn-info btn-sm release-payment" title="Release Payment" data-toggle="modal" data-target="#myModal"><i class="fa fa-money"></i> Release Payment</button>
							@else
								<!-- <a href="" ></a> -->
								<button type="button" data-profit-id="{{ $model->id }}" class="btn btn-success btn-sm released-payment-details" title="Payment Released Details" data-toggle="modal" data-target="#myModalDetails"><i class="fa fa-eye"></i> Released Payment</button>
								<a href="" class="btn btn-info btn-sm" title="Payment Released Reciept"><i class="fa fa-print"></i> Print Reciept</a>
							@endif
						</td>
					</tr>
				@endforeach
				<tr style="align-content: center">
				  <td colspan="12">
				  	{{ $models->links() }}
				  </td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>

	  	<!-- Payment Release Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style='background-color: #428bca; border-color: #357ebd;'>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" style='color:white'><i class='fa fa-money'></i> Release Payment Form</h4>
					</div>
					<div class="modal-body">
						<form action="{{ url('release_profit_payment') }}" method="post" class="release_payment_form">
							@csrf
							<input type="hidden" name="get_profit_id" id="profit_id">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Payment Method <span style='color:red'>*</span></label>
										<select name="payment_method" id="" class="form-control" required>
											<option value="">Select Payment Method</option>
											<option value="pay-order">Pay Order</option>
											<option value="cheque">Cheque</option>
										</select>
									</div>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="">Beneficiary Name <span style='color:red'>*</span></label>
										<input type="text" placeholder="Enter Beneficiary Name" class="form-control" name="beneficiary_name" id="" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">	
										<label for="">Bank Name <span style='color:red'>*</span></label>
										<input type="text" name='bank_name' class="form-control" placeholder="Enter Bank Name" required>
									</div>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="">Date <span style='color:red'>*</span></label>
										<input type="date" class="form-control" name="date" id="" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">	
										<label for="">Ref/Cheque No <span style='color:red'>*</span></label>
										<input type="text" name='ref_cheque_no' class="form-control" placeholder="Enter Reference/cheque No" required>
									</div>
								</div>
						</div>
							<br />
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Remarks</label>
										<textarea name="remarks" id="" placeholder="Enter remarks" class="form-control" cols="50" style="margin: 0px 1px 0px 0px; height: 65px; width: 568px;" rows="5"></textarea>
									</div>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<button class="btn btn-success"><i class='fa fa-submit'></i> Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Display Payment Released Details Modal -->
		<div id="myModalDetails" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header" style='background-color: #428bca; border-color: #357ebd;'>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title" style='color:white'><i class='fa fa-check'></i> Payment Released Details</h4>
					</div>
					<div class="modal-body">
						<div class="display-data"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

	<script>
		$('.released-payment-details').on('click', function(){
			var profit_id = $(this).attr('data-profit-id');
			$.ajax({
				type: "POST",
				url: "{{ url('get_profit_details') }}",
				data: {_token: "{{ csrf_token() }}", profit_id:profit_id },
				success: function( response ) {
					console.log(response);
					var html = '';
					html = '<table class="table table-bordered">'+
						'<tr>'+
							'<th>Beneficiary Name: </th>'+
							'<td>'+response.beneficiary_name+'</div>'+
						'</tr>'+
						'<tr>'+
							'<th>Payment Method: </th>'+
							'<td>'+response.payment_method+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Bank: </th>'+
							'<td>'+response.bank_name+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Ref/cheque No: </th>'+
							'<td>'+response.ref_cheque_no+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Date: </th>'+
							'<td>'+response.date+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Remarks: </th>'+
							'<td>'+response.remarks+'</td>'+
						'</tr>'+
						'<tr>'+
							'<th>Payment Status: </th>'+
							'<td><span class="label label-success"><i class="fa fa-check"></i> Payment Released</span></td>'+
						'</tr>'+
						'<tr>'+
							'<th>Payment Released Date: </th>'+
							'<td>'+response.created_at+'</td>'+
						'</tr>'+
					'</table>';
					$('.display-data').html(html);
				}
			});
		});

		$('.release-payment').on('click', function(){
			var profit_id = $(this).attr('data-profit-id');
			$('#profit_id').val(profit_id);
		});
		
		//Client side validation
		$('.release_payment_form').validate({
			submitHandler: function(form) {
			form.submit();
			}
		});

		$(document).on('click','.deleteGetProfit',function(e){
			e.preventDefault();
			var id = $(this).attr('value');
			var deleted = $(this);
			$.ajax({
				url: '/GetProfit/'+id,
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
@endsection