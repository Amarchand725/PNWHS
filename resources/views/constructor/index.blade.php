@extends('admin.master')
@section('content')
@include('flash_msgs')
 	@include('constructor._search')
 	<style>
		.switch {
			position: relative;
			display: inline-block;
			width: 60px;
			height: 34px;
		}
		.switch input { 
			opacity: 0;
			width: 0;
			height: 0;
		}
		.slider {
			position: absolute;
			cursor: pointer;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #ccc;
			-webkit-transition: .4s;
			transition: .4s;
		}
		.slider:before {
			position: absolute;
			content: "";
			height: 26px;
			width: 26px;
			left: 4px;
			bottom: 4px;
			background-color: white;
			-webkit-transition: .4s;
			transition: .4s;
		}
		input:checked + .slider {
			background-color: #2196F3;
		}
		input:focus + .slider {
			box-shadow: 0 0 1px #2196F3;
		}
		input:checked + .slider:before {
			-webkit-transform: translateX(26px);
			-ms-transform: translateX(26px);
			transform: translateX(26px);
		}
		/* Rounded sliders */
		.slider.round {
			border-radius: 34px;
		}
		.slider.round:before {
			border-radius: 50%;
		}
	</style>
	<div class="panel panel-dark">
		<div class="panel panel-default">
			<div class="panel-heading" style='margin-top:20px;'>
				<div style="float: right;">
					<a href="{{url('Contractor/create')}}" class="btn btn-default c">Create Contractor</a>
				</div>
				<div class="">
					<h4 class='panel-title'>Manage Contractors</h4>
				</div>
			</div>
		</div>
		<div class="">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><b>Name</b></th>
						<th ><b>Email</b></th>
						<th ><b>Mobile No</b></th>
						<th ><b>Date</b></th>
						<th ><b>Description</b></th>
						<th><b>Action</b></th>
					</tr>
				</thead>
				<tbody class='ajax_content'>
					@foreach($models as $model)
						<tr>
							<td>
								{{$model->name}} 
							</td>
							<td>
								{{$model->email}}
							</td>
							<td>
								{{$model->mobile_no}}
							</td>
							<td>
								{{date('d-F-Y',strtotime($model->created_at))}}
							</td>
							<td>
								{{$model->description}}
							</td>
							<td>
								<a href="{!! url('/contructor_ledger'.'/'. $model->id); !!} " class="btn btn-success btn-sm" title='Contractor Ledger'><i class='fa fa-file'></i></a>
								<a href="{{ route('Contractor.show', $model->id) }}" class="btn btn-primary btn-sm" title='Show'><i class='fa fa-eye'></i></a>
								<a href="{{ route('Contractor.edit', $model->id) }}" class="btn btn-info btn-sm" title='Edit'><i class='fa fa-edit'></i></a>
								<a title="Delete" class="btn btn-danger btn-sm deleteContractor" value="{{ $model->id }}">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
					@endforeach
					<tr style="align-content: center">
						<td colspan="6">
							{{ $models->appends($_GET)->links()}}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).on('click','.deleteContractor',function(){
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
                        url: '{{ url("delete_contractor") }}/'+id,
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