@extends('admin.master')
@section('content')
	@include('flash_msgs')
	@include('allotteeParticular._search')
	<br>
	<?php
		$usersdata =  DB::table('userroles')->where('id',Auth::user()->role)->first();
		if(!empty($usersdata)){
			$userrightsjson =  json_decode($usersdata->rights);
		}
		else{
			$dummyarray = array();
			$userrightsjson = $dummyarray;
		} 
	?>
	<div class="panel panel-dark">
		<div class="panel-heading">
			@if(in_array("Application_insert", $userrightsjson))
			    <button class='btn btn-success donwload_members_record' style="float: right; margin-right: 1%;margin-top: -8px;"><i class='fa fa-download'></i> Download Members Record</button>
				<a href="{{ url('/AllotteeParticular/create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Member</a>
			@endif
			<h4 class="panel-title">Manage Application</h4>                   
		</div>
		<div class="panel-body">
			<div class="row">
				<table class="table table-bordered">
					<thead >
						<th><b>#</b></th>
						<th><b>Reg:File No#</b></th>
						<th><b>P/PJ/O No</b></th>
						<th><b>Name</b></th>
						<th><b>Rank</b></th>
						<th><b>Person</b></th>
						<th><b>Category</b></th>
						<th><b>Status</b></th>
						<th><b>Remarks</b></th>
						<th class="noExport"><b>Action</b></th>
					</thead>
					<tbody class='ajax_content'>
						@php $counter = 1; @endphp
						@foreach($models as $model)
							<tr>
								<td>{{ $counter++ }}.</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->file_registration_no }}
									@else
										{{ $model->reg_file_no??'N/A' }}
									@endif
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->new_p_no }}
									@else
										{{ $model->p_no??'--' }}
									@endif
								</td>
								<td>{{ $model->name??'--' }}</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->hasPromotedRank->name??'--' }}
									@else
										{{ $model->hasRank->name??'--' }}
									@endif
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->soldier??'--' }}
									@else
										{{ $model->soldier??'--' }}
									@endif
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'--' }}
									@else
										{{ $model->hasRank->hasHouseCategory->name??'--' }}
									@endif
								</td>
								@if(!empty($model->hasPayment) && $model->status==1)
									<td>
										@if($model->status==1 && $model->hasPayment['is_active']==1)
											<span class='label label-success'><i class='fa fa-check'></i> Active</span>
										@else
											<span class='label label-danger'><i class='fa fa-times'></i> In-Active</span>
										@endif
									</td>
								@else
									<td>
										@if($model->status==1)
											<span class='label label-success'><i class='fa fa-check'></i> Active</span>
										@else
											<span class='label label-danger'><i class='fa fa-times'></i> In-Active</span>
										@endif
									</td>
								@endif
								<td>
									{{ $model->remarks_status??'--' }}
								</td>
								<td>
									@if($permissionview == 'true')
										<button type='button' class='btn btn-success btn-sm member-status' data-member-id='{{ $model->p_no }}' title='Change Status to Active/Inactive'><i class='fa fa-pencil'></i></button>
										<a href="{{ route('AllotteeParticular.show', $model->p_no) }}" data-toggle="tooltip"  title="Show Application" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-eye-open"></span></a>
									@endif
									@if($permissionupdate == 'true')
										<a href="{{ route('AllotteeParticular.edit', $model->p_no) }}" data-toggle="tooltip"  title="Edit Application" class="btn btn-secondary btn-sm background badge-info"> <i class="fa fa-edit" style='color:white'></i></a>
									@endif
									@if($permissiondelete == 'true')
										<button type='button' title="Delete" class="btn btn-danger btn-sm deleteMember" value="{{ $model->p_no }}"><i class="fa fa-trash-o"></i></button>
									@endif
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
			<div class="row" style='display:none'>
				<table class="table table-bordered" id="example">
					<thead >
						<th><b>#</b></th>
						<th><b>P/PJO/O No</b></th>
						<th><b>HONY P No</b></th>
						<th><b>Name</b></th>
						<th><b>RANK</b></th>
						<th><b>Person</b></th>
						<th><b>Rate</b></th>
						<th><b>File No</b></th>
						<th><b>CATEGORY</b></th>
						<th><b>DATE OF BIRTH</b></th>
						<th><b>ENROLMENT</b></th>
						<th><b>PROBATIONARY COMPLETION DATE</b></th>
						<th><b>SOD</b></th>
						<th><b>SOS</b></th>
						<th><b>Date of Superannuation</b></th>
						<th><b>TOTAL SERVICE CALCULATION (Y,M,D)</b></th>
						<th><b>MOBILE NUMBER</b></th>
						<th><b>PRESENT ADDRESS</b></th>
						<th><b>PERMANENT ADDRESS</b></th>
					</thead>
					<tbody class='ajax_content'>
						@php $counter = 1; @endphp
						@foreach($models as $model)
							<tr>
								<td>{{ $counter++ }}.</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->new_p_no }}
									@else
										{{ $model->p_no??'--' }}
									@endif
								</td>
								<td>{{ $model->honu_p_no??'--' }}</td>
								<td>{{ $model->name??'--' }}</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->hasPromotedRank->name??'--' }}
									@else
										{{ $model->hasRank->name??'--' }}
									@endif
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->soldier??'--' }}
									@else
										{{ $model->soldier??'--' }}
									@endif
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->rank_rate??'--' }}
									@else
										{{ $model->branch??'--' }}
									@endif
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->file_registration_no??'--' }}
									@else
										{{ $model->reg_file_no??'--' }}
									@endif
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ $model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'--' }}
									@else
										{{ $model->hasRank->hasHouseCategory->name??'--' }}
									@endif
								</td>
								<td>
									{{ date('d, M-Y', strtotime($model->d_o_b))??'--' }}
								</td>
								<td>
									{{ date('d, M-Y', strtotime($model->d_o_e))??'--' }}
								</td>
								<td>
									{{ date('d, M-Y', strtotime($model->d_o_c))??'--' }}
								</td>
								<td>
									{{ date('d, M-Y', strtotime($model->d_o_sod))??'--' }}
								</td>
								<td>
									{{ date('d, M-Y', strtotime($model->d_o_sos))??'--' }}
								</td>
								<td>
									{{ date('d, M-Y', strtotime($model->d_o_s))??'--' }}
								</td>
								<td>
									@if(!empty($model->hasPromotedMember))
										{{ ucfirst($model->hasPromotedMember->total_service)??'--' }}
									@else
										{{ $model->total_service??'--' }}
									@endif
								</td>
								<td>
									{{ $model->mob_no??'--' }}
								</td>
								<td>
									{{ $model->present_address??'--' }}
								</td>
								<td>
									{{ $model->permanent_address??'--' }}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="modal fade" id="rwy" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Files</h4>
				</div>
				<div class="modal-body">
				{!! Form::open([
					'route' => 'updatefile',
					'files' => true
					]) 
				!!}
					<input type="hidden" value='' name='rowid' id='rowid' />
					<div class='row'>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
						{!! Form::label("features", "Upload Files:", ["class" => "control-label"]) !!}
						<input type="file" name="image[]" class="form-control" id='image' multiple="multiple">
						</div>
					</div>

					<div class='clearfix'></div>
					<div class="col-md-12 col-sm-12" style='margin-top: 10px;'>
						<div class="form-group">
						<button type="submit" class="btn btn-success" id='submit'> Submit </button> 
						</div>
					</div>
					</div>

					<div class='clearfix'></div>

				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	
	<!-- Status Modal -->
	<div class="modal fade member_status_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style='background-color: #428bca; border-color: #357ebd;'>
					<h5 class="modal-title" style='color: #fff;'><i class='fa fa-pencil'></i> Change Status</h5>
				</div>
				<div class="modal-body">
					<form action="{{ url('member_status') }}" method='post' >
						@csrf
						<input type="hidden" name='member_id' value='' id='member_id'>
						<div class="row">
							<div class="col-sm-1"></div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Status <span style='color:red'>*<span></label>
										<select name="status" id="" class='form-control' required>
											<option value="" selected>Select Status</option>
											<option value="1">Active</option>
											<option value="0">In Active</option>
										</select>
									</div>
									<div class="form-group">
										<label for="">Remarks <span style='color:red'>*<span></label>
										<textarea name="remarks" id="" cols="64" rows="3" placeholder='Enter remarks' required></textarea>
									</div>
								</div>
							<div class="col-sm-1"></div>
						</div>
						<div class="row">
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
	    $(document).on('click', '.member-status', function(){
			var member_id = $(this).attr('data-member-id');
			$('#member_id').val(member_id);
			$('.member_status_modal').modal('show');
		});
		
		$(document).on('click','.deleteMember',function(){
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
                        url: '{{ url("delete_membership_application") }}/'+id,
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
	
	<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
@endsection