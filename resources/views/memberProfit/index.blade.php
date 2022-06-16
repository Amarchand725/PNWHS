@extends('admin.master')
@section('content')

	@include('memberProfit._search')
	<br>
	<div class="panel panel-dark">
		<div class="panel-heading">
			<a href="{{ url('MemberProfit/create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Profit Rate</a>
			<h4 class="panel-title"> Manage Profit Rate</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<table class="table table-bordered">
					<thead>
					<th><b>#</b></th>
					<th><b>Profit Rate (%)</b></th>
					<th style='text-align:center'><b>Effective Date</b></th>
					<th><b>Created By</b></th>
					<th><b>Status</b></th>
					<th><b>Created_at</b></th>
					<th><b>Action</b></th>
					</thead>
					@if(!empty($models))
						<tbody class='ajax_content'>
							@php $counter = 1; @endphp
							@foreach($models as $model)
								<tr>
									<td>{{ $counter++ }}.</td>
									<td>{{ $model->rate }}%</td>
									<td style='text-align:center'>{{ date('d, F-Y', strtotime($model->effected_date)) }}</td>
									<td>{{ $model->hasUserCreatedBy->hasRole->role }} | {{ $model->hasUserCreatedBy->name }}</td>
									<td>
										@if($model->status==1)
											<span class='label label-success'>Active</span>
										@else
											<span class='label label-danger'>In Active</span>
										@endif
									</td>
									<td>{{ date('d, F-Y | H:i A', strtotime($model->created_at)) }}</td>
									<td>
										<a href="{{ route('MemberProfit.edit', $model->id) }}" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a title="Delete" class="btn btn-danger btn-sm deleteMemberProfit" value="{{ $model->id }}" ><i class="fa fa-trash-o"></i></a>
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
		$(document).on('click','.deleteMemberProfit',function(){
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
                        url: '{{ url("delete_profit_rate") }}/'+id,
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