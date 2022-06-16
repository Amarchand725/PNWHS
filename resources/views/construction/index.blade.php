@extends('admin.master')
@section('content')
	@include('flash_msgs')
	@include('construction._search')
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
					<a href="{{url('Construction/create')}}" class="btn btn-default c">Create Construction</a>
				</div>

				<div class="">
					<h4 class='panel-title'>Manage Constructions</h4>
				</div>
			</div>
		</div>
		<div class="">
			<table class="table table-striped">
				<thead>
					<tr>
						<th><b>#</b></th>
						<th><b>Constructor</b></th>
						<th><b>Plot</b></th>
						<th><b>Category</b></th>
						<th><b>Duaration</b></th>
						<th><b>Initial Price</b></th>
						<th><b>Final Price</b></th>
						<th><b>Status</b></th>
						<th><b>Date</b></th>
						<th><b>Action</b></th>
					</tr>
				</thead>
				<tbody class='ajax_content'>
					@foreach($models as $model)
						<tr>
							<td>{{$loop->index +1}}</td>
							<td>
								<?php $cons =  DB::table('constructor')->where('id',$model->constructor_id)->first(); ?>
								{{$cons->name}}
							</td> 
							<td>
								@php
									$plot =  DB::table('plots')->where('id',$model->plot_id)->first();
								@endphp
								@if(!empty($plot))
									{{ $plot->plot_no }}
								@endif	 
							</td>
							<td>
								{{ $model->category }}
							</td>
							<td>
								{{ $model->duaration }}
							</td>
							<td>
								@if(!empty($model->initial_price))
									{{ $cnr->gettypenumber($model->initial_price) }}
								@else
									{{ '0' }}
								@endif
							</td>
							<td>
								@if(!empty($model->final_price))
									{{ $cnr->gettypenumber($model->final_price) }}
								@else
									{{ '0' }}
								@endif
							</td>
							<?php 
								$exp =  explode(' ',$model->duaration);
								$updatedate = date('Y-m-d', strtotime(date('Y-m-d') .'+'.$exp[0].' month')); 
								$created_date =  date('Y-m-d',strtotime($model->created_at));
							?>

							@if(date('Y-m-d') > $updatedate && $model->status != 'Working')
								<td style='color:red'>
									{{ 'Construction Period is over' }}				 
								</td>
							@else
								<td>
									@if($model->status=='progress')
										<span class='label label-info'><i class='fa fa-spinner'></i> Progress</span>	
									@else
										<span class='label label-success'><i class='fa fa-check'></i> Completed</span>
									@endif
								</td>
							@endif
							<td>
								{{date('d-F-Y',strtotime($model->created_at))}}
							</td>
							<td>
								<a href="{{route('Construction.show', $model->id) }} " class="btn btn-success btn-sm" title='Show'><i class='fa fa-eye'></i></a>
								<button type="button" class="btn btn-primary update-status btn-sm" data-status='{{ $model->status }}' title='Update Status' data-construction-id='{{ $model->id }}'><i class='fa fa-pencil'></i></button>
								<a href="{{ route('Construction.edit', $model->id) }}" class="btn btn-info btn-sm" title='Edit'><i class='fa fa-edit'></i></a>
								<a title="Delete" class="btn btn-danger btn-sm deleteConstraction" value="{{ $model->id }}">
									<i class="fa fa-trash-o"></i>
								</a>
							</td>
						</tr>
					@endforeach
					<tr style="align-content: center">
						<td colspan="6">
							{{ $models->appends($_GET)->links() }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style='background-color: #428bca; border-color: #357ebd;'>
					<h5 class="modal-title" style='color:white' id="exampleModalLabel"><i class='fa fa-pencil'></i> Update Status</h5>
				</div>
				<form action="{{ url('construction_status') }}">
					<div class="modal-body">
						<input type="hidden" name='construction_id' id='construction-id'>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								{!! Form::label("Status", "Status", ["class" => "control-label "]) !!}
								<select name="status" id="construction-status" class='form-control construction-status'>
									<option value=''>Status</option>
									<option value='progress'>In Progress</option>
									<option value='completed'>Completed</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type='submit' class='btn btn-info'><i class='fa fa-pencil'></i> Edit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$('.update-status').on('click', function(){
			var construction_id = $(this).attr('data-construction-id');
			var construction_status = $(this).attr('data-status');
			$('#construction-id').val(construction_id);
			var html = '<option value="progress"'+construction_status+'=="progress"?"selected":"">In Progress</option>'+
						'<option value="completed"'+construction_status+'=="completed"?"selected":"">Completed</option>';
			$('#construction-status').html(html);		
			$('#exampleModal').modal('show');
		});
	</script>
 	@include('ajax_pagination')

	 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		$(document).on('click','.deleteConstraction',function(){
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
                        url: '{{ url("delete_constraction") }}/'+id,
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