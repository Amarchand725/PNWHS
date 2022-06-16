@extends('admin.master')
@section('content')
	<style>
		th, td {
			padding: 20px;
		}
	</style>

    <div class="col-sm-6">
        <div class="panel panel-dark" id="printablearea" class='printablearea'>
            <div class="panel-heading">
                <button class='btn btn-success' id='print_out_this_page' class='btn btn-success' title='Print Reciept' style="float: right; margin-right: 1%;margin-top: -8px;">
                    <i class='fa fa-print'></i> Print Reciept
                </button>
                <h4 class="panel-title">Reciept No# {{ $model->id }}</h4>
            </div>
            <div class="panel-body" >
                <span id='member_info'></span>
                <div class="row" style='width:100% !important'>
                    <table class="table table-bordered table-resposive" style='width:100% !important'>
                        <tbody>
                            <tr>
                                <th style='border:1px solid black;width:20%; background-color:#1d2939; color:white; !important; '>
                                    Reciept No# 
                                    <span style='float:right'>{{ $model->id }}</span>
                                </th>
                                <th style='border:1px solid black;width:20%; background-color:#1d2939; color:white; !important;'>
                                    P/PJO/O
                                    <span style='float:right'>{{ $model->p_no }}</span>
                                </th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:20% !important;'>Name | Rank</th>
                                <th style='border:1px solid black;width:20% !important;'>
                                    @if(!empty($model->hasPromotedMember))
                                        <b style="float:right">
                                            {{ $model->hasPromotedMember->hasMember->name }} | 
                                            {{ $model->hasPromotedMember->hasPromotedRank->name }}
                                        </b>
                                    @else
                                        <b style="float:right">{{ $model->hasMember }}</b>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:50%; !important;'>Reciever's Name</th>
                                <th style='border:1px solid black;width:50%; !important;'>{{ $model->reciever_name }}</th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:50%; !important;'>Reciever's CNIC</th>
                                <th style='border:1px solid black;width:50%; !important;'>{{ $model->reciever_cnic }}</th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:50%; !important;'>Bank Name</th>
                                <th style='border:1px solid black;width:50%; !important;'>{{ $model->bank_name }}</th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:50%; !important;'>Payment Method</th>
                                <th style='border:1px solid black;width:50%; !important;'>{{ $model->payment_method }}</th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:50%; !important;'>Ref/cheque No:</th>
                                <th style='border:1px solid black;width:50%; !important;'>{{ $model->ref_cheque_no }}</th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:50%; !important;'>Refundable Amount:</th>
                                <th style='border:1px solid black;width:50%; !important;'>{{ $model->total_amount }}</th>
                            </tr>
                            <tr>
                                <th style='border:1px solid black;width:50%; !important;'>Payment Released Date</th>
                                <th style='border:1px solid black;width:50%; !important;'>{{ $model->date }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
