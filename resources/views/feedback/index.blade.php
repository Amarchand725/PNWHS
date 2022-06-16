

@extends('admin.master')
@section('content')

@include('feedback._search')

	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
            <?php if($usertype == 'user'){?>
		  <a href="{{ route('Feedback.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Add your Feedback</a>
            <?php } ?>
          <h4 class="panel-title">View Feedback</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th><b>#</b></th>
				  <th><b>Title</b></th>
                  <th><b>Description</b></th>
                  <?php if($usertype != 'user'){?>
                  <th><b>User name</b></th>
                  <?php } ?>
                  <th><b>Created_at</b></th>

				</tr>
			  </thead>
			  <tbody>
                  @php $counter = 0; @endphp

				@foreach($models as $model)
					@php $counter++; @endphp
					<tr>
						<td>{{ $counter }}.</td>
						<td>{{ $model->title }}</td>
                        <td> {{ $model->description }} </td>
                        <?php if($usertype != 'user'){?>
                        <?php if(!empty($model->user_id) || $model->user_id){
                           $username =  DB::table('users')->where('id',$model->user_id)->value('name');
                           ?>
                            <td> {{ $username }} </td>
                           <?php
                        }else{
                            ?>
                            <td> - </td>
                         <?php
                        } }?>

                        <?php $createddate =  date('d-M-Y',strtotime($model->created_at)) ?>
                        <td>{{!empty($model->created_at) ? $createddate : "-"}}</td>


					</tr>
				@endforeach
				<tr style="align-content: center">
				  <td colspan="12">
				  	{{ $models->links() }}
				  </td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>

@endsection
