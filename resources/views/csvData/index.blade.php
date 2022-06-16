@extends('admin.master')
@section('content')

@include('csvData._search')

<div class="panel panel-dark">
    <div class="panel panel-default">
      <div class="panel-heading" style='margin-top:20px;'>
        <!-- <div style="float: right;">
          <a href="{{url('Payment/create')}}" class="btn btn-default c">Create Payment</a>
        </div> -->

        <div class="">
          <h4 class='panel-title'><i class='fa fa-file'></i> Manage CSV Payment</h4>
        </div>
      </div>
    </div>

    <div class="">
      <table class="table table-striped">
        <thead>
          <tr>
              <th><b>#</b></th>
              <th><b>P/PJO No</b></th>
              <th><b>Name | Rank</b></th>
              <th><b>Is Member</b></th>
              <th><b>Deducted Amount</b></th>
              <th><b>Date</b></th>
              <th><b>Create_at</b></th>
            </tr>
        </thead>
        @if(!empty($models))
          <tbody class='ajax_content'>
            <?php $counter = 1; ?>
            @foreach($models as $model)
              <tr>
                <td>{{$counter++}}.</td>
                <td>{{!empty($model->p_no) ? $model->p_no : '-'}} </td>
                <td>{{ $model->hasMember->hasUser->first_name??'N/A' }} | {{ $model->hasMember->hasRank->name??'N/A' }}</td>
                <td>
                  @if($model->is_member=='1')
                    <span class='label label-success'>{{  'Member' }}</span>
                  @else  
                    <span class='label label-danger'>{{ 'Not Member' }}</span>
                  @endif
                </td>
				<td>{{ number_format($model->amount) }}</td>
				<td>
					@if($model->month=='January-1970')
						{{ date('d, M-Y') }}
					@else
						{{ date('d, M-Y', strtotime($model->month)) }}
					@endif
				</td>
                <td>
                  {{ date('d, M-Y | H:i A', strtotime($model->created_at)) }}
                </td>
              </tr>
            @endforeach
          </tbody>
        @endif
      </table>
      <span>{{ $models->links() }}</span>
    </div>
</div>

@endsection