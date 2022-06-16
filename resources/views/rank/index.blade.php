@extends('admin.master')
@section('content')

@include('rank._search')

	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <a href="{{ route('Rank.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Create Rank</a>
		  <h4 class="panel-title">Manage Ranks</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>Rank</b></th>
				  <th><b>Category</b></th>
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
						<td>{{ $model->name??'--' }}</td>
						<td>{{ $model->hasHouseCategory->name??'--' }}</td>
						<td>
							@if($model->status=='1')
								<span style="color:green"> Enable</span>
							@else
								<span style="color:red"> Disable</span>
							@endif
						</td>
						<td>{{!empty($model->created_at) ? $model->created_at : "-"}}</td>
						<td>
							<a href="{{ route('Rank.edit', $model->id) }}" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
							<a title="Delete" class="btn btn-danger btn-sm deleteRank" value="{{ $model->id }}">
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
			</table>
		  </div>
		</div>
	  </div>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).on('click','.deleteRank',function(){
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
                        url: '{{ url("delete_rank") }}/'+id,
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