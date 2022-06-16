<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('userpermission._search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <div class="panel panel-dark">
 <div class="panel panel-default">
        <div class="panel-heading" style='margin-top:20px;'>
        
		<div style="float: right;">
     
	 <a href="<?php echo e(url('Userpermission/create')); ?>" class="btn btn-default c">Create Permissions</a>
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
		 <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 <tr>
				 <td>
					 <?= str_replace("_","-",$model->name); ?>
				 </td>
			
				 <td>
					 <?= str_replace("_","-",$model->description); ?>
				 </td>
				 <td>
					 <a href="<?php echo url('/Userpermission/show'.'/'. $model->id);; ?> " class="btn btn-success">View</a>
					 <a href="<?php echo e(route('Userpermission.edit', $model->id)); ?>" class="btn btn-info">Update</a>
					 <a href="javascript:void(0)" id='deleterow' class='btn btn-danger' data-account-id='<?php echo $model->id; ?>' >Delete</a>
				 </td>
			 </tr>
		
		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
				 <?php echo e($models->appends($_GET)->links()); ?>

			 </td>
		 </tr>

		 </tbody>
	 </table>
 </div>
</div>

 <?php echo $__env->make('ajax_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>