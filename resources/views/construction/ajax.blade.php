@foreach($models as $model)
			 <tr>
			 <td>{{$loop->index +1}}</td>
				 <td>
				 <?php $cons =  DB::table('constructor')->where('id',$model->constructor_id)->first(); ?>
					 {{$cons->name}} 
				 </td>
				 <td>
				 <?php $plot =  DB::table('plots')->where('id',$model->plot_id)->first(); ?>
					 {{$plot->plot_no}}
				 </td>
				 <td>
	 			{{$model->duaration}}
				 </td>
				 <td>
	 			{{$model->price}}
				 </td>
				 <td>
	 			{{$model->initial_price}}
				 </td>
				
			 <?php
			$exp =  explode(' ',$model->duaration);
			 $updatedate = date('Y-m-d', strtotime(date('Y-m-d') .'+'.$exp[0].' month')); 
			 $created_date =  date('Y-m-d',strtotime($model->created_at));
			 if(date('Y-m-d') > $updatedate){
?>
<td style='color:red'>
{{'Construction Period is over'}}				 
 </td>
<?php
			 }
			 else{
				 ?>
				<td style='color:green'>
				 {{$model->status}}	
				 </td>
				 <?php
			 }
			 ?>
	 		
				 
				 <td>
					 {{date('d-F-Y',strtotime($model->created_at))}}
				 </td>
				 <td>
					 <a href="{{route('Construction.show', $model->id) }} " class="btn btn-success">View</a>
					 <a href="{{ route('Construction.edit', $model->id) }}" class="btn btn-info">Update</a>
					 <a href="{!! url('/Construction/destroy'.'/'. $model->id); !!}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
				 </td>
			 </tr>
		
		 @endforeach
{{ $models->appends($_GET)->links() }}