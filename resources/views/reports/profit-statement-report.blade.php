@extends('admin.master')
@section('content')
  @include('flash_msgs')
  @include('reports.search-profit')
  <br>
  <?php
    $usersdata =  DB::table('userroles')->where('id',Auth::user()->role)->first();
    if(!empty($usersdata)){
      $userrightsjson =  json_decode($usersdata->rights);
    }
    else{
      $dummyarray = array();
      $userrightsjson = $dummyarray;
    } 
  ?>
  
  <div class="panel panel-dark">
    <div class="panel-heading">
      <h4 class="panel-title">Profit Statement Report</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table id="myTable" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th><b>P/P.J.No</b></th>
              <th><b>Rank & Name</b></th>
              <th><b>Member Status</b></th>
              <th><b>Submitted Amount</b></th>
              <th><b>Profit Percent %</b></th>
              <th><b>Profit Amount %</b></th>
              <th><b>Total Amount(PKR)</b></th>
            </tr>
          </thead> 
          <tbody>
            @foreach($members as $member)
              @if(!empty($membership_service))
                @php 
                  $membership_date = new \DateTime($member->created);
                @endphp
                @if(now()->diff($membership_date)->y >= 3)
                  <tr>
                    <td>{{ $member->p_no }}</td>
                    <td>{{ $member->hasRank->name }} {{ ucfirst($member->name) }}</td>
                    <td>
                      @if($member->hasMemberStatus->is_active==1)
                        <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                      @else
                        <span class='label label-danger'><i class='fa fa-times'></i> Inactive</span>
                      @endif
                    </td>
                    <td>
                      @php 
                        $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                      @endphp

                      <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                    </td>
                    <td>
                      <span class='label label-info'>{{ $profit_rate->rate }}%</span>
                    </td>
                    <td>
                      <span class='label label-success'>
                        @php $profit_amount = $paid_amount / 100 * $profit_rate->rate; @endphp
                        {{ number_format($profit_amount) }}</span>
                    </td>
                    <td>
                      <span class='label label-info'>{{ number_format($paid_amount+$profit_amount) }}</span>
                    </td>
                  </tr>
                @endif
              @elseif(!empty($service))
                @php 
                  $joining_date = new DateTime($member->d_o_sos);
                @endphp
                @if(now()->diff($joining_date)->y >= 23)
                  <tr>
                    <td>{{ $member->p_no }}</td>
                    <td>{{ $member->hasRank->name }} {{ ucfirst($member->name) }}</td>
                    <td>
                      @if($member->hasMemberStatus->is_active==1)
                        <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                      @else
                        <span class='label label-danger'><i class='fa fa-times'></i> Inactive</span>
                      @endif
                    </td>
                    <td>
                      @php 
                        $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                      @endphp

                      <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                    </td>
                    <td>
                      <span class='label label-info'>{{ $profit_rate->rate }}%</span>
                    </td>
                    <td>
                      <span class='label label-success'>
                        @php $profit_amount = $paid_amount / 100 * $profit_rate->rate; @endphp
                        {{ number_format($profit_amount) }}</span>
                    </td>
                    <td>
                      <span class='label label-info'>{{ number_format($paid_amount+$profit_amount) }}</span>
                    </td>
                  </tr>
                @endif
              @elseif(!empty($status))
                @if($member->hasMemberStatus->is_active==$status)
                  <tr>
                    <td>{{ $member->p_no }}</td>
                    <td>{{ $member->hasRank->name }} {{ ucfirst($member->name) }}</td>
                    <td>
                      @if($member->hasMemberStatus->is_active==1)
                        <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                      @else
                        <span class='label label-danger'><i class='fa fa-times'></i> Inactive</span>
                      @endif
                    </td>
                    <td>
                      @php 
                        $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                      @endphp

                      <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                    </td>
                    <td>
                      <span class='label label-info'>{{ $profit_rate->rate }}%</span>
                    </td>
                    <td>
                      <span class='label label-success'>
                        @php $profit_amount = $paid_amount / 100 * $profit_rate->rate; @endphp
                        {{ number_format($profit_amount) }}</span>
                    </td>
                    <td>
                      <span class='label label-info'>{{ number_format($paid_amount+$profit_amount) }}</span>
                    </td>
                  </tr>
                @endif
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable();
    });
  </script>
@endsection