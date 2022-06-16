@extends('admin.master_without_sidebar')
@section('contentss')
    <style>
        th{
            text-align:left
        }
    </style>
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Member Form</h4>
        </div>

        <div class="panel-body">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-3" style='float:right'>
                        @if(!empty($model->hasAllotteeFiles->applicant_photograph))
                            @if(explode('.', $model->hasAllotteeFiles->applicant_photograph)[1]=='pdf')
                                <embed src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph) }}" style='height:180px; width:200px' class="img-responsive thumbnail"/>
                            @else
                                <img src="{{ url('public/alloteefiles/'.$model->hasAllotteeFiles->applicant_photograph) }}" style='height:180px; width:200px' class="img-responsive thumbnail"/>
                            @endif
                        @else
                            <img src="{{ url('public/images/no-image.jpg') }}" style='height:180px; width:200px' class="img-responsive thumbnail"/>
                        @endif
                    </div>
                    <div class="col-sm-9">
                        <fieldset>
                            <legend>Basic Information:</legend>
                            <table class="table table-bordered">
                                @if(!empty($model->hasPromotedMember->old_p_no) && Auth::user()->hasRole->role=='Admin')
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
                                        <th>Category:</th>
                                        <td>
                                            @if(!empty($model->hasPromotedMember))
                                                {{ $model->hasPromotedMember->hasPromotedRank->hasHouseCategory->name??'--' }}
                                            @else
                                                {{ $model->hasRank->hasHouseCategory->name??'--' }} 
                                            @endif 
                                        </td>
                                    </tr>
                                </tr>
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
                                @else
                                    <tr>
                                        <th>Registration /File Number</th>
                                        <td>
                                            {{ $model->reg_file_no??'--' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>P/PJ/O No:</th>
                                        <td>
                                            {{ $model->p_no??'--' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Rank/Rate:</th>
                                        <td>
                                            {{ $model->hasRank->name??'--' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Category:</th>
                                        <td>
                                            {{ $model->hasRank->hasHouseCategory->name??'--' }} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Person:</th>
                                        <td> 
                                            {{ ucfirst($model->soldier??'--') }}
                                        </td>
                                    </tr>
                                @endif
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
                                            {{ $model->hasPromotedMember->total_service??'--' }}
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
                                    <th>Branch:</th>
                                    <td> {{ $model->branch??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Unit:</th>
                                    <td> {{ $model->unit??'--' }} </td>
                                </tr>
                                <tr>
                                    <th>Other benefit:<small>(From Govt. of Pakistan e,g house, flat, plot etc)</small></th>
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
                    <div class="col-sm-12">
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
                </div>
            </div>
        </div>
    </div> 
@endsection