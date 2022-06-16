@extends('admin.master')
@section('content')

@include('csvFile._search')
	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
		  <a href="{{ url('/import_file') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Upload CsvFile/Excel File</a>
		  <h4 class="panel-title">Manage CSV Files</h4>
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
			  </tbody>
			</table>
		  </div>
		</div>
	</div>
	<script>
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
	</script>
@endsection