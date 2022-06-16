@foreach($models as $model)
			 <tr>
				 <td>
					 {{$model->role}}
				 </td>
				 <td>
				 <a href="{!! url('/Userroles/editpermission'.'/'.$model->id); !!} " class="btn btn-primary">Permission</a><br>
				 </td>
				 <td>
				 <a href="{{ route('Userroles.edit', $model->id) }}" class="btn btn-success">RoleUpdate</a><br>
				 </td>
				 <td>
					 <a  href="javascript:void(0)" id='deleterow' data-account-id='<?php echo $model->id; ?>' class="btn btn-danger">Delete</a>
				 </td>
			 </tr>
		
		 @endforeach

<tr>
	<td colspan="2">
		{{ $models->appends($_GET)->links() }}
	</td>
</tr>