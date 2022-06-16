@extends('admin.master')
@section('content')
	@include('newsletter._search')

	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
			@if($usertype != 'user')
				<a href="{{ route('Newsletter.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;"><i class="fa fa-plus"></i> Add Newsletter</a>
			@endif

			<h4 class="panel-title">View Newsletter</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
			<table class="table table-bordered">
			  <thead>
				<tr>
                  <th><b>#</b></th>
                  <th><b>Title</b></th>
				  <th><b>Subject</b></th>
                  <th><b>Expiry Date</b></th>
                  <th><b>Action</b></th>
				</tr>
			  </thead>
			  <tbody>
                @php $counter = 0; @endphp

				@foreach($models as $model)
					@php $counter++; @endphp
					<tr>
						<td>{{ $counter }}.</td>
						<td>{{ $model->title }}</td>
                        <td> {{ $model->subject }} </td>

                        <?php $expiryddate =  date('d-M-Y',strtotime($model->expiry_date)) ?>
                        <td>{{!empty($model->expiry_date) ? $expiryddate : "-"}}</td>
                        <td>
                            <a href="{{ route('Newsletter.show', $model->id) }}" title="Show" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            @if($usertype != 'user')
                            	<a href="{!! url('/Newsletter/destroy'.'/'. $model->id); !!}" onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                            @endif
						</td>
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