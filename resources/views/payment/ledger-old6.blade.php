@extends('admin.master')
@section('content')
	<style>
		th, td {
			padding: 20px;
		}
	</style>

	<div class="panel panel-dark" id="printablearea" class='printablearea'>
		<div class="panel-heading">
			<button class='btn btn-success' id='print_out_this_page' class='btn btn-success' title='Print Ledger' style="float: right; margin-right: 1%;margin-top: -8px;">
				<i class='fa fa-print'></i> Print ledger
			</button>
			<h4 class="panel-title">Payment Ledger</h4>
		</div>
		<div class="panel-body" >
			<span id='member_info'></span>
			<div class="row" style='width:100% !important'>
				<table class="table table-bordered table-resposive" style='width:100% !important'>
					<tbody>
						<tr>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>P/PJO/O</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important; '>Name</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Rank/Rate</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>File Number</th>
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;' colspan="4">Cat</th>
						</tr>
						<tr>
							<td style='border:1px solid black;width:10% !important;'>
								@if(!empty($member_info->hasPromotedMember))
									{{ $member_info->hasPromotedMember->new_p_no }}
								@else
									{{ $member_info->p_no }}
								@endif
							</td>
							<td style='border:1px solid black;width:10% !important;'>{{ $member_info->name }}</td>
							<td style='border:1px solid black;width:10% !important;'>
								@if(!empty($member_info->hasPromotedMember))
									{{ $member_info->hasPromotedMember->hasPromotedRank->name }}
								@else
									{{ $member_info->hasRank->name }}
								@endif
							</td>
							<td style='border:1px solid black;width:10% !important;'>
								@if(!empty($member_info->hasPromotedMember))
									{{ $member_info->hasPromotedMember->file_registration_no }}
								@else
									{{ $member_info->reg_file_no??'N/A' }}
								@endif
							</td>
							<td style='border:1px solid black; !important;' colspan="4">
								@if(!empty($member_info->hasPromotedMember))
									{{ $member_info->hasPromotedMember->hasPromotedRank->hasHouseCategory->name }}
								@else
									{{ $member_info->hasRank->hasHouseCategory->name??'--' }}
								@endif
							</td>
						</tr>
						<tr>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>S.No#</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Instrument No / <br /> Slip No</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important; '>Date</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Payment Type</th>
							<!-- <th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Payable</th> -->
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Payment Made(Rs)</th>
							<th style='border:1px solid black; background-color:#1d2939; color:white; !important;'>Total Paid Amount</th>
							<th style='border:1px solid black;width:10%; background-color:#1d2939; color:white; !important;'>Remaining Dues/Over Paid Amount</th>
						</tr>
						@php $counter = 0; @endphp
                        @foreach($models as $model)
							@php $counter++; @endphp
							<tr>
								<td style='border:1px solid black;width:10% !important;'>{{ $counter }}.</td>
								<td style='border:1px solid black;width:10% !important;'>
									@if(!empty($model->instrument_no))
										{{ $model->instrument_no }}
									@elseif(!empty($model->slip_no))
										{{ $model->slip_no }}
									@else
										{{ 'N/A' }}
									@endif
									
								</td>
								<td style='border:1px solid black;width:10% !important;'><?= date('d-m-Y',strtotime($model->created_at)) ?></td>
								<td style='border:1px solid black; !important;'><?= ucwords($model->payment_type??'--'); ?></td>
								<!-- <td style='border:1px solid black;width:10% !important;'>{{ number_format($model->total_amount) }}</td> -->
								<td style='border:1px solid black;width:10% !important;'>
                                    {{ number_format($model->current_paid) }}
								</td>
								<td style='border:1px solid black;width:10% !important;'>
									@if(number_format($model->amount)>-1)
										{{ number_format($model->amount) }}
									@else
										{{ number_format($model->submitted_amount) }}
									@endif
								</td>
								<td style='border:1px solid black;width:5% !important;'>{{ number_format($model->amount) }}</td>
							</tr>
						@endforeach
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
		$('#print_out_this_page').click(function(e){
			e.preventDefault();
			$('#print_out_this_page').hide();
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
	</script>
@endsection
