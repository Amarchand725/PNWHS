@extends('admin.master')
@section('content')
  @include('flash_msgs')
  @include('allotteeDetailsOfKin._search')
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
  <!-- <marquee style='text-align:center'><span style='font-size:20px: color:#428bca;'> Eligibility Criteria:</span> <span> 1. Service should be at least 23 years. 2. Membership period at least 3 years. 3. Cost of house to be paid 70%. </span></span></marquee> -->
  <div class="panel panel-dark">
    <div class="panel-heading">
      <h4 class="panel-title">Allotment</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table class="table table-bordered">
          <thead >
            <th><b>#</b></th>
            <th><b>P/PJ/O No</b></th>
            <th><b>Name | Rank</b></th>
            <th><b>Category</b></th>
            <th><b>Service</b></th>
            <th><b>Member From</b></th>
            <th><b>Membership Period</b></th>
            <th><b>Total Paid Amount (PKR)</b></th>
            <th><b>Membership Status</b></th>
            <th><b>House Status</b></th>
            <th><b>Action</b></th>
          </thead>
          <tbody class='ajax_content'>
            @php $counter = 0; @endphp
            @foreach($members as $member)
              @php ++$counter; @endphp
              <tr>
                <td>{{ $counter }}.</td>
                <td>
                  @if(!empty($member->hasPromotedMember))
                    {{ $member->hasPromotedMember->new_p_no }}
                  @else
                    {{ $member->p_no }}
                  @endif
                </td>
                <td>
                  {{ ucfirst($member->hasUser->name??'--') }} | 
                  @if(!empty($member->hasPromotedMember))
                    {{ $member->hasPromotedMember->hasPromotedRank->name??'--' }}
                  @else
                    {{ $member->hasRank->name??'--' }}
                  @endif
                </td>
                <td>
                  @if(!empty($model->hasPromotedMember))
                    {{ $model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'--' }}
                  @else
                    {{ $model->hasRank->hasHouseCategory->name??'--' }} 
                  @endif 
                </td>
                <td>
                  @php 
                    $joining_date = new DateTime($member->d_o_c);
                  @endphp
                  @if(now()->diff($joining_date)->y >= 23)
                    <span class='badge badge-success'>{{ now()->diff($joining_date)->y }}</span> - Year(s)
                  @else
                    <span class='badge badge-danger'>{{ now()->diff($joining_date)->y }}</span> - Year(s)
                  @endif
                </td>
                <td>
                  {{ date('F-Y', strtotime($member->membership_date)) }}
                </td>
                <td>
                  @php 
                    $membership_date = new DateTime($member->membership_date);
                  @endphp
                  @if(now()->diff($membership_date)->y >= 3)
                    <span class='badge badge-success'>{{ now()->diff($membership_date)->y }}</span> - Year(s)
                  @else
                    <span class='badge badge-danger'>{{ now()->diff($membership_date)->y }}</span> - Year(s)
                  @endif
                </td>
                <td>
                  <span class='label label-info'>
                    @if(!empty($member->hasPayment))
                      {{ $amount_converter->gettypenumber($member->hasPayment->amount) }}
                    @else
                      {{ "0" }}
                    @endif
                  </span>,
                  @php
                    if(!empty($member->hasPayment)){
                      $paid_amount = $member->hasPayment->amount;
                      $house_price_in_percent = number_format(floor($paid_amount*100)/$available_house->initial_cost,2, '.', '');
                    }else{
                      $paid_amount = 0;
                      $house_price_in_percent = 0;
                    }
                  @endphp
                  @if($house_price_in_percent >= 70)
                    <span class='label label-success'>{{ $house_price_in_percent }}%</span>
                  @else
                    <span class='label label-danger'>{{ $house_price_in_percent }}%</span>
                  @endif
                </td>
                <td>
                  @if(!empty($member->hasMemberStatus) && $member->hasMemberStatus->is_active==1)
                    <span class='label label-success'><i class='fa fa-check'></i> Active</span>
                  @else
                    <span class='label label-danger'><i class='fa fa-times'></i> In Active</span>
                  @endif
                </td>
                <td>
                  @if(now()->diff($joining_date)->y >= 23 && now()->diff($membership_date)->y >= 3 && $house_price_in_percent >= 70)
                    <span class='label label-success'><i class='fa fa-check'></i> Eligible</span>
                  @else
                    <span class='label label-danger'><i class='fa fa-times'></i> Not Eligible</span>
                  @endif
                </td>
                <td>
                  <a href="{{ url('Ledger', $member->p_no) }}" data-toggle="tooltip"  title="Paid Amount Details" class="btn btn-info btn-sm"><i class="fa fa-money"></i></a>
                  <a href="{{ url('allocate_house', $member->p_no) }}" data-toggle="tooltip"  title="Alocate House" class="btn btn-primary btn-sm"><i class="fa fa-home"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="rwy" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Files</h4>
        </div>
        <div class="modal-body">
          {!! Form::open([
            'route' => 'updatefile',
            'files' => true
          ]) !!}

          <input type="hidden" value='' name='rowid' id='rowid' />
          <div class='row'>
          <div class="col-md-12 col-sm-12">
          <div class="form-group">
            {!! Form::label("features", "Upload Files:", ["class" => "control-label"]) !!}
            <input type="file" name="image[]" class="form-control" multiple="multiple">
          </div>
        </div>
        <div class='clearfix'></div>
        <div class="col-md-12 col-sm-12" style='margin-top: 10px;'>
          <div class="form-group">
          <button type="submit" class="btn btn-success"> Submit </button> 
          </div>
        </div>
        </div>
        <div class='clearfix'></div>
          {!! Form::close() !!}
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).on('click', '.house-details', function(){
      $('#exampleModal').modal('show');
    });
  </script>
@endsection