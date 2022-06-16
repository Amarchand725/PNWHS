@extends('admin.master')
@section('content')
@include('flash_msgs')
 @include('userpermission._search')
 <div class="panel panel-dark">
 <div class="panel panel-default">
        <div class="panel-heading" style='margin-top:20px;'>
        
		<div style="float: right;">
     
	 <a href="{{url('Userpermission/create')}}" class="btn btn-default c">Create Permissions</a>
 </div>

 <div class="">
 
	 <h4 class='panel-title'>Manage Permission</h4>
</div>
        </div>
		</div>

 <div class="">
	 <table class="table table-striped">
		 <thead>
		 <tr>
			 <th><b>Name</b></th>
			 <th><b>Email</b></th>
			 <th><b>User Type</b></th>
		 </tr>
		 </thead>
		 <tbody class='ajax_content'>
		 @foreach($models as $model)
			 <tr>
				 <td>
					 <?= str_replace("_","-",$model->name); ?>
				 </td>
			
				 <td>
					 <?= str_replace("_","-",$model->description); ?>
				 </td>
				 <td>
					 <a href="{!! url('/Userpermission/show'.'/'. $model->id); !!} " class="btn btn-success">View</a>
					 <a href="{{ route('Userpermission.edit', $model->id) }}" class="btn btn-info">Update</a>
					 <a href="javascript:void(0)" id='deleterow' class='btn btn-danger' data-account-id='<?php echo $model->id; ?>' >Delete</a>
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
		  url: "<?php echo url('Userpermission/destroy'); ?>",
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


