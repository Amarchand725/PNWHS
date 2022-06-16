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
  <div class="panel panel-dark">
    <div class="panel-heading">
      @if(in_array("Application_insert", $userrightsjson))
        <a href="{{ url('/AllotteeParticular/create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Create Member</a>
      @endif
      <h4 class="panel-title">Manage Application</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table class="table table-bordered">
          <thead >
            <th><b>#</b></th>
            <th><b>P/PJ/O No</b></th>
            <th><b>Member Name</b></th>
            <th><b>Rank</b></th>
            <th><b>Status</b></th>
            <th><b>Action</b></th>
          </thead>
          <tbody class='ajax_content'>
            @php $counter = 1; @endphp
            @foreach($models as $model)
              <tr>
                <td>{{ $counter++ }}.</td>
                <td>{{ $model->p_no }}</td>
                <td>{{ $model->name }}</td>
                <td>{{ $model->hasRank->name }}</td>
                  @if(!empty($model->approvedocument))
                    <td>
                      <a href="{{ url('/AllotteeParticular/viewfiles', $model->p_no) }}"  class="btn btn-success">View Files</a>
                    </td>
                  @else
                    <td >
                      <a href="#" data-id="{{ $model->p_no }}" class="sad btn btn-success" id="file{{ $model->p_no }}" data-toggle="modal"  data-target="#rwy">Active (Upload file)</a>
                    </td>
                  @endif
                <td>
                  @if($permissionview == 'true')
                    <a href="{{ route('AllotteeDetailsOfKin.show', $model->p_no) }}" data-toggle="tooltip"  title="Show Application" class="btn btn-primary"> <span class="glyphicon glyphicon-eye-open"></span></a>
                  @endif
                  @if($permissionupdate == 'true')
                    <a href="{{ route('AllotteeDetailsOfKin.edit', $model->p_no) }}" data-toggle="tooltip"  title="Edit Application" class="btn btn-secondary background badge-info"> <span class="glyphicon glyphicon-pencil" style='color:white'></span></a>
                  @endif
                  @if($permissiondelete == 'true')
                    <a href="{!! url('AllotteeDetailsOfKin/destroy', $model->p_no) !!}"  onclick='return confirm("Are you sure?");' data-toggle="tooltip" class="btn btn-danger background badge-danger"> <span class="glyphicon glyphicon-trash" style='color:white'></span></a>
                  @endif
                </td>
              </tr>
            @endforeach
            <tr>
              <td colspan="7">
                {{ $models->links() }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="rwy" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Files</h4>
        </div>
        <div class="modal-body">
          {!! Form::open([
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

  <!-- //script -->
  <!-- <script>
    $(document).ready(function(e){
      // $('#submit').click(function(){
      //   if( document.getElementById("image").files.length == 0 ){
      //     alert('Please Select File');
      //     return false;
      //   }
      // });
    });

    $(document).ready(function(){
      // $('#file $model->application_id ?>').click(function(){
      //   var memberid = $(this).attr("data-id");
      //   $('#rowid').val(memberid);
      // })
    });
  </script> -->
@endsection