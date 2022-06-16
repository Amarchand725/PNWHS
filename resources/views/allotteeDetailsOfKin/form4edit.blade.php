
<?php echo Form::open(array('url' => 'AllotteeDetailsOfKin/form4update', 'method' => 'post','files' => 'true')); ?>
<style>
	#autoResizeTA{
		height: 39px !important;
	}
	#autoResizeTb{
		height: 200px !important;
	}
</style>
<table class="table table-striped" id="item_table">
	<thead>
		<tr>
			<th>List Of Document Required</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>
            <input type='hidden' value='{{$model->cnicfront}}' name='old_image'/>
            <input type="file" name="cnicfront[]" class="form-control" multiple="multiple">
            </td>
		</tr>
	</tbody>
</table>
<div class='clearfix'></div>
	<div class='row'>
	<div class="col-md-12">
		<div class="form-group">
	<ul class="pager wizard">
					<li class=" pull-right">
					<input type='submit' name='next' class=" btn btn-info" value='Next'/>

					</li>
				</ul>
</div></div>
</div>

{!! Form::close() !!}
