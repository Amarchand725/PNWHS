@extends('admin.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style='background-color: #428bca; color: #fff; border-color: #357ebd;'>CSV File Filtered Data</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('process_file') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="csv_raw_file_id" value="{{ $csv_raw_file_id }}" /> 
                            <table class="table">
                                <tr>
                                    <th style='font-size:18px; color: #5bc0de;'><i class='fa fa-check' style='color:green'></i> Registered Member(s)</th>
                                    <td>{{ count(array_unique($total_registered_members)) }}</td>
                                    <td>
                                        <button type='submit' class='btn btn-info btn-sm' title='Display All Registered Members' name='submit' value='registered-list'><i class='fa fa-eye'></i></button>
                                        <button type='submit' class='btn btn-success btn-sm' name='submit' value='registered-save' title='Save Records'><i class='fa fa-save'></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <th style='font-size:18px; color: #5bc0de;'><i class='fa fa-times' style='color:red'></i> Unregistered Member(s)</th>
                                    <td>{{ count(array_unique($total_unregistered_members)) }}</td>
                                    <td>
                                        <button type='submit' class='btn btn-info btn-sm' name='submit' value='unregistered-list' title='Display All Unregistered Members'><i class='fa fa-eye'></i></button>
                                        <button type='submit' class='btn btn-success btn-sm' name='submit' value='unregistered-save' title='Save Records'><i class='fa fa-save'></i></button>
                                        <!--<button type='submit' class='btn btn-primary btn-sm' name='submit' value='unregistered-save-register' title='Save & register'><i class='fa fa-save'></i></button>-->
                                    </td>
                                </tr>
                                <tr>
                                    <th style='font-size:18px; color: #5bc0de;'><i class="fa fa-angle-double-right" style='color:orange'></i> Conflected Record(s)</th>
                                        @php $conflected_records = 0; @endphp
                                        @foreach($count_conflects as $key=>$record)
                                            @if($record>1)
                                                @php $conflected_records++ @endphp
                                            @endif
                                        @endforeach
                                    <td>{{ $conflected_records }}</td>
                                    <td>
                                        <button type='submit' class='btn btn-info btn-sm' name='submit' value='conflected-list' title='Conflected Records'><i class='fa fa-eye'></i></button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection