@extends('admin.master')
@section('content')
    <style>
        th{
            text-align:left
        }
    </style>
    <div class="panel panel-dark">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="minimize">−</a>
            </div>
            <h4 class="panel-title">Member Form
                <span style='text-algin:right'>
                    <a href="{{ url('/download_form') }}/{{ $model->id }}" title='Down Load Form' class='btn btn-success'><i class='fa fa-download'></i></a>
                </span>
            </h4>
        </div>

        <div class="panel-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-3">
                        <legend>Applicant Photograph:
                            @if(!empty($model->hasAllotteeFiles->applicant_photograph))
                                <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->applicant_photograph }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                            @endif
                        </legend>
                        @if(!empty($model->hasAllotteeFiles->applicant_photograph))
                            @if(explode('.', $model->hasAllotteeFiles->applicant_photograph)[1]=='pdf')
                                <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph) }}" type="application/pdf" style='height:250px; width:400px' />
                            @else
                                <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph) }}" style='height:250px; width:400px' class="img-responsive thumbnail"/>
                            @endif
                        @else
                            <img src="{{ url('public/images/no-image.jpg') }}" style='height:250px; width:400px' class="img-responsive thumbnail"/>
                        @endif
                    </div>
                    <div class="col-sm-9">
                        <fieldset>
                            <legend>Basic Information:</legend>
                            <table class="table table-bordered">
                                @if(!empty($model->hasPromotedMember) && Auth::user()->hasRole->role=='Admin')
                                    <tr>
                                        <th>New Registration /File Number</th>
                                        <td>
                                            {{ $model->hasPromotedMember->file_registration_no??'--' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Old Registration /File Number</th>
                                        <td>
                                            {{ $model->reg_file_no??'--' }}
                                        </td>
                                    </tr>
                                
                                    <tr>
                                        <th>New P/PJ/O No:</th>
                                        <td>
                                            {{ $model->hasPromotedMember->new_p_no??'--' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Old P/PJ/O No:</th>
                                        <td>
                                            {{ $model->p_no??'--' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Promoted Rank/Rate:</th>
                                        <td>
                                            {{ $model->hasPromotedMember->hasPromotedRank->name??'--' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Old Rank/Rate:</th>
                                        <td>
                                            {{ $model->hasRank->name??'--' }} 
                                        </td>
                                    </tr>
                                     <tr>
                                @else
                                    <tr>
                                        <th>Registration /File Number</th>
                                        <td>
                                            @if(!empty($model->hasPromotedMember))
                                                {{ $model->hasPromotedMember->file_registration_no??'--' }}
                                            @else
                                                {{ $model->reg_file_no??'--' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>P/PJ/O No:</th>
                                        <td>
                                        @if(!empty($model->hasPromotedMember))
                                            {{ $model->hasPromotedMember->new_p_no }}
                                        @else
                                            {{ $model->p_no??'--' }}
                                        @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rank/Rate:</th>
                                        <td>
                                            @if(!empty($model->hasPromotedMember))
                                                {{ $model->hasPromotedMember->hasPromotedRank->name }}
                                            @else
                                                {{ $model->hasRank->name??'--' }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Branch:</th>
                                    <td> {{ $model->branch??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>
                                        @if(!empty($model->hasPromotedMember))
                                            {{ $model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'--' }}
                                        @else
                                            {{ $model->hasRank->hasHouseCategory->name??'--' }} 
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Person:</th>
                                    <td>
                                        @if(!empty($model->hasPromotedMember))
                                            {{ ucfirst($model->hasPromotedMember->soldier)??'--' }}
                                        @else
                                            {{ ucfirst($model->soldier??'--') }} 
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name:</th>
                                    <td><span>{{ ucfirst($model->name)??'--' }}</span></td>
                                </tr>
                                <tr>
                                    <th>CNIC No:</th>
                                    <td> {{ $model->cnic_no??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Date of Birth:</th>
                                    <td> {{ date('d, F Y', strtotime($model->d_o_b))??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Total Service:</th>
                                    <td> 
                                        @if(!empty($model->hasPromotedMember))
                                            {{ ucfirst($model->hasPromotedMember->total_service)??'--' }}
                                        @else
                                            {{ $model->total_service??'--' }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend>Job Information:</legend>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Membership Date:</th>
                                    <td> {{ date('d, F Y', strtotime($model->membership_date))??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Date of Enrolment:</th>
                                    <td>  {{ date('d, F Y', strtotime($model->d_o_e))??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Probationary Complete Date:</th>
                                    <td> {{ date('d, F Y', strtotime($model->d_o_c))??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Date of Promotion to Present Rank:</th>
                                    <td> 
                                        @if(!empty($model->hasPromotedMember))
                                            {{ date('d, F Y', strtotime($model->hasPromotedMember->d_o_p))??'--' }}
                                        @else
                                            {{ date('d, F Y', strtotime($model->d_o_p))??'--' }}
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date of SOD:</th>
                                    <td>
                                        @if(!empty($model->hasPromotedMember))
                                            {{ date('d, F Y', strtotime($model->hasPromotedMember->d_o_sod))??'--' }}  
                                        @else
                                            {{ date('d, F Y', strtotime($model->d_o_sod))??'--' }}  
                                        @endif
                                    </td>
                                </tr>
                                @if(!empty($model->hasPromotedMember)) 
                                    @if($model->hasPromotedMember->soldier=='uniform')
                                        <tr>
                                            <th>Date of SOS(<small>Uniform</small>):</th>
                                            <td>  {{ date('d, F Y', strtotime($model->hasPromotedMember->d_o_sos))??'--' }} </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Date of Superannuation age(<small>Civilian</small>):</th>
                                            <td> {{ date('d, F Y', strtotime($model->hasPromotedMember->d_o_s))??'--' }} </td>
                                        </tr>
                                    @endif
                                @else 
                                    @if($model->soldier=='uniform')
                                        <tr>
                                            <th>Date of SOS(<small>Uniform</small>):</th>
                                            <td>  {{ date('d, F Y', strtotime($model->d_o_sos))??'--' }} </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>Date of Superannuation age(<small>Civilian</small>):</th>
                                            <td> {{ date('d, F Y', strtotime($model->d_o_s))??'--' }} </td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <th>Unit:</th>
                                    <td> {{ $model->unit??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Other benefit: <small>(From Govt. of Pakistan e,g house, flat, plot etc)</small></th>
                                    <td> {{ $model->any_other_benifit??'--' }} </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend>Contact Information:</legend>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Mobile No:</th>
                                    <td> {{ $model->mob_no??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Telephone No:</th>
                                    <td> {{ $model->tel_no??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Email Address:</th>
                                    <td> {{ $model->email_address??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Present Address:</th>
                                    <td> {{ $model->present_address??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Permanent Address:</th>
                                    <td> {{ $model->permanent_address??'--' }} </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <fieldset>
                        <legend>Details of next of Kin/Parents:</legend>
                        <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Share %</th>
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
                                    <td>{{ $value->share??'--' }}%</td>
                                    <td>{{ $value->name??'--' }}</td>
                                    <td>{{ $value->relation??'--' }}</td>
                                    <td>{{ $value->cnic_no??'--' }}</td>
                                    <td>{{ $value->mobile_no??'--' }}</td>
                                    <td>{{ $value->address??'--' }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </fieldset>
                </div>

                <div class="row">
                    <fieldset>
                        <legend>Uploaded Documents:</legend>
                        <div class="col-md-4">
                            <legend>CNIC Front:
                                @if(!empty($model->hasAllotteeFiles->cnicfront))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->cnicfront }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->cnicfront))
                                @if(explode('.', $model->hasAllotteeFiles->cnicfront)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicfront) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicfront) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <legend>CNIC Back:
                                @if(!empty($model->hasAllotteeFiles->cnicback))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->cnicback }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->cnicback))
                                @if(explode('.', $model->hasAllotteeFiles->cnicback)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicback) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->cnicback) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <legend>Children B form:
                                @if(!empty($model->hasAllotteeFiles->childrenbform))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->childrenbform }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->childrenbform))
                                @if(explode('.', $model->hasAllotteeFiles->cnicfront)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->childrenbform) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->childrenbform) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>
                    </fieldset>
                </div>
                <br /><br />
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <legend>Allotment Form:
                                @if(!empty($model->hasAllotteeFiles->fpaform))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->fpaform }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->fpaform))
                                @if(explode('.', $model->hasAllotteeFiles->fpaform)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->fpaform) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->fpaform) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <legend>FRP-36 & FC(W)-10 form:
                                @if(!empty($model->hasAllotteeFiles->frp_fc))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->frp_fc }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->frp_fc))
                                @if(explode('.', $model->hasAllotteeFiles->frp_fc)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->frp_fc) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->frp_fc) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <legend>Demand Draft/ Banker cheque:
                                @if(!empty($model->hasAllotteeFiles->draft_cheque))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->draft_cheque }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->draft_cheque))
                                @if(explode('.', $model->hasAllotteeFiles->draft_cheque)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->draft_cheque) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->draft_cheque) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>
                    </div>
                </div>
                <br /><br />
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <legend>Promotion Letter:
                                @if(!empty($model->hasAllotteeFiles->promotion_letter))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->promotion_letter }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->promotion_letter))
                                @if(explode('.', $model->hasAllotteeFiles->promotion_letter)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->promotion_letter) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->promotion_letter) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <legend>Any other document:
                                @if(!empty($model->hasAllotteeFiles->any_other_docs))
                                    <a title='Download This Image' href="{{ url('download_image') }}/{{ $model->hasAllotteeFiles->any_other_docs }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a>
                                @endif
                            </legend>
                            @if(!empty($model->hasAllotteeFiles->any_other_docs))
                                @if(explode('.', $model->hasAllotteeFiles->any_other_docs)[1]=='pdf')
                                    <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->any_other_docs) }}" type="application/pdf" style='height:300px; width:600px' />
                                @else
                                    <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->any_other_docs) }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            @else
                                <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if(count($model->hasAllotteeKinsMultipleFiles)>0)
                        <legend>Next of Kins file:</legend>
                        @foreach($model->hasAllotteeKinsMultipleFiles as $key => $kinsfile)
                            <div class="col-md-6">
                                @if(!empty($kinsfile))
                                    <div style='float:left'><a title='Download This Image' href="{{ url('download_kins_doc') }}/{{ $kinsfile->filetext }}" class='btn btn-success btn-sm'><i class='fa fa-download'></i></a></div>
                                    @if(explode('.', $kinsfile->filetext[1]=='pdf'))
                                        <embed src="{{ url('public/kinsfiles/'.$kinsfile->filetext) }}" type="application/pdf" style='height:320px; width:600px' />
                                    @else
                                        <img src="{{ url('public/kinsfiles/'.$kinsfile->filetext) }}" style='height:320px; width:600px' class="img-responsive thumbnail"/>
                                    @endif
                                @else
                                    <img src="{{ url('public/images/no-image.jpg') }}" style='height:300px; width:600px' class="img-responsive thumbnail"/>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
                
                @if($model->form_status==1)
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ url('update_form_status') }}" method='post'>
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" name='p_no' value='{{ $model->p_no }}'>
                                    <button type='submit' name='submit' value='submit' class='btn btn-success'><i class='fa fa-save'></i> Save</button>
                                    <button type='submit' name='submit' value='canceled' class='btn btn-danger'><i class='fa fa-times'></i> Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div> 
@endsection