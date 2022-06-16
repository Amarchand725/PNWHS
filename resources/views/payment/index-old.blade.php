@extends('admin.master')
@section('content')
  @include('flash_msgs')
  @include('payment._search')
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>

  <div class="panel panel-dark">
    <div class="panel panel-default">
      <div class="panel-heading" style='margin-top:20px;'>
        <div style="float: right;">
          <a href="{{url('Payment/create')}}" class="btn btn-default c">Create Payment</a>
        </div>

        <div class="">
          <h4 class='panel-title'>Manage Payment</h4>
        </div>
      </div>
    </div>

    <div class="">
      <table class="table table-striped">
        <thead>
          <tr>
              <th><b>#</b></th>
              <th><b>P.No</b></th>
              <th><b>Name | Rank</b></th>
              <th><b>Payment Type</b></th>
              <th><b>Submitted Amount</b></th>
              <th><b>Create_at</b></th>
              <th><b>Action</b></th>
            </tr>
        </thead>
        @if(!empty($models))
          <tbody class='ajax_content'>
            <?php $counter = 1; ?>
            @foreach($models as $model)
              <tr>
                <td>{{$counter++}}.</td>
                <td>{{!empty($model->p_no) ? $model->p_no : '-'}} </td>
                <td>{{ $model->hasMember->name??'N/A' }} | {{ $model->hasMember->hasRank->name??'N/A' }}</td>
                <td>{{ $model->payment_type }}</td>
                <td>
                  @if($model->is_active=='1')
                    <span class='label label-success'>{{ number_format($model->submitted_amount ) }}</span>
                  @else
                    <span class='label label-success'>{{ number_format($model->total_instalments_amount) }}</span>
                  @endif
                </td>
                <td>
                  {{ date('d-M-Y | H:i A', strtotime($model->created_at)) }}
                </td>
                <td>
                  <div class="row" style="width:150px !important;">
                    <a href="{{ url('Ledger', $model->p_no) }}" data-toggle="tooltip"  title="Ledger" class="btn btn-warning"> <span class="glyphicon glyphicon-align-justify"></span></a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        @endif
      </table>
      <span>{{ $models->links() }}</span>
    </div>
  </div>

  @include('ajax_pagination')
@endsection