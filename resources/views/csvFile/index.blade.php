@extends('admin.master')
@section('content')

@include('csvFile._search')
	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <a href="{{ url('/import_file') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Upload CSV/Excel File</a>
		  <h4 class="panel-title">Manage Payment Files</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>CsvFile</b></th>
				  <th><b>Uploaded By</b></th>
				  <th><b>Created_at</b></th>
				  <th><b>Action</b></th>
				</tr>
			  </thead>
			  <tbody class='ajax_content'>
			  	@php $counter = 1; @endphp
				@foreach($models as $model)
					<tr>
						<td>{{ $counter++ }}.</td>
						<td>{{ $model->file_name }}</td>
						<td>{{ $model->hasUserCreatedBy->name }} | {{ $model->hasUserCreatedBy->hasRole->role }}</td>
						<td>{{ $model->created_at }}</td>
						<td>
							<a href="{{ route('CsvFile.edit', $model->id) }}" title="Edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
							<a href="{{ route('CsvFile.show', $model->id) }}" title="Display Amount List" class="btn btn-info"><i class="fa fa-eye"></i></a>
							<a title="Delete" class="btn btn-danger deleteCsvFile" value="{{ $model->id }}"><i class="fa fa-trash-o"></i></a>
						</td>
					</tr>
				@endforeach
				<tr>
					<td colspan="7">
						{{ $models->links() }}
					</td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<!-- <script>
		$(document).on('click','.deleteCsvFile',function(e){
			e.preventDefault();
			var id = $(this).attr('value');
			var deleted = $(this);
			$.ajax({
				url: '/CsvFile/'+id,
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
	</script> -->
	<script>
	    $(document).on('click', '.member-status', function(){
			var member_id = $(this).attr('data-member-id');
			$('#member_id').val(member_id);
			$('.member_status_modal').modal('show');
		});
		
		$(document).on('click','.deleteCsvFile',function(){
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
                        url: '{{ url("delete_uplodated_file") }}/'+id,
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
		
		$('.donwload_members_record').on('click', function(e){
			$("#example").table2excel({
				exclude: ".noExport",
				filename: "members.xls"
			});
		});
	</script>
@endsection