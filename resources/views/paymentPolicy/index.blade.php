@extends('admin.master')
@section('content')

	@include('paymentPolicy._search')
	<br>
	<div class="panel panel-dark">
		<div class="panel-heading">
			<a href="{{ url('PaymentPolicy/create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Payment Policy</a>
			<h4 class="panel-title"> Manage Payment Policies</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<table class="table table-bordered">
					<thead>
					<th><b>#</b></th>
					<th><b>Rank(s)</b></th>
					<th><b>Reg. Payment</b></th>
					<th><b>Ins. Payment</b></th>
					<th><b>Monthly Install</b></th>
					<th style='text-align:center'><b>Effective Date</b></th>
					<th><b>Created_at</b></th>
					<th><b>Created By</b></th>
					<th><b>Status</b></th>
					<th><b>Action</b></th>
					</thead>
					@if(!empty($models))
						<tbody class='ajax_content'>
							@php $counter = 0; @endphp
							@foreach($models as $model)
								<tr>
									<td>{{ ++$counter }}.</td>
									<td style="width:10%">
										@foreach($model->hasPolicyAppliedRanks as $rank)
											{{ $rank->hasRank->name??'N/A' }}, 
										@endforeach
									</td>
									<td>{{ number_format($model->registration_payment) }}</td>
									<td>
										{{!empty($model->insurance_payment) ? number_format($model->insurance_payment) : "--"}}
									</td>
									<td>{{ number_format($model->monthly_instalment) }}</td>
									<td style='text-align:center'>{{ date('M-Y', strtotime($model->effective_date)) }}</td>
									<td>{{!empty($model->created_at) ? date('d, M-y | H:i A', strtotime($model->created_at)) : "-"}}</td>
									<td>{{!empty($model->created_by) ? $model->hasUserCreatedBy->name : "-"}} | {{!empty($model->created_by) ? $model->hasUserCreatedBy->hasRole->role : "-"}}</td>
									<td>
										@if($model->status=='1')
											<span style="color:green"> Active</span>
										@else
											<span style="color:red"> In Active</span>
										@endif
									</td>
									<td>
										<a href="{{ route('PaymentPolicy.edit', $model->id) }}" title="View and Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a title="Delete" class="btn btn-danger deletePaymentPolicy btn-sm" value="{{ $model->id }}" >
											<i class="fa fa-trash-o"></i>
										</a>
									</td>
								</tr>
							@endforeach
							<tr style="align-content: center">
								<td colspan="12">
									{{ $models->links() }}
								</td>
							</tr>
						</tbody>
					@endif
				</table>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).on('click','.deletePaymentPolicy',function(){
			var id = $(this).attr('value');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url("delete_payment_policy") }}/'+id,
                        type: 'get',
                        success: function(result) {
                            if(result==1){
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        }
                    });
					
					$(this).closest("tr").remove();
                }
            })
		});
	</script>
@endsection