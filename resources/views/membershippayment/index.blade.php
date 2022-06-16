@extends('admin.master')
@section('content')

  include('membershippayment._search')
  <br>
  <div class="panel panel-dark">
    <div class="panel-heading">
      @if(Auth::user()->user_type != 3)
        <a href="{{ route('Membershippayment.create') }}" class="btn btn-default c" style="float: right;margin-right: 1%;margin-top: -8px;">Registration fees</a>
      @endif
      <h4 class="panel-title">Registration Fees</h4>
    </div>
    <div class="panel-body">
      <div class="row">
        <table class="table table-bordered">
          <thead>
            <th><b>#</b></th>
            <th><b>Name</b></th>
            <th><b>Rank</b></th>
            <th><b>Effective Date</b></th>
          </thead>
          @if(!empty($models))
          <tbody class='ajax_content'>
            <?php $counter = 1; ?>
            @foreach($models as $model)
              <tr>
                <?php
                  $created_by = DB::table('users')->where('id', $model->created_by)->first();
                ?>
                <td>{{$counter++}}</td>
                <td>{{$model->mpayment??'--'}}</td>
                <td>{{$model->m_rank??'--'}}</td>
                <td>{{$model->effective_date??'--'}}</td>
              </tr>
            @endforeach
          </tbody>
          @endif
        </table>
      </div>
    </div>
  </div>
@endsection
