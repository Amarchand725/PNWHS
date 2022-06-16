@extends('admin.master')
@section('content')
@include('flash_msgs')
<div style="float: right;">
	 <a href="{{url('Userpermission/create')}}" class="btn btn-danger">Create Permissions</a>
 </div>
<?php
 echo Form::open(array('url' => 'Userroles/editpermissionstore', 'method' => 'post'));
?>
 <input type="hidden" value='{{$roleid}}' name='userid' />
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
		    	 @foreach($userpermission as  $userpermission)
		<?php   
		$userpermissiondata =   ucwords($userpermission->name);
		 ?>
	<tr>
			 <?php if(!empty($userrightsjson)){
				 ?>
				 <td><input <?php if(in_array($userpermissiondata, $userrightsjson)){echo 'checked';} ?>  type='checkbox' name='userpermissionval' value='{{$userpermissiondata}}' /></td>
				<td>
				<?= str_replace("_","-",$userpermissiondata); ?>
				</td>
				 <?php
			 }else{
				?>
				<td><input  type='checkbox' name='userpermissionval' value='{{$userpermissiondata}}' /></td>
				<td>
				<?= str_replace("_","-",$userpermissiondata); ?>
				</td>
				<?php
			 } ?>
			 </tr>
		 @endforeach
		    <?php
		     }
		     
		     ?>
	
		 
	<tr>
    <td>
    <div class="panel-footer">
            <div class="form-group">
                {!! Form::submit('Update Permission', ['class' => 'btn btn-primary']) !!}
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
 @include('ajax_pagination')
 {!! Form::close() !!}
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
@endsection