@extends('admin.master')
@section('content')
	<style>
		th, td {
			padding: 20px;
		}
	</style>

	<div class="panel panel-dark" id="printablearea" class='printablearea'>
		<div class="panel-heading">
			<button class='btn btn-success' data-member='{{ $member_info }}' id='print_out_this_page' class='btn btn-success donwload_members_record' style="float: right; margin-right: 1%;margin-top: -8px;">
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
							<th style='border:1px solid black;width:20% !important;'>Sr No</th>
							<th style='border:1px solid black;width:20% !important; '>Date</th>
							<th style='border:1px solid black;width:20% !important;'>Payment Type</th>
							<th style='border:1px solid black;width:20% !important;'>Current Paid Amount</th>
							{{-- <th style='border:1px solid black;width:5% !important;'>Total Deposited Amount</th> --}}
							<th style='border:1px solid black;width:20% !important;'>Due/Over Paid</th>
						</tr>
						@php $counter = 1; @endphp
                        @foreach($models as $model)
							<tr>
								<td style='border:1px solid black;width:20% !important;'>{{ $counter++ }}.</td>
								<td style='border:1px solid black;width:20% !important;'><?= date('d-m-Y',strtotime($model->created_at)) ?></td>
								<td style='border:1px solid black;width:20% !important;'><?= ucwords($model->payment_type??'--'); ?></td>
								{{-- <td style='border:1px solid black;width:20% !important;'>{{ number_format($model->total_amount) }}</td> --}}
								<td style='border:1px solid black;width:20% !important;'>
									{{-- @if($model->is_active==1)
										{{ number_format($model->sub_monthly_install) }}
									@else
										{{ number_format($model->submitted_amount) }}
                                    @endif --}}
                                    {{ number_format($model->current_paid) }}
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
			var member = $(this).data('member');
			console.log(member);
			var html = '<table style="border: 2px solid black">'+
							'<tr>'+
								'<td colspan="3">PNo: </td>'+
								'<td>'+member.p_no+'</td>'+
							'</tr>'+
							'<tr>'+
								'<td colspan="3">Name: </td>'+
								'<td>'+member.name+'</td>'+
							'</tr>'+
						'</table>';
			$('#member_info').html(html);

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
