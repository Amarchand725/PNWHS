
@foreach($models as $model)
	<tr>
		<td>
			{{$model->name}}
		</td>
		<td>
			{{$model->email}}
		</td>
		<td>

			{{$model->user_type}}
		</td>
		<td>
			{{date('d-F-Y',strtotime($model->created_at))}}
		</td>
		<td>
						 <label class="switch">
						 <input type="hidden" id='switchhidden<?= $model->id; ?>' value='{{$model->is_active}}'/>
						 <input type="hidden" id='userid' value='{{$model->id}}'/>
  				<input id='<?php echo $model->id; ?>' value='{{$model->id}}'  type="checkbox" <?php if($model->is_active == '1'){ echo 'checked'; } ?> >
 						 <span   class="slider round"></span>
				</label>
				</td>
			 <td>
					 <a href="{!! url('/Users/show'.'/'. $model->id); !!} " class="btn btn-success">View</a>
					 <a href="{{ route('Users.edit', $model->id) }}" class="btn btn-info">Update</a>
					 <a href="{!! url('/Users/destroy'.'/'. $model->id); !!}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
					<a href="{!! url('/Users/ChangePassword'.'/'. $model->id); !!} " class="btn btn-primary">Change Password</a>
				 </td>
	</tr>
	<script>
// $(document).ready(function(){
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
// });
</script>
@endforeach
<tr>
	<td colspan="2">
		{{ $models->appends($_GET)->links() }}
	</td>
</tr>
