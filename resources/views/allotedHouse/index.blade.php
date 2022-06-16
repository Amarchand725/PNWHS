@extends('admin.master')
@section('content')

	@include('allotedHouse._search')
	<br />
	<div class="panel panel-dark">
		<div class="panel panel-default">
		<div class="panel-heading" style='margin-top:20px;'>
			<div class="">
			<h4 class='panel-title'>Alloted Houses</h4>
			</div>
		</div>
		</div>

		<div class="">
		<table class="table table-striped">
			<thead>
			<tr>
				<th><b>#</b></th>
				<th><b>P.No</b></th>
				<th><b>Rank & Name</b></th>
				<th><b>Alloted H. No</b></th>
				<th><b>Alloted Acc. of</b></th>
				<th><b>House Price</b></th>
				<th><b>Submitted</b></th>
				<th><b>Remaining</b></th>
				<th><b>Dues Install</b></th>
				<th><b>Payment Status</b></th>
				<th><b>Alloted_at</b></th>
				</tr>
			</thead>
			@if(!empty($models))
			<tbody class='ajax_content'>
				<?php $counter = 1; ?>
				@foreach($models as $model)
					@php 
						$house_price = $model->hasHouse->amount+$model->hasHouse->hasConstruction->initial_price;
					@endphp
					<tr>
						<td>{{ $counter++ }}.</td>
						<td>{{ $model->p_no }}</td>
						<td>{{ $model->hasUser->hasRank->name }} {{ ucfirst($model->hasUser->name) }}</td>
						<td>{{ $model->allocated_house }}</td>
						<td>
							@if($model->allocated_account_of == 'House Percent')
								<span class='label label-success'><i class='fa fa-check'></i> {{ $model->allocated_account_of }} (%)</span>
							@elseif($model->allocated_account_of == 'Shaheed')
								<span class='label label-info'><i class='fa fa-check'></i> {{ $model->allocated_account_of }}</span>
							@elseif($model->allocated_account_of == 'House Percent')
								<span class='label label-primary'><i class='fa fa-check'></i> {{ $model->allocated_account_of }}</span>
							@endif
						</td>
						<td>{{ number_format($house_price) }}</td>
						<td>{{ number_format($model->hasPayment->sum('sub_monthly_install')) }}</td>
						<td>{{ number_format($model->hasPayment->sum('sub_monthly_install')-$house_price) }}</td>
						<td>{{ number_format($model->house_dues_instalment) }}</td>
						<td>
							@if($model->payment_status==1)
								<span class='label label-danger'>Opened</span>
							@else
								<span class='label label-success'><i class='fa fa-check'></i> Cleared At: {{ date('d-F-Y', strtotime($model->created_at)) }}</span>
							@endif
						</td>
						<td>
							{{ date('d-F-Y', strtotime($model->created_at)) }}
						</td>
					</tr>
				@endforeach
			</tbody>
			@endif
		</table>
		</div>
	</div>

@endsection