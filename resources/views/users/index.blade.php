@extends('admin.master')
@section('content')
	@include('flash_msgs')
 	@include('users._search')
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
	<br>
	<div class='clearfix'></div>
	<div class="panel panel-dark">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div style="float: right;">
					<?php
					if(Auth::user()->user_type == 'superadmin'){
						?>
					<a href="{{url('Users/status',1)}}" onclick="return confirm('Are you sure you want to Enable All?');" class="btn btn-success">Enable All</a>
					<a href="{{url('Users/status',0)}}" onclick="return confirm('Are you sure you want to Disable All?');" class="btn btn-info">Disable All</a>
						<?php
					}
					?>
			
					<a href="{{url('Users/create')}}" class="btn btn-default c">Create Users</a>
				</div>

				<div class="">
					<h4 class='panel-title'>Manage Users</h4>
				</div>
			</div>
	
			<table class="table table-striped">
				<thead>
					<tr>
						<th><b>P.NO#</b></th>
						<th><b>Name</b></th>
						<th><b>Email</b></th>
						<th><b>User Type</b></th>
						<th><b>Date</b></th>
						<th><b>Status</b></th>
						<th><b>Created By</b></th>
						<th><b>Action</b></th>
					</tr>
				</thead>
				<tbody class='ajax_content'>
					@foreach($models as $model)
						<tr>
							<td>{{ $model->p_no??'--' }}</td>
							<td>{{ $model->name??'--' }}</td>
							<td>{{ $model->email??'--' }}</td>
							<td>
								<?php $usertype =  DB::table('usertype')->where('id',$model->user_type)->first(); ?>
								{{$usertype->name}}
							</td>
							<td>
								{{date('d-F-Y',strtotime($model->created_at))}}
							</td>
							<td>
								@if($model->user_type == 'superadmin')
									<lable class='text text-danger'>Superadmin Not Disable</label>
								@else
									<label class="switch">
										<input type="hidden" id='switchhidden<?= $model->id; ?>' value='{{$model->is_active}}'/>
										<input type="hidden" id='userid' value='{{$model->id}}'/>
										<input id='<?php echo $model->id; ?>' value='{{$model->id}}'  type="checkbox" <?php if($model->is_active == '1'){ echo 'checked'; } ?> >
										<span class="slider round"></span>
									</label>
								@endif
							</td>
							<td>{{ $model->hasUserCreatedBy->name??'--' }} | {{ $model->hasUserCreatedBy->hasRole->role??'--' }}</td>
							<td>
								<a href="{{ route('Users.edit', $model->id) }}" class="btn btn-info"><i class='fa fa-pencil'></i></a>
								<a href="{!! url('/Users/destroy'.'/'. $model->id); !!}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class='glyphicon glyphicon-trash'></i></a>
								<a href="{!! url('/Users/ChangePassword'.'/'. $model->id); !!} " class="btn btn-primary"><i class='fa fa-key'></i></a>
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
 	@include('ajax_pagination')

	 <script>
		$(document).ready(function(){
			$("#<?php echo $model->id; ?>").click(function(){
				var selected_value = $('#switchhidden<?= $model->id; ?>').val();
				var user_id = $(this).val();
				var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
				$.ajax({
					type: "POST",
					url: "<?php echo url('Users/statusupdates'); ?>",
					data: {_token: CSRF_TOKEN,
						selected_value: selected_value,
						user_id: user_id,
					},
					success: function(data){
						if(data == 0){
							alert('User Disable successfully');
							location.reload();
						}
						else{
							alert('User Enable successfully');
							location.reload();
						}
					}
				});
			});
		});
	</script>
@endsection