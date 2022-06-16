@extends('admin.master')
@section('content')
  @include('flash_msgs')
  @include('reports.search-eligibility')
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
      <h4 class="panel-title">Eligibility Report</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table id="myTable" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th><b>Status</b></th>
              <th><b>P/P.J.No</b></th>
              <th><b>Name & Grade</b></th>
              <th><b>Member Status</b></th>
              <th><b>Eligibility</b></th>
              <th><b>Paid Percent %</b></th>
              <th><b>Amount(PKR)</b></th>
            </tr>
          </thead> 
          <tbody>
            @foreach($members as $member)
              @php 
                if(!empty($member->hasPayment)){
                  $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                  $paid_amount_in_percent = number_format(floor($paid_amount*100)/$available_house->initial_cost,2, '.', '');
                }else{
                  $paid_amount = 0;
                  $paid_amount_in_percent = 0;
                }
                $membership_date = new DateTime($member->membership_date);
                $joining_date = new DateTime($member->d_o_e);
              @endphp
              @if($paid_amount_in_percent >= 70 && now()->diff($membership_date)->y >= 3 && now()->diff($joining_date)->y >= 23)
                <tr>
                  <td>
                    @if($member->payment_status==0)
                      <span style='color:green'><i class='fa fa-check'></i></span>
                    @else
                      <span style='color:red'><i class='fa fa-spinner'></i></span>
                    @endif
                  </td>
                  <td>
                    @if(!empty($member->hasPromotedMember))
                      {{ $member->hasPromotedMember->new_p_no }}
                    @else
                      {{ $member->p_no }}
                    @endif
                  </td>
                  <td>
                    {{ ucfirst($member->name) }} | 
                    @if(!empty($member->hasPromotedMember))
                      {{ $member->hasPromotedMember->hasPromotedRank->name }}
                    @else
                      {{ $member->hasRank->name }}
                    @endif
                  </td>
                  <td>
                    @if($member->hasMemberStatus->is_active==1)
                      <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                    @else
                      <span class='label label-danger'><i class='fa fa-times'></i> Inactive</span>
                    @endif
                  </td>
                  <td>
                    @php 
                      if(!empty($member->hasPayment)){
                        $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                        $paid_amount_in_percent = number_format(floor($paid_amount*100)/$available_house->initial_cost,2, '.', '');
                      }else{
                        $paid_amount = 0;
                        $paid_amount_in_percent = 0;
                      }
                    @endphp
                    @if($paid_amount_in_percent>=70)
                      <span class='label label-success'><i class='fa fa-check'></i> Eligible</span>
                    @else
                      <span class='label label-danger'><i class='fa fa-times'></i> Not Eligible</span>
                    @endif
                  </td>
                  <td>
                    @if($paid_amount_in_percent < 50)
                      <span class='label label-danger'>{{ $paid_amount_in_percent }}%</span>
                    @elseif($paid_amount_in_percent > 50 && $paid_amount_in_percent < 60)
                      <span class='label label-info'>{{ $paid_amount_in_percent }}%</span>
                    @elseif($paid_amount_in_percent >=70)
                      <span class='label label-success'>{{ $paid_amount_in_percent }}%</span>
                    @endif
                  </td>
                  <td>
                    @if($paid_amount_in_percent < 50)
                      <span class='label label-danger'>{{ number_format($paid_amount) }}</span>
                    @elseif($paid_amount_in_percent > 50 && $paid_amount_in_percent < 60)
                      <span class='label label-info'>{{ number_format($paid_amount) }}</span>
                    @elseif($paid_amount_in_percent >=70)
                      <span class='label label-success'>{{ number_format($paid_amount) }}</span>
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
  
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable();
    });
  </script>
@endsection