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
                        <th><b>Amount(PKR)</b></th>
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
                            <td>
                                <span class='label label-info'>{{ $data->amount }}</span>
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