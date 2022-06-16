@extends('admin.master')
@section('content')
	<br />
	<div class="panel panel-dark">
		<div class="panel-heading">
            <h4 class="panel-title">Display Sheet</h4>
		</div>
		<div class="panel-body">
		  <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><b>P.No</b></th>
                        <th><b>Name</b></th>
                        <th><b>Rank</b></th>
                        <th><b>Month of</b></th>
                        <th><b>Reg:Fee(PKR)</b></th>
                        <th><b>Insurance(PKR)</b></th>
                        <th><b>Amount(PKR)</b></th>
                        <th><b>Total Paid</b></th>
                        <th><b>Created By</b></th>
                        <th><b>Created_at</b></th>
                    </tr>
                </thead>
                <tbody class='ajax_content'>
                    @foreach($model->hasData as $data)
                        <tr>
                            <td>{{ $data->p_no }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->rank }}</td>
                            <td>{{ date('F, Y', strtotime($data->month)) }}</td>
                            <td>{{ number_format($data->reg_fee)??'--' }}</td>
                            <td>{{ number_format($data->insurance_payment)??'--' }}</td>
                            <td>
                                <span class='label label-info'>{{ number_format($data->amount) }}</span>
                            </td>
                            <td>
                                <span class='label label-success'>{{ number_format((int)$data->reg_fee+(int)$data->insurance_payment+(int)$data->amount) }}</span>
                            </td>
                            <td>{{ $model->hasUserCreatedBy->name }} | {{ $model->hasUserCreatedBy->hasRole->role }}</td>
                            <td>{{ date('d, F-Y | H:i A', strtotime($data->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
		  </div>
		</div>
	</div>
@endsection