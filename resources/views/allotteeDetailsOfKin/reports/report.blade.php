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
      <h4 class="panel-title">Allotment</h4>                   
    </div>
    <div class="panel-body">
      <div class="row">
        <table class="table table-bordered">
          <thead >
            <th><b>#</b></th>
            <th><b>P/PJ/O No</b></th>
            <th><b>Name/Rank Rate</b></th>
            <th><b>Action</b></th>
          </thead>
          <tbody class='ajax_content'>
            
            <tr>
              <td colspan="7">
              </td>
            </tr>
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
@endsection