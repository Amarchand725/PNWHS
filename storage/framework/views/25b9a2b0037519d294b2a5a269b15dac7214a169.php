
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('allotteeParticular._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
			<?php if(in_array("Application_insert", $userrightsjson)): ?>
			    <button class='btn btn-success donwload_members_record' style="float: right; margin-right: 1%;margin-top: -8px;"><i class='fa fa-download'></i> Download Members Record</button>
				<a href="<?php echo e(url('/AllotteeParticular/create')); ?>" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Member</a>
			<?php endif; ?>
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
						<?php $counter = 1; ?>
						<?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($counter++); ?>.</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->file_registration_no??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->reg_file_no??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->new_p_no??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->p_no??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td><?php echo e($model->name??'N/A'); ?></td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->hasPromotedRank->name??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->hasRank->name??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->soldier??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->soldier??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->hasRank->hasHouseCategory->name??'N/A'); ?>

									<?php endif; ?>
								</td>
								<?php if(!empty($model->hasPayment) && $model->status==1): ?>
									<td>
										<?php if($model->status==1 && $model->hasPayment['is_active']==1): ?>
											<span class='label label-success'><i class='fa fa-check'></i> Active</span>
										<?php else: ?>
											<span class='label label-danger'><i class='fa fa-times'></i> In-Active</span>
										<?php endif; ?>
									</td>
								<?php else: ?>
									<td>
										<?php if($model->status==1): ?>
											<span class='label label-success'><i class='fa fa-check'></i> Active</span>
										<?php else: ?>
											<span class='label label-danger'><i class='fa fa-times'></i> In-Active</span>
										<?php endif; ?>
									</td>
								<?php endif; ?>
								<td>
									<?php echo e($model->remarks_status??'N/A'); ?>

								</td>
								<td>
									<?php if($permissionview == 'true'): ?>
										<button type='button' class='btn btn-success btn-sm member-status' data-member-id='<?php echo e($model->p_no); ?>' title='Change Status to Active/Inactive'><i class='fa fa-pencil'></i></button>
										<a href="<?php echo e(route('AllotteeParticular.show', $model->id)); ?>" data-toggle="tooltip"  title="Show Application" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-eye-open"></span></a>
									<?php endif; ?>
									<?php if($permissionupdate == 'true'): ?>
										<a href="<?php echo e(route('AllotteeParticular.edit', $model->p_no)); ?>" data-toggle="tooltip"  title="Edit Application" class="btn btn-secondary btn-sm background badge-info"> <i class="fa fa-edit" style='color:white'></i></a>
									<?php endif; ?>
									<?php if($permissiondelete == 'true'): ?>
										<button type='button' title="Delete" class="btn btn-danger btn-sm deleteMember" value="<?php echo e($model->p_no); ?>"><i class="fa fa-trash-o"></i></button>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td colspan="7">
								<?php echo e($models->links()); ?>

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
						<th><b>Membership Date</b></th>
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
						<?php $counter = 1; ?>
						<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($counter++); ?>.</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->new_p_no); ?>

									<?php else: ?>
										<?php echo e($model->p_no??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td><?php echo e($model->membership_date); ?>.</td>
								<td><?php echo e($model->honu_p_no??'N/A'); ?></td>
								<td><?php echo e($model->name??'N/A'); ?></td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->hasPromotedRank->name??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->hasRank->name??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->soldier??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->soldier??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->rank_rate??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->branch??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->file_registration_no??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->reg_file_no??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e($model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->hasRank->hasHouseCategory->name??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php echo e(date('d, M-Y', strtotime($model->d_o_b))??'N/A'); ?>

								</td>
								<td>
									<?php echo e(date('d, M-Y', strtotime($model->d_o_e))??'N/A'); ?>

								</td>
								<td>
									<?php echo e(date('d, M-Y', strtotime($model->d_o_c))??'N/A'); ?>

								</td>
								<td>
									<?php echo e(date('d, M-Y', strtotime($model->d_o_sod))??'N/A'); ?>

								</td>
								<td>
									<?php echo e(date('d, M-Y', strtotime($model->d_o_sos))??'N/A'); ?>

								</td>
								<td>
									<?php echo e(date('d, M-Y', strtotime($model->d_o_s))??'N/A'); ?>

								</td>
								<td>
									<?php if(!empty($model->hasPromotedMember)): ?>
										<?php echo e(ucfirst($model->hasPromotedMember->total_service)??'N/A'); ?>

									<?php else: ?>
										<?php echo e($model->total_service??'N/A'); ?>

									<?php endif; ?>
								</td>
								<td>
									<?php echo e($model->mob_no??'N/A'); ?>

								</td>
								<td>
									<?php echo e($model->present_address??'N/A'); ?>

								</td>
								<td>
									<?php echo e($model->permanent_address??'N/A'); ?>

								</td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
				<?php echo Form::open([
					'route' => 'updatefile',
					'files' => true
					]); ?>

					<input type="hidden" value='' name='rowid' id='rowid' />
					<div class='row'>
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
						<?php echo Form::label("features", "Upload Files:", ["class" => "control-label"]); ?>

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

				<?php echo Form::close(); ?>

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
					<form action="<?php echo e(url('member_status')); ?>" method='post' >
						<?php echo csrf_field(); ?>
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
                        url: '<?php echo e(url("delete_membership_application")); ?>/'+id,
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>