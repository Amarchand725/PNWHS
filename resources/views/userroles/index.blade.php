@extends('admin.master')
@section('content')
@include('flash_msgs')
 @include('userroles._search')


 <div class="panel panel-dark">
 <div class="panel panel-default">
        <div class="panel-heading" style='margin-top:20px;'>
        
		<div style="float: right;">
     
	 <a href="{{url('Userroles/create')}}" class="btn btn-default c">Create Roles</a>
 </div>

 <div class="">
 
	 <h4 class='panel-title'>Manage Roles</h4>
</div>
        </div>
		</div>


 <div class="">

	 <table class="table table-striped">
		 <thead>
		 <tr>
			 <th><b>Role</b></th>
			 <th><b>Edit Permission</b></th>
			 <th><b>Edit Role</b></th>
			 <th><b>Action</b></th>
		

		 </tr>
		 </thead>
		 <tbody class='ajax_content'>
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
		 <script>
		 function deleteRow(e){

e.preventDefault();
 current_row = $(this);
  account_id = $(this).attr('data-account-id');
   var r = confirm("Do you really want to delete this Permission?");
  if (r == false) {
	  return;
  }
  CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   $.ajax({

		  type: "POST",
		  url: "<?php echo url('Userroles/destroy'); ?>",
		  data: {_token: CSRF_TOKEN,
			  account_id: account_id
		  },
		  success: function(data){
		  
		   if(data == 'Success'){
			   location.reload();
		   }			
			 
		  },
	  
	  });
  

}
$(document).on('click', '#deleterow',deleteRow);

</script>
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

@endsection


