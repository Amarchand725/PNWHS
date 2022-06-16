@extends('admin.master')
@section('content')
    @include('flash_msgs')
    <br>
    <div class="panel panel-dark">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="minimize">−</a>
            </div>
            <h4 class="panel-title">Display Member Details</h4>
        </div>

        <div class="panel-body">
            <div id="progressWizard" class="basic-wizard">
                <ul class="nav nav-pills nav-justified">
                    <li class='active'><a href="#applicant-info" data-toggle="tab"> Particular of the Applicant</a></li>
                    <li><a href="#parent-info" data-toggle="tab"> Details of Next of Kin/Parents</a></li>
                    <li><a href="#documents" data-toggle="tab"> Upload Multiple Files</a></li>
                    <li><a href="#kins" data-toggle="tab">Next of Kins Files</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="progress progress-striped active">
                    <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="tab-pane active" id="applicant-info">
                    <div class="row">
                        <h1>Particular Of The Applicant</h1>
                        <table class="table table-bordered">
                            <tr>
                                <th> Name </th>
                                <td> {{ ucfirst($model->name)??'--' }} </td>
                            </tr>
                            <tr>
                                <th> P/PJ/O No: </th>
                                <td> {{ $model->p_no??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Rank/Rate </th>
                                <td> {{ $model->hasRank->name??'--' }} </td>
                            </tr>
                            <tr>
                                <th> CNIC No </th>
                                <td> {{ $model->cnic_no??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Date of Birth </th>
                                <td> {{ date('d, F Y', strtotime($model->d_o_b))??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Date of Enrolment </th>
                                <td>  {{ date('d, F Y', strtotime($model->d_o_e))??'--' }} </td>
                            </tr>
                            <tr>
                                <th>  Date of Completion of Probationary Period </th>
                                <td> {{ date('d, F Y', strtotime($model->d_o_c))??'--' }} </td>
                            </tr>
                            <tr>
                                <th>  Date of SOD </th>
                                <td>  {{ date('d, F Y', strtotime($model->d_o_sod))??'--' }}  </td>
                            </tr>
                            <tr>
                                <th>  Date of SOS </th>
                                <td>  {{ date('d, F Y', strtotime($model->d_o_sos))??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Date of Superannuation age </th>
                                <td> {{ date('d, F Y', strtotime($model->d_o_s))??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Total Service </th>
                                <td> {{ $model->total_service??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Branch </th>
                                <td> {{ $model->branch??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Tel No </th>
                                <td> {{ $model->tel_no??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Mobile No </th>
                                <td> {{ $model->mob_no??'--' }} </td>
                            </tr>
                            <tr>
                                <th> Email Address </th>
                                <td> {{ $model->email_address??'--' }} </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="parent-info">
                    <div class="row">
                        <h1>Details Of Next Of Kin/Parents</h1>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>CNIC No</th>
                                <th>Mobile No</th>
                                <th>Address</th>
                            </tr>
                            @php $counter = 1; @endphp
                            @foreach($model->hasAllotteKinDetails as $value)
                                <tr>
                                    <td>{{ $counter++ }}.</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->relation }}</td>
                                    <td>{{ $value->cnic_no }}</td>
                                    <td>{{ $value->mobile_no }}</td>
                                    <td>{{ $value->address }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="documents">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Upload Files</h1>
                            <div class="col-md-6 col-lg-6">
                                <h2>CNIC Front</h2>
                                @if(!empty($model->hasAllotteeFiles->cnicfront))
                                    <img src="{{ url('/alloteefiles/'.$model->hasAllotteeFiles->cnicfront) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @else
                                    <img src="{{ url('/alloteefiles/noimg.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <h2>CNIC Back</h2>
                                @if(!empty($model->hasAllotteeFiles->cnicback))
                                    <img src="{{ url('/alloteefiles/'.$model->hasAllotteeFiles->cnicback) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @else
                                    <img src="{{ url('/alloteefiles/noimg.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Add New Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-lg-6">
                                <h2>Children B form</h2>
                                @if(!empty($model->hasAllotteeFiles->childrenbform))
                                    <img src="{{ url('/alloteefiles/'.$model->hasAllotteeFiles->childrenbform) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @else
                                    <img src="{{ url('/alloteefiles/noimg.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <h2>FPA form</h2>
                                @if(!empty($model->hasAllotteeFiles->fpaform))
                                    <img src="{{ url('/alloteefiles/'.$model->hasAllotteeFiles->fpaform) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @else
                                    <img src="{{ url('/alloteefiles/noimg.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Add New Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-lg-6">
                                <h2>Applicant Photograph</h2>
                                @if(!empty($model->hasAllotteeFiles->applicant_photograph))
                                    <img src="{{ url('/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @else
                                    <img src="{{ url('/alloteefiles/noimg.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="kins">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>Next Of Kins file</h1>
                            @if(count($model->hasAllotteeKinsMultipleFiles)>0)
                                @foreach($model->hasAllotteeKinsMultipleFiles as $key => $kinsfile)
                                    <div class="col-sm-6">
                                        @if(!empty($kinsfile))
                                            <img src="{{ url('/kinsfiles/'.$kinsfile->filetext) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                        @else
                                            <img src="{{ url('/alloteefiles/noimg.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="col-sm-6">
                                    <img src="{{ url('/alloteefiles/noimg.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection