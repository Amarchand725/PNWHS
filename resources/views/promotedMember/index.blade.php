@extends('admin.master')
@section('content')
@include('promotedMember._search')

	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <a href="{{ route('PromotedMember.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Create Member Promotion</a>
		  <h4 class="panel-title">Manage Promoted Members</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>Reg.File.No</b></th>
				  <th><b>Old P/PJO No</b></th>
				  <th><b>New P/PJO No</b></th>
				  <th><b>Name</b></th>
				  <th><b>Person</b></th>
				  <th><b>Tot Service</b></th>
				  <th><b>Rank</b></th>
				  <th><b>Promotion Date</b></th>
				  <th><b>Created By</b></th>
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
						<td>{{ $model->file_registration_no??'N/A' }}</td>
						<td>{{ $model->old_p_no??'N/A' }}</td>
						<td>{{ $model->new_p_no??'N/A' }}</td>
						<td>{{ !empty($model->hasMember)?ucfirst($model->hasMember->name):'N/A' }}</td>
						<td>{{ ucfirst($model->soldier)??'N/A' }}</td>
						<td>{{ $model->total_service??'N/A' }}</td>
						<td>
							{{ $model->hasPromotedRank->name??'N/A' }}
						</td>
						<td>
							{{ date('d, M- Y', strtotime($model->d_o_p)) }}
						</td>
						<td>{{ $model->hasUserCreatedBy->name??'N/A' }} | {{ $model->hasUserCreatedBy->hasRole->role??'N/A' }}</td>
						<td>{{!empty($model->created_at) ? date('d, M-y | H:g A', strtotime($model->created_at)) : "-"}}</td>
						<td>
							<a href="{{ route('PromotedMember.edit', $model->id) }}" title="Edit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
							<a title="Delete" class="btn btn-danger btn-sm deletePromotedMember" value="{{ $model->id }}">
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
		$(document).on('click','.deletePromotedMember',function(){
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
                        url: '{{ url("delete_promoted_member") }}/'+id,
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
