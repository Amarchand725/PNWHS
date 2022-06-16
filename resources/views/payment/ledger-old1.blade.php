@extends('admin.master')
@section('content')
	<style>
		th, td {
			padding: 20px;
		}
	</style>

	<div class="panel panel-dark" id="printablearea" class='printablearea'>
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="minimize">&minus;</a>
			</div>
			<h4 class="panel-title">Payment Ledger</h4>
		</div>
		<div class="panel-body" >
			<div class="row" style='width:100% !important'>
				<table class="table table-bordered table-resposive" style='width:100% !important'>
					<tbody>
						<tr >
							<th style='border:1px solid black;width:5% !important;'>Sr No</th>
							<th style='border:1px solid black;width:5% !important; '>Date</th>
							<th style='border:1px solid black;width:5% !important;'>Payment Type</th>
							<th style='border:1px solid black;width:5% !important;'>Total Amount</th>
							<th style='border:1px solid black;width:5% !important;'>Amount Paid</th>
							<th style='border:1px solid black;width:5% !important;'>Remaining Balance</th>
						</tr>
						@php $counter = 1; @endphp
						@foreach($models as $model)
							<tr>
								<td style='border:1px solid black;width:5% !important;'>{{ $counter++ }}.</td>
								<td style='border:1px solid black;width:5% !important;'><?= date('d-m-Y',strtotime($model->created_at)) ?></td>
								<td style='border:1px solid black;width:5% !important;'><?= ucwords($model->payment_type??'--'); ?></td>
								<td style='border:1px solid black;width:5% !important;'>{{ number_format($model->total_amount) }}</td>
								<td style='border:1px solid black;width:5% !important;'>
									@if($model->is_active==1)
										{{ number_format($model->sub_monthly_install) }}
									@else
										{{ number_format($model->submitted_amount) }}
									@endif
								</td>
								<td style='border:1px solid black;width:5% !important;'>{{ number_format($model->amount) }}</td>	
							</tr>
						@endforeach
						@if(!empty($acc))
							@foreach($acc as $value)
								<tr>
									<td style='border:1px solid black;width:5% !important;'>{{$counter++}}</td>
									<td style='border:1px solid black;width:5% !important;'>{{$value->p_no}}</td>
									<td style='border:1px solid black;width:5% !important;'>{{$value->date}}</td>
									<td style='border:1px solid black;width:5% !important;'>{{'Through CSV'}}</td>
									<td style='border:1px solid black;width:5% !important;'>
									<?php
										if(!empty($total_cost)){
											echo $cnr->gettypenumber($total_cost);
										}
										else{
											echo '-';
										}
									?>
									</td>
									<td style='border:1px solid black;width:5% !important;'>{{ number_format($value->amount) }}</td>
									<td style='border:1px solid black;width:5% !important;'>
									<?php
										if(!empty($value->amount)){
											echo $cnr->gettypenumber($total_cost -= $value->amount);
										}
										else{
											echo '-';
										}
									?>
									</td>
								</tr>
							@endforeach
						@endif
						<tr>
							<td colspan="5" style="text-align: right;"><b></b></td>
							<th style="color: green"></th>
						</tr>
					</tbody>
				</table>
				<span>{{ $models->links() }}</span>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$('#print_out_this_page').click(function(e){
				e.preventDefault();
				$('#printablearea').css('display','block');
				$('.panel-btns').css('display','none');
				$('.panel-title').css('font-size','25px');
				$('.maindata').css('margin-left','0px');
				$('.panel-title').css('text-align','center');

				var content = document.getElementById('printablearea').innerHTML;
				var mywindow = window.open('', 'Print', 'height=900,width=1300');
				mywindow.document.write('<html><head><title>Print</title>');
				mywindow.document.write('</head><body style="margin-left:0px !important;">');
				mywindow.document.write(content);
				mywindow.document.write('</body></html>');
				mywindow.document.close();
				mywindow.focus()
				mywindow.print();
				mywindow.close();
				return false;
			});
		});
	</script>
@endsection