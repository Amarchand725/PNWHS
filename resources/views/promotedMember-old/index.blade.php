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
				  <th><b>Promoted To Rank</b></th>
				  <th><b>Promoted Date</b></th>
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
						<td>{{ $model->file_registration_no??'--' }}</td>
						<td>{{ $model->old_p_no??'--' }}</td>
						<td>{{ $model->new_p_no??'--' }}</td>
						<td>
							{{ $model->hasPromotedRank->name??'--' }}
						</td>
						<td>
							{{ date('d, F Y', strtotime($model->d_o_p)) }}
						</td>
						<td>{{ $model->hasUserCreatedBy->name??'--' }} | {{ $model->hasUserCreatedBy->hasRole->role??'--' }}</td>
						<td>{{!empty($model->created_at) ? $model->created_at : "-"}}</td>
						<td>
							<a href="{{ route('PromotedMember.edit', $model->id) }}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
							<a title="Delete" class="btn btn-danger deletePromotedMember" value="{{ $model->id }}">
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
	<script>
		$(document).on('click','.deletePromotedMember',function(e){
			e.preventDefault();
			var id = $(this).attr('value');
			var deleted = $(this);
			$.ajax({
				url: '/PromotedMember/'+id,
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