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
			<h4 class="panel-title">Contractor Ledger</h4>
		</div>
		<div class="panel-body" >
			<div class="row" style='width:100% !important'>
				<table class="table table-bordered table-resposive" style='width:100% !important'>
					<tbody>
						<tr >
							<th style='border:1px solid black;width:5% !important;'>Sr No</th>
							<th style='border:1px solid black;width:5% !important; '>Date</th>
							<th style='border:1px solid black;width:5% !important;'>Plot No</th>
							<th style='border:1px solid black;width:5% !important;'>Status</th>
							<th style='border:1px solid black;width:5% !important;'>Initial Amount</th>
							<th style='border:1px solid black;width:5% !important;'>Final Amount</th>
						</tr>
						@php 
							$counter = 1;
							$total_amount = 0;
						@endphp
						@foreach($constructor_constructions as $constructor_construction)
							@php $total_amount+=$constructor_construction->final_price; @endphp
							<tr>
								<td style='border:1px solid black;width:5% !important;'>{{ $counter++ }}</td>
								<td style='border:1px solid black;width:5% !important;'>{{ date('d, F, Y', strtotime($constructor_construction->created_at)) }}</td>
								<td style='border:1px solid black;width:5% !important;'>{{ $constructor_construction->plot_id }}</td>
								<td style='border:1px solid black;width:5% !important;'>{{ $constructor_construction->status }}</td>
								<td style='border:1px solid black;width:5% !important;'>{{ number_format($constructor_construction->initial_price) }}</td>
								<td style='border:1px solid black;width:5% !important;'>{{ number_format($constructor_construction->final_price) }}</td>
							</tr>
						@endforeach
						<tr>
							<td style='border:1px solid black;width:5% !important; text-align:right' colspan='5'>Total Amount: </td>
							<td style='border:1px solid black;width:5% !important; text-align:right'>{{ number_format($total_amount) }}</td>
						</tr>
					</tbody>
				</table>
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