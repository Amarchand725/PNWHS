<?php $__env->startSection('content'); ?>
<?php echo $__env->make('flash_msgs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div style="float: right;">
	 <a href="<?php echo e(url('Userpermission/create')); ?>" class="btn btn-danger">Create Permissions</a>
 </div>
<?php
 echo Form::open(array('url' => 'Userroles/editpermissionstore', 'method' => 'post'));
?>
 <input type="hidden" value='<?php echo e($roleid); ?>' name='userid' />
<input type="hidden" value="" name='checkeddata' class='checkeddata' /> 
 <div class="">
	 <h2>Manage Roles</h2>

	 <table class="table table-striped">
		 <thead>
		 <tr>
             <th style="background-color: #428bca;"><b>Select Role</b></th>
			 <th style="background-color: #428bca;"><b>Role</b></th>
		 </tr>
		 </thead>
		 <tbody class='ajax_content'>
		     
		     <?php if(Auth::user()->user_type == 2){
		    ?>
		    	 <?php $__currentLoopData = $userpermission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userpermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php   
		$userpermissiondata =   ucwords($userpermission->name);
		 ?>
	<tr>
			 <?php if(!empty($userrightsjson)){
				 ?>
				 <td><input <?php if(in_array($userpermissiondata, $userrightsjson)){echo 'checked';} ?>  type='checkbox' name='userpermissionval' value='<?php echo e($userpermissiondata); ?>' /></td>
				<td>
				<?= str_replace("_","-",$userpermissiondata); ?>
				</td>
				 <?php
			 }else{
				?>
				<td><input  type='checkbox' name='userpermissionval' value='<?php echo e($userpermissiondata); ?>' /></td>
				<td>
				<?= str_replace("_","-",$userpermissiondata); ?>
				</td>
				<?php
			 } ?>
			 </tr>
		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		    <?php
		     }
		     
		     ?>
	
		 
	<tr>
    <td>
    <div class="panel-footer">
            <div class="form-group">
                <?php echo Form::submit('Update Permission', ['class' => 'btn btn-primary']); ?>

            </div>
        </div>
    </td>
    </tr>
		 <tr style="align-content: center">
			 <td colspan="6">
			 </td>
		 </tr>
		 </tbody>
	 </table>
 </div>
 <?php echo $__env->make('ajax_pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo Form::close(); ?>

 <script>
    $(document).ready(function() {
        $(".btn").click(function(){
            var favorite = [];
            $.each($("input[name='userpermissionval']:checked"), function(){
                favorite.push($(this).val());
            });
            var myJSON = JSON.stringify(favorite);
            $('.checkeddata').val(myJSON);
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>