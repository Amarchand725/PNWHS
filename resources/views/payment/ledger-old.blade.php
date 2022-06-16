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
						<th style='border:1px solid black;width:5% !important;'>P No.</th>
						<th style='border:1px solid black;width:5% !important; '>Date</th>
						<th style='border:1px solid black;width:5% !important;'>Nature of Payment</th>
						<th style='border:1px solid black;width:5% !important;'>Total Amount</th>
						<th style='border:1px solid black;width:5% !important;'>Amount Paid</th>
						<th style='border:1px solid black;width:5% !important;'>Remaining Balance</th>
                    </tr>
					<?php $counter = 1;
					$membership_id = $payment_schedule->membership_id;
					$membership_payment = DB::table('membershippayment')->where('id',$membership_id)->value('mpayment');
					$total_cost = $payment_schedule->total_amount;
					$totalpaidamount = $payment_schedule->total_amount-$membership_payment;
					?>
				<?php if(!empty($model)){?>
                @foreach($model as $value)

					<tr>
                        <td style='border:1px solid black;width:5% !important;'>{{$counter++}}</td>
						<td style='border:1px solid black;width:5% !important;'>{{$value->p_no}}</td>
                        <td style='border:1px solid black;width:5% !important;'><?= date('d-m-Y',strtotime($value->created_at)) ?></td>
                        <!-- <td>{{!empty($value->date) ? $value->date : "-" }}</td> -->
                        <?php
                        if($value->payment_status == 0){
                                ?>
                                <td style='border:1px solid black;width:5% !important;color:red !important;'><?= ucwords($value->payment_type); ?>(Bounce)</td>
                                <?php
                        }
                        if($value->payment_status == 1){
                            ?>
                             <td style='border:1px solid black;width:5% !important;'><?= ucwords($value->payment_type); ?></td>
                            <?php
                        }
                        if($value->payment_status == 2){
                            ?>
<td style='border:1px solid black;width:5% !important;color:red !important;'><?= ucwords($value->payment_type); ?>(Pending)</td>
                            <?php
                        }
                        ?>

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
                        <td style='border:1px solid black;width:5% !important;'>{{$value->amounts}}</td>
						<td style='border:1px solid black;width:5% !important;'>


						<?php
				 if(!empty($value->amounts)){
				echo $cnr->gettypenumber($total_cost -= $value->amounts);
				 }
				 else{
					echo '-';
				 }
				?>

						</td>
					</tr>
				@endforeach
		<?php	} ?>
		<?php if(!empty($acc)){?>
                @foreach($acc as $value)

					<tr>
                        <td style='border:1px solid black;width:5% !important;'>{{$counter++}}</td>
						<td style='border:1px solid black;width:5% !important;'>{{$value->p_no}}</td>
                        <td style='border:1px solid black;width:5% !important;'>{{$value->date}}</td>
						<!-- <td>{{!empty($value->date) ? $value->date : "-" }}</td> -->
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
                        <td style='border:1px solid black;width:5% !important;'>{{$value->amount}}</td>
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
		<?php	} ?>

					<tr>
						<td colspan="5" style="text-align: right;"><b></b></td>
						<th style="color: green"></th>
					</tr>

				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- <div style='float: right' class="print_hide">
<button id='print_out_this_page' class="btn btn-sm btn-primary "><i class="fa fa-print"> &nbsp;</i>Print</button>
</div> -->
<script>
// document.getElementById("print_out_this_page").addEventListener("click", function() {
//      var printContents = document.getElementById('printDiv').innerHTML;
//      var originalContents = document.body.innerHTML;
//      document.body.innerHTML = printContents;
//      window.print();
//      document.body.innerHTML = originalContents;
// });

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
// function printElem() {

// }



</script>

    @endsection
