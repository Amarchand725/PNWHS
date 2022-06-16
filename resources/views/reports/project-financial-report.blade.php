@extends('admin.master')
@section('content')
  @include('flash_msgs')
  @include('reports.search-project-financial')
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
      <h4 class="panel-title">Project Financial Report</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table id="myTable" class="display" cellspacing="0" width="100%">
          <thead>
            <th><b>Status</b></th>
            <th><b>P | P.J.No</b></th>
            <th><b>Rank & Name</b></th>
            <th><b>Alloted</b></th>
            <th><b>Account of</b></th>
            <th><b>H Price</b></th>
            <th><b>Submitted</b></th>
            <th><b>Remaining</b></th>
            <th><b>House No#</b></th>
          </thead> 
          <tbody>
            @foreach($members as $member)
              @if(!empty($member->hasAllotedHouse))
                @if(isset($allocated_account_of) AND $member->hasAllotedHouse->allocated_account_of == $allocated_account_of)
                  <tr>
                    <td>
                      @if($member->hasMemberStatus->payment_status==0)
                        <span style='color:green'><i class='fa fa-check'></i></span>
                      @else
                        <span style='color:red'><i class='fa fa-spinner'></i></span>
                      @endif
                    </td>
                    <td>{{ $member->p_no??'--' }}</td>
                    <td>{{ $member->hasRank->name??'--' }}  {{ ucfirst($member->name)??'--' }}</td>
                    <td>
                      <span class='label label-success'>{{ date('d,F-Y', strtotime($member->hasAllotedHouse->created_at)) }}</span>
                    </td>
                    <td>
                      <span class='label label-success'>{{ $member->hasAllotedHouse->allocated_account_of }}</span>
                    </td>
                    <td>
                      @php 
                        $plot_price = $member->hasAllotedHouse->hasHouse->amount??'0'; 
                        $house_price = $member->hasAllotedHouse->hasHouse->hasConstruction->initial_price??'0';
                        $house_price = $house_price+$plot_price;
                        $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                      @endphp
                      @if($member->hasAllotedHouse->allocated_account_of=='Shaheed' || $member->hasAllotedHouse->allocated_account_of=='Medical')
                        {{ '0' }}
                      @else
                        <span class='label label-info'>{{ number_format($house_price) }}</span>
                      @endif
                    </td>
                    <td>
                      <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                    </td>
                    <td>
                      @if($member->hasAllotedHouse->allocated_account_of=='Shaheed' || $member->hasAllotedHouse->allocated_account_of=='Medical')
                        {{ '0' }}
                      @else
                        <span class='label label-danger'>{{ number_format($house_price-$paid_amount) }}</span>
                      @endif
                    </td>
                    <td>{{ $member->hasAllotedHouse->hasHouse->hasConstruction->id??'--' }}</td>
                  </tr>
                @elseif(isset($house_no) AND !empty($member->hasAllotedHouse->allocated_house) AND $member->hasAllotedHouse->allocated_house == $house_no)
                  <tr>
                    <td>
                      @if($member->hasMemberStatus->payment_status==0)
                        <span style='color:green'><i class='fa fa-check'></i></span>
                      @else
                        <span style='color:red'><i class='fa fa-spinner'></i></span>
                      @endif
                    </td>
                    <td>{{ $member->p_no??'--' }}</td>
                    <td>{{ $member->hasRank->name??'--' }}  {{ ucfirst($member->name)??'--' }}</td>
                    <td>
                      <span class='label label-success'>{{ date('d,F-Y', strtotime($member->hasAllotedHouse->created_at)) }}</span>
                    </td>
                    <td>
                      <span class='label label-success'>{{ $member->hasAllotedHouse->allocated_account_of }}</span>
                    </td>
                    <td>
                      @php 
                        $plot_price = $member->hasAllotedHouse->hasHouse->amount??'0'; 
                        $house_price = $member->hasAllotedHouse->hasHouse->hasConstruction->initial_price??'0';
                        $house_price = $house_price+$plot_price;
                        $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                      @endphp
                      @if($member->hasAllotedHouse->allocated_account_of=='Shaheed' || $member->hasAllotedHouse->allocated_account_of=='Medical')
                        {{ '0' }}
                      @else
                        <span class='label label-info'>{{ number_format($house_price) }}</span>
                      @endif
                    </td>
                    <td>
                      <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                    </td>
                    <td>
                      @if($member->hasAllotedHouse->allocated_account_of=='Shaheed' || $member->hasAllotedHouse->allocated_account_of=='Medical')
                        {{ '0' }}
                      @else
                        <span class='label label-danger'>{{ number_format($house_price-$paid_amount) }}</span>
                      @endif
                    </td>
                    <td>{{ $member->hasAllotedHouse->hasHouse->hasConstruction->id??'--' }}</td>
                  </tr>
                @else
                  <tr>
                    <td>
                      @if($member->hasMemberStatus->payment_status==0)
                        <span style='color:green'><i class='fa fa-check'></i></span>
                      @else
                        <span style='color:red'><i class='fa fa-spinner'></i></span>
                      @endif
                    </td>
                    <td>{{ $member->p_no??'--' }}</td>
                    <td>{{ $member->hasRank->name??'--' }}  {{ ucfirst($member->name)??'--' }}</td>
                    <td>
                      <span class='label label-success'>{{ date('d,F-Y', strtotime($member->hasAllotedHouse->created_at)) }}</span>
                    </td>
                    <td>
                      <span class='label label-success'>{{ $member->hasAllotedHouse->allocated_account_of }}</span>
                    </td>
                    <td>
                      @php 
                        $plot_price = $member->hasAllotedHouse->hasHouse->amount??'0'; 
                        $house_price = $member->hasAllotedHouse->hasHouse->hasConstruction->initial_price??'0';
                        $house_price = $house_price+$plot_price;
                        $paid_amount = $member->hasPayment->sum('sub_monthly_install');
                      @endphp
                      @if($member->hasAllotedHouse->allocated_account_of=='Shaheed' || $member->hasAllotedHouse->allocated_account_of=='Medical')
                        {{ '0' }}
                      @else
                        <span class='label label-info'>{{ number_format($house_price) }}</span>
                      @endif
                    </td>
                    <td>
                      <span class='label label-success'>{{ number_format($paid_amount) }}</span>
                    </td>
                    <td>
                      @if($member->hasAllotedHouse->allocated_account_of=='Shaheed' || $member->hasAllotedHouse->allocated_account_of=='Medical')
                        {{ '0' }}
                      @else
                        <span class='label label-danger'>{{ number_format($house_price-$paid_amount) }}</span>
                      @endif
                    </td>
                    <td>{{ $member->hasAllotedHouse->hasHouse->hasConstruction->id??'--' }}</td>
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