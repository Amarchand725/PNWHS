@extends('admin.master')
@section('content')
  @include('flash_msgs')
  @include('reports.search-financial')
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
      <h4 class="panel-title">Member Financial Report</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table id="myTable" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th><b>Status</b></th>
              <th><b>P/P.J.No</b></th>
              <th><b>Rank & Name</b></th>
              <th><b>Member Status</b></th>
              <th><b>Eligibility</b></th>
              <th><b>Paid Percent %</b></th>
              <th><b>Amount(PKR)</b></th>
            </tr>
          </thead> 
          <tbody>
            @foreach($members as $member)
              @if(!empty($member->hasAllotedHouse) AND $member->hasAllotedHouse->allocated_account_of!='Shaheed' AND $member->hasAllotedHouse->allocated_account_of!='Medical')
                @if(!empty($membership_service))
                  @php 
                    $membership_date = new \DateTime($member->created);
                  @endphp
                  @if(now()->diff($membership_date)->y >= 3)
                    <tr>
                      <td>
                        @if($member->payment_status==0)
                          <span style='color:green'><i class='fa fa-check'></i></span>
                        @else
                          <span style='color:red'><i class='fa fa-spinner'></i></span>
                        @endif
                      </td>
                      <td>{{ $member }}</td>
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
                          $house_price_in_percent = number_format(floor($paid_amount*100)/$available_house->initial_cost,2, '.', '');
                        @endphp
                        @if($house_price_in_percent>=70)
                          <span class='label label-success'><i class='fa fa-check'></i> Eligible</span>
                        @else
                          <span class='label label-danger'><i class='fa fa-times'></i> Not Eligible</span>
                        @endif
                      </td>
                      <td>
                        @if($house_price_in_percent < 50)
                          <span class='label label-danger'>{{ $house_price_in_percent }}%</span>
                        @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                          <span class='label label-info'>{{ $house_price_in_percent }}%</span>
                        @elseif($house_price_in_percent >=70)
                          <span class='label label-success'>{{ $house_price_in_percent }}%</span>
                        @endif
                      </td>
                      <td>
                        @if($house_price_in_percent < 50)
                          <span class='label label-danger'>{{ number_format($paid_amount) }}</span>
                        @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                          <span class='label label-info'>{{ number_format($paid_amount) }}</span>
                        @elseif($house_price_in_percent >=70)
                          <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                        @endif
                      </td>
                    </tr>
                  @endif
                @elseif(!empty($service))
                  @php 
                    $joining_date = new DateTime($member->d_o_sos);
                  @endphp
                  @if(now()->diff($joining_date)->y >= 23)
                    <tr>
                      <td>
                        @if($member->payment_status==0)
                          <span style='color:green'><i class='fa fa-check'></i></span>
                        @else
                          <span style='color:red'><i class='fa fa-spinner'></i></span>
                        @endif
                      </td>
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
                          $house_price_in_percent = number_format(floor($paid_amount*100)/$available_house->initial_cost,2, '.', '');
                        @endphp
                        @if($house_price_in_percent>=70)
                          <span class='label label-success'><i class='fa fa-check'></i> Eligible</span>
                        @else
                          <span class='label label-danger'><i class='fa fa-times'></i> Not Eligible</span>
                        @endif
                      </td>
                      <td>
                        @if($house_price_in_percent < 50)
                          <span class='label label-danger'>{{ $house_price_in_percent }}%</span>
                        @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                          <span class='label label-info'>{{ $house_price_in_percent }}%</span>
                        @elseif($house_price_in_percent >=70)
                          <span class='label label-success'>{{ $house_price_in_percent }}%</span>
                        @endif
                      </td>
                      <td>
                        @if($house_price_in_percent < 50)
                          <span class='label label-danger'>{{ number_format($paid_amount) }}</span>
                        @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                          <span class='label label-info'>{{ number_format($paid_amount) }}</span>
                        @elseif($house_price_in_percent >=70)
                          <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                        @endif
                      </td>
                    </tr>
                  @endif
                @elseif(!empty($status))
                  @if($member->hasMemberStatus->is_active==$status)
                    <tr>
                      <td>
                        @if($member->payment_status==0)
                          <span style='color:green'><i class='fa fa-check'></i></span>
                        @else
                          <span style='color:red'><i class='fa fa-spinner'></i></span>
                        @endif
                      </td>
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
                          $house_price_in_percent = number_format(floor($paid_amount*100)/$available_house->initial_cost,2, '.', '');
                        @endphp
                        @if($house_price_in_percent>=70)
                          <span class='label label-success'><i class='fa fa-check'></i> Eligible</span>
                        @else
                          <span class='label label-danger'><i class='fa fa-times'></i> Not Eligible</span>
                        @endif
                      </td>
                      <td>
                        @if($house_price_in_percent < 50)
                          <span class='label label-danger'>{{ $house_price_in_percent }}%</span>
                        @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                          <span class='label label-info'>{{ $house_price_in_percent }}%</span>
                        @elseif($house_price_in_percent >=70)
                          <span class='label label-success'>{{ $house_price_in_percent }}%</span>
                        @endif
                      </td>
                      <td>
                        @if($house_price_in_percent < 50)
                          <span class='label label-danger'>{{ number_format($paid_amount) }}</span>
                        @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                          <span class='label label-info'>{{ number_format($paid_amount) }}</span>
                        @elseif($house_price_in_percent >=70)
                          <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                        @endif
                      </td>
                    </tr>
                  @endif
                @else
                  <tr>
                    <td>
                      @if($member->payment_status==0)
                        <span style='color:green'><i class='fa fa-check'></i></span>
                      @else
                        <span style='color:red'><i class='fa fa-spinner'></i></span>
                      @endif
                    </td>
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
                        $house_price_in_percent = number_format(floor($paid_amount*100)/$available_house->initial_cost,2, '.', '');
                      @endphp
                      @if($house_price_in_percent>=70)
                        <span class='label label-success'><i class='fa fa-check'></i> Eligible</span>
                      @else
                        <span class='label label-danger'><i class='fa fa-times'></i> Not Eligible</span>
                      @endif
                    </td>
                    <td>
                      @if($house_price_in_percent < 50)
                        <span class='label label-danger'>{{ $house_price_in_percent }}%</span>
                      @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                        <span class='label label-info'>{{ $house_price_in_percent }}%</span>
                      @elseif($house_price_in_percent >=70)
                        <span class='label label-success'>{{ $house_price_in_percent }}%</span>
                      @endif
                    </td>
                    <td>
                      @if($house_price_in_percent < 50)
                        <span class='label label-danger'>{{ number_format($paid_amount) }}</span>
                      @elseif($house_price_in_percent > 50 && $house_price_in_percent < 60)
                        <span class='label label-info'>{{ number_format($paid_amount) }}</span>
                      @elseif($house_price_in_percent >=70)
                        <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                      @endif
                    </td>
                  </tr>
                @endif
              @endif
            @endforeach
            <span>{{ $members->links() }}</span>
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