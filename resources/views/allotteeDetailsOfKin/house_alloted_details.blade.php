@extends('admin.master')
@section('content')
  @include('flash_msgs')
  @include('allotteeDetailsOfKin._search')
  <br>
  @php
    $usersdata =  DB::table('userroles')->where('id',Auth::user()->role)->first();
    if(!empty($usersdata)){
      $userrightsjson =  json_decode($usersdata->rights);
    }
    else{
      $dummyarray = array();
      $userrightsjson = $dummyarray;
    } 
  @endphp

  <div class="panel panel-dark">
    <div class="panel-heading">
      <h4 class="panel-title">Manage Colony</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table class="table table-bordered">
          <thead >
            <th><b>#</b></th>
            <th><b>House No#</b></th>
            <th><b>P|PJO.No</b></th>
            <th><b>Rank & Name</b></th>
            <th><b>Alloted At</b></th>
            <th><b>Payment Status</b></th>
            <th><b>Action</b></th>
          </thead>
          <tbody class='ajax_content'>
            @php $counter = 1; @endphp
            @foreach($models as $model)
              <tr>
                <td>{{ $counter++ }}.</td>
                <td>{{ $model->allocated_house }}</td>
                <td>{{ $model->p_no }}</td>
                <td>{{ $model->hasUser->hasRank->name }} {{ ucfirst($model->hasUser->name) }}</td>
                <td>{{ date('d, F-Y', strtotime($model->created_at)) }}</td>
                <td>
                  @if($model->hasUser->hasMemberStatus->payment_status==0)
                    <span class='label label-success' title='Cleared Payment'><i class='fa fa-check'></i> Cleared Payment {{ date('d, F-Y', strtotime($model->hasUser->hasMemberStatus->created_at)) }}</span>
                  @else
                    <span class='label label-info' title='Not Cleared Payment'><i class='fa fa-spinner'></i> Continue...</span>
                  @endif
                </td>
                <td>
                  <a href="{{ url('allotee_completed_details', $model->p_no) }}" data-toggle="tooltip"  title="House Holder Details" class="btn btn-info btn-sm"> <span class="glyphicon glyphicon-pencil" style='color:white'></span></a>
                  <button class='btn btn-success btn-sm' title='Sell House'><i class='fa fa-shopping-cart'></i></button>
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
          {!! 
            Form::open([
              'route' => 'updatefile',
              'files' => true
            ]) 
          !!}

            <input type="hidden" value='' name='rowid' id='rowid' />
            <div class='row'>
              <div class="col-md-12 col-sm-12">
                <div class="form-group">
                  {!! Form::label("features", "Upload Files:", ["class" => "control-label"]) !!}
                  <input type="file" name="image[]" class="form-control" id='image' multiple="multiple">
                </div>
              </div>
              <div class='clearfix'></div>
              <div class="col-md-12 col-sm-12" style='margin-top: 10px;'>
                <div class="form-group">
                  <button type="submit" class="btn btn-success" id='submit'> Submit </button> 
                </div>
              </div>
            </div>

            <div class='clearfix'></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- <script>
    $(document).ready(function(){
      $('#file $member->application_id ?>').click(function(){
        var memberid = $(this).attr("data-id");
        $('#rowid').val(memberid);
      })
    });

    $(document).ready(function(e){
      $('#submit').click(function(){
        if( document.getElementById("image").files.length == 0 ){
          alert('Please Select File');
          return false;
        }
      });
    });
  </script> -->
@endsection