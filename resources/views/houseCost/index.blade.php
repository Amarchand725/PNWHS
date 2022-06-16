@extends('admin.master')
@section('content')

	@include('houseCost._search')
	<br>
	<div class="panel panel-dark">
		<div class="panel-heading">
			<a href="{{ url('HouseCost/create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create House Cost</a>
			<h4 class="panel-title"> Manage House Cost</h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<table class="table table-bordered">
					<thead>
						<th><b>#</b></th>
						<th><b>Category</b></th>
						<th><b>House Cost (PKR)</b></th>
						<th><b>Created By</b></th>
						<th><b>Created_at</b></th>
						<th><b>Action</b></th>
					</thead>
					@if(!empty($models))
						<tbody class='ajax_content'>
							@php $counter = 1; @endphp
							@foreach($models as $model)
								<tr>
									<td>{{ $counter++ }}.</td>
									<td>{{ $model->hasHouseCat->name }}</td>
									<td>{{ number_format($model->initial_cost) }}</td>
									<td>{{ $model->hasCreatedBy->name}} | {{ $model->hasCreatedBy->hasRole->role}}</td>
									<td>{{ date('d,F-Y', strtotime($model->created_at)) }}</td>
									<td>
										<a href="{{ route('HouseCost.edit', $model->id) }}" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a title="Delete" class="btn btn-danger btn-sm deleteHouseCost" value="{{ $model->id }}" ><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					@endif
				</table>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).on('click','.deleteHouseCost',function(){
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
                        url: '{{ url("delete_house_cost") }}/'+id,
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