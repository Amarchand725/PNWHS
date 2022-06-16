@extends('admin.master')
@section('content')
    @include('flash_msgs')
    
    {!! Form::open([
        'route' => 'CsvFile.store',
        'enctype' => 'multipart/form-data'
    ]) !!}

	@if($submit_name != 'conflected-list')
		<input type="hidden" name='csv_file_id' value='{{ $csv_raw_file_id }}'>
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">
					@if($submit_name=='registered-list')
						Registered Members Record
					@elseif($submit_name=='unregistered-list')
						Unregistered Members Record
					@endif
				</h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<table class="table table-bordered">
						<thead>
							<tr>
							<td><b><label for='selectAll'><input type="checkbox" id="selectAll" />&nbsp;<strong> Select All</strong></label></b></td>
							<th><b>P/PJO No</b></th>
							<th><b>Name</b></th>
							<th><b>Rank</b></th>
							<!-- <th><b>Reg:Fee (PKR)</b></th>
							<th><b>Insurance (PKR)</b></th> -->
							<th><b>Amount (PKR)</b></th>
							<!-- <th><b>Date</b></th> -->
							</tr>
						</thead>
						<tbody class='ajax_content'>
							@foreach($members as $member)
								<tr>
									<td><input type="checkbox" name="records[]" value="{{ $member['pjo'] }}" /></td>
									<td>{{ $member['pjo'] }}</td>
									<td>{{ $member['name']??'N/A' }}</td>
									<td>{{ $member['rank']??'N/A' }}</td>
									<!-- <td>{{ number_format($member['reg_fee'])??'N/A' }}</td>
									<td>{{ number_format($member['insurance'])??'N/A' }}</td> -->
									<td>
										@foreach($members_paid as $key=>$paid)
											@if($key==$member['pjo'])
												{{ number_format($paid) }}
											@endif
										@endforeach
									</td>
									<!-- <td>
										@if($member['date']=='January-1970')
											{{ date('d, M-Y') }}
										@else
											{{ date('d, M-Y', strtotime($member['date'])) }}
										@endif
									</td> -->
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="form-group">
					<button class='btn btn-success' type='submit'><i class='fa fa-save'></i> Save</button>
				</div>
			</div>
		</div>
	@else
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">
					Conflected Records
				</h4>
			</div>
			<div class="panel-body">
				<div class="row">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th><b>P/PJO No</b></th>
								<th><b>Name</b></th>
								<th><b>Rank</b></th>
								<th><b>Amount (PKR)</b></th>
								<th><b>Date</b></th>
							</tr>
						</thead>
						<tbody class='ajax_content'>
							@foreach($members as $member)
								@if($conflected_records[$member['pjo']]>1)
									<tr>
										<td>{{ $member['pjo'] }}</td>
										<td>{{ $member['name']??'N/A' }}</td>
										<td>{{ $member['rank']??'N/A' }}</td>
										<td>
										@foreach($members_paid as $key=>$paid)
											@if($key==$member['pjo'])
												{{ number_format($paid) }}
											@endif
										@endforeach
										</td>
										<td>
											@if($member['date']=='January-1970')
												{{ date('d, M-Y') }}
											@else
												{{ date('d, M-Y', strtotime($member['date'])) }}
											@endif
										</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	@endif

    {!! Form::close() !!}

	<script>
		$('#selectAll').click(function(e){
			var table= $(e.target).closest('table');
			$('td input:checkbox',table).prop('checked',this.checked);
		});
	</script>
@endsection