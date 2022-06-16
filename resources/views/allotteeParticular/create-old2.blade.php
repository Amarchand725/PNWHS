@extends('admin.master')
  @section('content')
    @include('flash_msgs')

    {!! Form::open([
      'route' => 'AllotteeParticular.store',
      'enctype' => "multipart/form-data",
      'class' => "membership_form"
    ]) !!}
      <style>
        input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
          line-height: 10px;
        }
      </style>
      <div class="panel panel-dark">
        <div class="panel-heading">
          <h4 class="panel-title">Registration Form</h4>
        </div>
        <div class="panel-body panel-body-nopadding">
          <!-- BASIC WIZARD -->
          <div class="basic-wizard">
            <ul class="nav nav-pills nav-justified">
              <li class='active step'><a href="#applicant-info" data-toggle="tab"><span>Step 1:</span> Particular of the Applicant</a></li>
              <li class='step'><a href="#parent-info"  data-toggle="tab"><span>Step 2:</span> Details of Next of Kin/Parents</a></li>
              <li class='step'><a href="#upload-docs" data-toggle="tab"><span>Step 3:</span> Upload Documents</a></li>
            </ul>

            <div class="tab-content">
              <div class="progress progress-striped active">
                <div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
              </div>

              <!-- Step#1: Applicant Form -->
              <div class="tab-pane active" id="applicant-info">
                  @if(Auth::user()->hasRole->role=='Admin')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              {!! Form::label("reg_file_no", "Registration /File Number |Last Allotted File Number:  :", ["class" => "control-label"]) !!}
                               <span><b id='last_reg_file_no'></b></span>
                              <span style='color:red'>*</span>

                              {!! Form::number("reg_file_no", null, ["class" => "form-control", "id" => "reg_file_no", "placeholder" => "Enter Registeration File No", 'required' => 'required']) !!}
                              <span id='error-reg_file_no' style='color:red'> {{ $errors->first('reg_file_no') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                          {!! Form::label("membership_date", "Membership Date:", ["class" => "control-label"]) !!}
                          <span style='color:red'>*</span>
                          <div class="form-group">
                            <input type="text" class='form-control' name='membership_date' value='{{ old("membership_date") }}' placeholder='Select membership date' id='membership_date' required>
                          </div>
                          <span id='error-membership_date' style='color:red'> {{ $errors->first('membership_date') }}</span>
                        </div>
                    </div>
                  @endif

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("p_no", "P/PJ/O No:", ["class" => "control-label"]) !!}
                      <span style='color:red'>*</span>
                      {!! Form::number("p_no", null, ["class" => "form-control", "id" => "p-no", "placeholder" => "Enter P|P.J No", 'required' => 'required']) !!}
                      <span id='error-p_no' style='color:red'> {{ $errors->first('p_no') }}</span>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      {!! Form::label("rank_rate", "Grade:", ["class" => "control-label"]) !!}
                      <small>(e.g MCPO and equivalent Navy Civilian)</small>
                      <span style='color:red'>*</span>
                      {!! Form::select("rank_rate", $ranks, null, ["class" => "form-control","id" => "rank-rate", "placeholder" => "Select Grade", 'required' => 'required']) !!}
                      <span id='error-rank' style='color:red'> {{ $errors->first('rank_rate') }}</span>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <br />
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="soldier" id="civilian" value="civilian" checked>
                      <label class="form-check-label" for="civilian">
                        Civilian
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="soldier" id="uniform" value="uniform">
                      <label class="form-check-label" for="uniform">
                        Uniform
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("Unit", "Unit ", ["class" => "control-label"]) !!}
                      <small>(e.g Pnsdilawar/PNWHS)</small><span style='color:red'>*</span>
                      {!! Form::text("unit", null, ["class" => "form-control", "placeholder" => "Enter unit"]) !!}
                      <span id='error-name' style='color:red'> {{ $errors->first('unit') }}</span>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("branch", "Rank/Rate", ["class" => "control-label"]) !!}
                      <small>(for example MCPO/WTR, FCPO(CHEF), Assistant)</small>
                      <span style='color:red'>*</span>
                      {!! Form::text("branch", null, ["class" => "form-control", "placeholder" => "Enter Rank/Rate/Designation"]) !!}
                      <span style='color:red'> {{ $errors->first('branch') }}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
                      <span style='color:red'>*</span>
                      {!! Form::text("name", null, ["class" => "form-control", "id" => "name", "placeholder" => "Enter Name", 'required' => 'required']) !!}
                      <span id='error-name' style='color:red'> {{ $errors->first('name') }}</span>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("cnic_no", "CNIC No:", ["class" => "control-label"]) !!}
                      <span style='color:red'>*</span>
                      {!! Form::text("cnic_no", null, ["class" => "form-control cnic", 'id'=>'cnic_no',  'maxlength'=>"15", 'Placeholder' => '12345-1234567-1', 'required' => 'required']) !!}
                      <span id='error-cnic-no' style='color:red'> {{ $errors->first('cnic_no') }}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    {!! Form::label("d_o_b", "Date of Birth:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                      <input type="text" class='form-control' value='{{ old("d_o_b") }}' placeholder='select date of birth' name='d_o_b' id='d_o_b_date' require>
                    </div>
                    <span id='error-dob' style='color:red'> {{ $errors->first('d_o_b') }}</span>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("email_address", "Email (Optional):", ["class" => "control-label"]) !!}
                      {!! Form::email("email_address", null, ["class" => "form-control", "placeholder" => "Enter correct E-mail"]) !!}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("mob_no", "Cell:", ["class" => "control-label"]) !!}
                      <span style='color:red'> *</span>
                      {!! Form::text("mob_no", null, ["class" => "form-control mobile", 'id'=>'mobile-no',  'maxlength'=>"13", 'placeholder' => '923xx-xxxxxxx' ]) !!}
                    </div>
                    <span style='color:red'> {{ $errors->first('mob_no') }}</span>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("tel_no", "Telephone (Optional):", ["class" => "control-label"]) !!}
                      {!! Form::text("tel_no", null, ["class" => "form-control", 'id'=> 'phone', 'maxlength'=>"15", 'placeholder' => 'Enter Telephone no']) !!}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("present_address", "Present Address:", ["class" => "control-label"]) !!}
                      <span style='color:red'>*</span>
                      <textarea name="present_address" class="form-control" placeholder="Present Address">{{ old('present_address') }}</textarea>
                      <span style='color:red'> {{ $errors->first('present_address') }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("permanent_address", "Permanent Address:", ["class" => "control-label"]) !!}
                      <span style='color:red'>*</span>
                      <textarea name="permanent_address" class="form-control" placeholder="Permanent Address" >{{ old('permanent_address') }}</textarea>
                      <span style='color:red'> {{ $errors->first('permanent_address') }}</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    {!! Form::label("d_o_e", "Date of Enrolment:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                      <input type="text" class='form-control' name='d_o_e' placeholder='select date of enrolment' value='{{ old("d_o_e") }}' id='d_o_e_date'>
                      <span style='color:red'> {{ $errors->first('d_o_e') }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    {!! Form::label("d_o_c", "Date of Completion of Probationary Period:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                      <input type="text" class='form-control date-completion-period' name='d_o_c' id='d_o_c_date' placeholder='select date of probationary completion' value='{{ old("d_o_c") }}' require>
                      <span id='error-doc' style='color:red'> {{ $errors->first('d_o_c') }}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    {!! Form::label("d_o_p", "Date of Promotion to Present Rank:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                      <input type="text" class='form-control' name='d_o_p' placeholder='select date of promotion' value='{{ old("d_o_p") }}' id='d_o_p_date'>
                      <span style='color:red'> {{ $errors->first('d_o_p') }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    {!! Form::label("d_o_sod", "Date of SOD:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                      <input type="text" class='form-control' name='d_o_sod' placeholder='select date of SOD' value='{{ old("d_o_sod") }}' id='d_o_sod_date' require>
                      <span style='color:red'> {{ $errors->first('d_o_sod') }}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 uniform-input" style='display:none'>
                    {!! Form::label("d_o_sos", "Date of SOS:", ["class" => "control-label"]) !!}
                    <small><b>(to be calculated form date of completion of probationary period)</b></small>
                    <div class="form-group">
                      <input type="text" class='form-control' name='d_o_sos' placeholder='select date of SOS' value='{{ old("d_o_sos") }}' id='d_o_sos_date' require>
                    </div>
                    <span style='color:red'> {{ $errors->first('d_o_sos') }}</span>
                  </div>
                  <div class="col-md-6 civilian-input">
                    {!! Form::label("d_o_s", "Date of Superannuation age:", ["class" => "control-label"]) !!}
                    <small><b>(for Navy Civilians)</b></small>
                    <div class="form-group">
                      <input type="text" class='form-control' name='d_o_s' placeholder='select date of Superannuation Age' value='{{ old("d_o_s") }}' id='d_o_s_date'>
                    </div>
                    <span style='color:red'> {{ $errors->first('d_o_s') }}</span>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("total_service", "Total Service Excluding Probationary Period:", ["class" => "control-label"]) !!}
                      <span style='color:red'>*</span>
                      <input type="text" class='form-control' name='total_service' value='{{ old("total_service") }}' id='service' readonly>
                      <span style='color:red' id="tot-service"> {{ $errors->first('total_service') }}</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("salary", "Gross Salary:", ["class" => "control-label"]) !!}
                      {!! Form::number("salary", null, ["class" => "form-control", "placeholder" => "Enter Gross Salary"]) !!}
                    </div>
                    <span style='color:red'> {{ $errors->first('Salary') }}</span>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      {!! Form::label("any_other_benifit", "Any other benefit :", ["class" => "control-label"]) !!}
                      <small>(From Govt. of Pakistan e,g house, flat, plot etc)</small>
                      <select class='form-control' name='any_other_benifit'>
                          <option value=''>Select any other benefit</option>
                          <option value='NA' {{ old('any_other_benifit')=='NA'?'selected':'' }}>N/A</option>
                          <option value='house' {{ old('any_other_benifit')=='house'?'selected':'' }}>House</option>
                          <option value='flat' {{ old('any_other_benifit')=='flat'?'selected':'' }}>Flat</option>
                          <option value='plot' {{ old('any_other_benifit')=='plot'?'selected':'' }}>Plot</option>
                      </select>
                    </div>
                    <span style='color:red'> {{ $errors->first('Salary') }}</span>
                  </div>
                </div>
                <br />
                <div class="row">
                  <div class="col-md-12" style='text-align:right'>
                    <div class="form-group">
                      <a href="#parent-info" class='btn btn-success next-btn' data-toggle="tab">Next <i class='fa fa-angle-double-right'></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Step#2: Parent Information 2 -->
              <div class="tab-pane" id="parent-info">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="col-sm-6">
                        <h3>Allottee Particular Next of Kin/Parent Details :</h3>
                        @if(Session::has('required_fields'))
                            <span style='color:red'>
                              {{ Session::get('required_fields') }}
                            </span>
                        @endif
                    </div>
                    <table class="table table-striped next-of-kin" id="item_table">
                      <thead>
                        <tr>
                          <th>Name <span style='color:red'>*</span></th>
                          <th># Relation <span style='color:red'>*</span></th>
                          <th># Define (if Other)</th>
                          <th>CNIC <span style='color:red'>*</span></th>
                          <th>Cell <span style='color:red'>*</span></th>
                          <th>Country Code</th>
                          <th>% Share <span style='color:red'>*</span></th>
                          <th>Address <span style='color:red'>*</span></th>
                          <th class="text-center">Actions</th>
                        </tr>
                      </thead>
                      <tbody id='transaction_tbody2'>
                         @if(!empty(Session::get('nextkin_old_data')))
                          <?php
                            $nextkins = Session::get('nextkin_old_data');
                            $kin = array_shift($nextkins);
                          ?>
                          @for ($key = 0; $key < count($kin); $key++) {
                            <tr class='transaction_row2' id='add-next-of-kin'>
                              <td>
                                <input type="text" id="name" name='nextkins[{{ $key }}][name]' value='{{ $kin[$key]["name"] }}' class="form-control"  placeholder="Enter Name">
                                <span style='color:red'> {{ $errors->first('nextkins[$key][name]') }}</span>
                              </td>
                              <td>
                                <select name="nextkins[{{ $key }}][relation]" id="relation" class='form-control next-of-relation'>
                                  <option value="">Select Relation</option>
                                  <option value="Father" {{ $kin[$key]["relation"]=='Father'?'selected':'' }}>Father</option>
                                  <option value="Mother" {{ $kin[$key]["relation"]=='Mother'?'selected':'' }}>Mother</option>
                                  <option value="Brother" {{ $kin[$key]["relation"]=='Brother'?'selected':'' }}>Brother</option>
                                  <option value="Sister" {{ $kin[$key]["relation"]=='Sister'?'selected':'' }}>Sister</option>
                                  <option value="Son" {{ $kin[$key]["relation"]=='Son'?'selected':'' }}>Son</option>
                                  <option value="Daughter" {{ $kin[$key]["relation"]=='Daughter'?'selected':'' }}>Daughter</option>
                                  <option value="Spouse" {{ $kin[$key]["relation"]=='Spouse'?'selected':'' }}>Spouse</option>
                                  <option value="Other" {{ $kin[$key]["relation"]=='Other'?'selected':'' }}>Other</option>
                                </select>
                                <span style='color:red'> {{ $errors->first('relation') }}</span>
                              </td>
                              <td>
                                <textarea id='define-other' name="nextkins[{{ $key }}][define_other]" class="form-control" placeholder="Define? if choose 'Other' from relation">
                                  {{ $kin[$key]["define_other"] }}
                                </textarea>
                                <span style='color:red'> {{ $errors->first('define_other') }}</span>
                              </td>
                              <td>
                                <input type="text" id='cnic-no' name='nextkins[{{ $key }}][cnic]' maxlength="15" class="form-control cnicrelation cnic" value='{{ $kin[$key]["cnic"] }}' placeholder="12345-1234567-1">
                                <span style='color:red'> {{ $errors->first('cnic') }}</span>
                              </td>
                              <td>
                                <input type="text" id='' name='nextkins[{{ $key }}][mobilenumber]' maxlength="12" value='{{ $kin[$key]["mobilenumber"] }}' class="form-control next-kin-mobile" placeholder="03xxxxxxxxx">
                                <span style='color:red'> {{ $errors->first('mobilenumber') }}</span>
                              </td>
                              <td>
                                <input type="number" class='form-control' name='nextkins[{{ $key }}][country_code]' value='{{ $kin[$key]["country_code"] }}' placeholder='Enter country code'>
                              </td>
                              <td>
                                <select name="nextkins[{{ $key }}][share]" id="share" class='form-control next-of-share'>
                                  <option value="">Select % share</option>
                                  @for($i=1; $i<=100; $i++)
                                    <option value='{{ $i }}' {{ $kin[$key]["share"]==$i?'selected':'' }}>{{ $i }}%</option>
                                  @endfor
                                </select>
                                <span style='color:red'> {{ $errors->first('share') }}</span>
                              </td>
                              <td>
                                <textarea id='kinaddress' name="nextkins[{{ $key }}][kinaddress]" class="form-control" placeholder="Enter kinaddress">
                                  {{ $kin[$key]["kinaddress"] }}
                                </textarea>
                                <span id='error-share' style='color:red'>{{ $errors->first('kinaddress') }}</span>
                              </td>
                              <td class="text-center">
                                <button type='button' data-counter='{{ $key }}' class='btn btn-success add-more-next-of-kins'><i class="fa fa-plus"></i></button>
                              </td>
                            </tr>
                          @endfor
                        @else
                          <tr class='transaction_row2' id='add-next-of-kin'>
                            <td>
                              <input type="text" id="name" name='nextkins[0][name]' value='{{ old("nextkins[0][name]") }}' class="form-control"  placeholder="Enter Name">
                              <span style='color:red'> {{ $errors->first('nextkins[0][name]') }}</span>
                            </td>
                            <td>
                              <select name="nextkins[0][relation]" id="relation" class='form-control next-of-relation'>
                                <option value="">Select Relation</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Son">Son</option>
                                <option value="Daughter">Daughter</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Other">Other</option>
                              </select>
                              <span style='color:red'> {{ $errors->first('relation') }}</span>
                            </td>
                            <td>
                              <textarea id='define-other' name="nextkins[0][define_other]" class="form-control" placeholder="Define? if choose 'Other' from relation">
                                {{ old('nextkins[0][define_other]') }}
                              </textarea>
                              <span style='color:red'> {{ $errors->first('define_other') }}</span>
                            </td>
                            <td>
                              <input type="text" id='cnic-no' name='nextkins[0][cnic]' maxlength="15" class="form-control cnicrelation cnic" value="{{ old('nextkins[0][cnic]') }}" placeholder="12345-1234567-1">
                              <span style='color:red'> {{ $errors->first('cnic') }}</span>
                            </td>
                            <td>
                              <input type="text" id='' name='nextkins[0][mobilenumber]' maxlength="12" value="{{ old('nextkins[0][mobilenumber]') }}" class="form-control next-kin-mobile" placeholder="03xxxxxxxxx">
                              <span style='color:red'> {{ $errors->first('mobilenumber') }}</span>
                            </td>
                            <td>
                              <input type="number" class='form-control' name='nextkins[0][country_code]' value="{{ old('nextkins[0][country_code]') }}" placeholder='Enter country code'>
                            </td>
                            <td>
                              <select name="nextkins[0][share]" id="share" class='form-control next-of-share'>
                                <option value="">Select % share</option>
                                @for($i=1; $i<=100; $i++)
                                  <option value='{{ $i }}' {{ old('nextkins[0][share]')==".$i."?"selected":"" }}>{{ $i }}%</option>
                                @endfor
                              </select>
                              <span style='color:red'> {{ $errors->first('share') }}</span>
                            </td>
                            <td>
                              <textarea id='kinaddress' name="nextkins[0][kinaddress]" class="form-control" placeholder="Enter kinaddress">
                                {{ old('nextkins[0][kinaddress]') }}
                              </textarea>
                              <span id='error-share' style='color:red'>{{ $errors->first('kinaddress') }}</span>
                            </td>
                            <td class="text-center">
                              <button type='button' data-counter='0' class='btn btn-success add-more-next-of-kins'><i class="fa fa-plus"></i></button>
                            </td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style='text-align:right'>
                    <div class="form-group">
                      <a href="#applicant-info" class='btn btn-info previouse-btn' data-toggle="tab"><i class='fa fa-angle-double-left'></i> Previous</a>
                      <a href="#upload-docs" class='btn btn-success next-btn' data-toggle="tab">Next <i class='fa fa-angle-double-right'></i></a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Step#3: Upload Documents 3 -->
              <div class="tab-pane" id="upload-docs">
                <div class="row">
                  <div class="col-sm-12">
                    <h2>List of Document Required</h2>
                  </div>
                  <div class="col-sm-12">
                    <table class="table table-striped next-of-kin-docs" id="item_table">
                      <tbody id='transaction_tbody3'>
                        <tr>
                          <th>CNIC<small>(Self) attested copy of front</small></th>
                          <th>CNIC<small>(Self) attested copy of back</small></th>
                        </tr>
                        <tr>
                          <td>
                            <input type="file" name="cnicfront" class="form-control" accept="image/x-png,image/jpeg">
                            <span style='color:red'> {{ $errors->first('cnicfront') }}</span>
                          </td>
                          <td>
                            <input type="file" name="cnicback" class="form-control" accept="image/x-png,image/jpeg" >
                            <span style='color:red'> {{ $errors->first('cnicback') }}</span>
                          </td>
                        </tr>
                        <tr>
                          <th>NOK (Next of Kin) CNIC front</th>
                          <th>NOK (Next of Kin) CNIC back</th>
                          <th class="text text-center">Actions</th>
                        </tr>
                        <tr class='transaction_row2'>
                          <td>
                            <input type="file" name="transactionform2[0][nextofkinfilefront]" class="form-control" id='nextofkinfilefront' multiple="multiple" accept="image/x-png,image/jpeg">
                          </td>
                          <td>
                            <input type="file" name="transactionform2[0][nextofkinfileback]" class="form-control" id='nextofkinfileback'  multiple="multiple" accept="image/x-png,image/jpeg">
                          </td>
                          <td class="text-center">
                            <button type='button' data-counter='0' class='btn btn-success addMore3 add-more-next-kin-cnic'><i class="fa fa-plus"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <th>Children B form attested copy</th>
                          <th>Promotion Letter </th>
                        </tr>
                        <tr>
                          <td>
                            <input type="file" name="childrenbform" class="form-control" multiple="multiple" accept="image/x-png,image/jpeg">
                            <span style='color:red'> {{ $errors->first('childrenbform') }}</span>
                          </td>
                          <td>
                            <input type="file" name="promotion_letter" class="form-control" multiple="multiple" accept="image/x-png,image/jpeg">
                            <span style='color:red'> {{ $errors->first('promotion_letter') }}</span>
                          </td>
                        </tr>
                        <tr>
                          <th> Allotment Form </th>
                          <th>Colour Photograph (in Uniform where applicable)</th>
                        </tr>
                        <tr>
                          <td>
                            <input type="file" name="fpaform" class="form-control" multiple="multiple" accept="image/x-png,image/jpeg">
                            <span style='color:red'> {{ $errors->first('fpaform') }}</span>
                          </td>
                          <td>
                            <input type="file" name="applicant_photograph" class="form-control" multiple="multiple" accept="image/x-png,image/jpeg">
                            <span style='color:red'> {{ $errors->first('applicant_photograph') }}</span>
                          </td>
                        </tr>
                        <tr>
                          <th>FC(W)-10 form/FRP-36/ Form of Nomination</th>
                          <th> Demand Draft/ Bankers cheque <small>(Compulsory for POs & above Grades and Navy Civilians)</small></th>
                        </tr>
                        <tr>
                          <td>
                            <input type="file" name="frp_fc" class="form-control" multiple="multiple" accept="image/x-png,image/jpeg">
                            <span style='color:red'> {{ $errors->first('frp_fc') }}</span>
                          </td>
                          <td>
                            <input type="file" name="draft_cheque" class="form-control" multiple="multiple" accept="image/x-png,image/jpeg">
                          </td>
                        </tr>
                        <tr>
                          <th> Any other document <small>(e.g Discharge Order if applicable etc)</small></th>
                        </tr>
                        <tr>
                          <td>
                            <input type="file" name="any_other_docs" class="form-control" multiple="multiple" accept="image/x-png,image/jpeg">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class='row'>
                  <div class="col-md-12">
                      <div class="form-group">
                        <a href="#parent-info" class='btn btn-info previouse-btn' data-toggle="tab"><i class='fa fa-angle-double-left'></i> Previous</a>
                        <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Submit Form</button>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    {!! Form::close() !!}

    <Script>
         $('#rank-rate').on('change', function(){
            var rank_id = $(this).val();
            $.ajax({
              method  : 'get',
              url     : '{{ url("get_last_reg_file_no") }}/'+rank_id,
              success : function(response){
                if(response != ''){
                  $('#last_reg_file_no').text(response.reg_file_no);
                }else{
                  $('#last_reg_file_no').text(0);
                }
              }
            });
          });

        $(document).ready(function () {
            $('input[id$=date]').datepicker({
              dateFormat: 'dd-mm-yy'
            });
            $('#d_o_c_date').removeClass('date-completion-period');
         });

      //Civilian & Uniform
      $('input[type=radio][name=soldier]').change(function() {
        if (this.value == 'civilian') {
          $('.uniform-input').hide();
          $('.civilian-input').show();
          $('#d_o_c_date').removeClass('date-completion-period');
        }
        else if (this.value == 'uniform') {
          $('.uniform-input').show();
          $('.civilian-input').hide();
          $('#d_o_c_date').addClass('date-completion-period');
        }
      });

      //calculation share
      $(document).on('change', '#share', function(){
        var total_share = 0;
        $('.next-of-kin').find('.next-of-share').each(function(){
          total_share += parseInt($(this).children("option:selected").val());
          if(total_share>100){
            $(this).val('');
            $(this).parent('td').find("#error-share").text('% can not be greater..!');
          }else{
            $(this).parent('td').find("#error-share").text('');
          }
        })
      });

       //Date of Probationary validation
     $('#d_o_c_date').on('change', function(){
        var date_of_probationary_completion = $(this).val();
        var date_of_enrolment = $('#d_o_e_date').val();

        var date = date_of_probationary_completion.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var probation_date = yy+'-'+mm+'-'+dd;

        var date = date_of_enrolment.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var enrolment_date = yy+'-'+mm+'-'+dd;

        if(date_of_enrolment==''){
          $('#error-doc').text('Enter entrolment date must');
        }else if(new Date(probation_date) < new Date(enrolment_date)){
          $('#error-doc').text('* Probationary date can not be less than enrolment date.');
          $(this).val('');
          return false;
        }else{
          $('#error-doc').text('');
        }
      });

      $('#d_o_e_date').on('change', function(){
        var date_of_enrolment = $(this).val();
        var date_of_probationary_completion = $('#d_o_c_date').val();

        var date = date_of_probationary_completion.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var probation_date = yy+'-'+mm+'-'+dd;

        var date = date_of_enrolment.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var enrolment_date = yy+'-'+mm+'-'+dd;
        
        if(new Date(probation_date) < new Date(enrolment_date)){
          $('#error-doc').text('* Enrolment date can not be greater than probationary completion date.');
          $(this).val('');
          return false;
        }else{
          $('#error-doc').text('');
        }
      });

      //Calculating Service of uniform
      $('#d_o_sos_date').on('change', function(){
        var date_of_sos = $(this).val();
        var date_of_probationary_completion = $('#d_o_c_date').val();

        var date = date_of_sos.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var sos = moment([yy, mm, dd]);
        var sos_date = yy+'-'+mm+'-'+dd;

        var date = date_of_probationary_completion.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);
        var probation = moment([yy, mm, dd]);
        var probation_date = yy+'-'+mm+'-'+dd;

        if(date_of_sos=='' || probation_date==''){
            $('#service').val('( 0 year 0 month 0 days )');
        }else if(new Date(sos_date) < new Date(probation_date)){
            $('#service').val('( 0 year 0 month 0 days )');
            $(this).val('');
            $('#tot-service').html('SOS Date should be greater than probationary completion period.');
        }else{
            $('#tot-service').html('');
            $.ajax({
                type:'POST',
                url:'{{ url("calculate_service") }}',
                data:{_token: "{{ csrf_token() }}", sos_date:sos_date, probation_date:probation_date },
                success: function(response) {
                    $('#service').val('( '+response.years+' year '+response.months+' month '+response.days+' days )');
                }
            });
        }
      });

      $('.date-completion-period').on('change', function(){
        var soldier = $('input[name="soldier"]:checked').val();
        if(soldier=='civilian'){
            return false;
        }
        var date_of_probationary_completion = $(this).val();
        var date_of_sos = $('#d_o_sos_date').val();

        var date = date_of_sos.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var sos = moment([yy, mm, dd]);
        var sos_date = yy+'-'+mm+'-'+dd;

        var date = date_of_probationary_completion.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);
        var probation = moment([yy, mm, dd]);
        var probation_date = yy+'-'+mm+'-'+dd;

        if(date_of_sos=='' || probation_date==''){
            $('#service').val('( 0 year 0 month 0 days )');
        }else if(new Date(sos_date) < new Date(probation_date)){
            $('#service').val('( 0 year 0 month 0 days )');
            $(this).val('');
            $('#tot-service').html('Probationary completion period should be less than date of sos.');
        }else{
            $('#tot-service').html('');
            $.ajax({
                type:'POST',
                url:'{{ url("calculate_service") }}',
                data:{_token: "{{ csrf_token() }}", sos_date:sos_date, probation_date:probation_date },
                success: function(response) {
                    $('#service').val('( '+response.years+' year '+response.months+' month '+response.days+' days )');
                }
            });
        }
      });

      //Calculating Service of civilian
      $('#d_o_s_date').on('change', function(){
        var d_o_s = $(this).val();
        var date_of_birth = $('#d_o_b_date').val();

        var date = d_o_s.split('-');

        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var dos = moment([yy, mm, dd]);
        var dos_date = yy+'-'+mm+'-'+dd;

        var date = date_of_birth.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);
        var dob = moment([yy, mm, dd]);
        var do_birth = yy+'-'+mm+'-'+dd;

        if(d_o_s==''){
            $('#service').val('( 0 year 0 month 0 days )');
        }else if(date_of_birth==''){
            $('#service').val('( 0 year 0 month 0 days )');
            $('#tot-service').html('For civilian calculating service please enter date of birth.');
        }else if(new Date(dos_date) < new Date(do_birth)){
            $('#service').val('( 0 year 0 month 0 days )');
            $(this).val('');
            $('#tot-service').html('DOS Date should be greater than date of birth.');
        }else{
            $('#tot-service').html('');
            $.ajax({
                type:'POST',
                url:'{{ url("calculate_service") }}',
                data:{_token: "{{ csrf_token() }}", sos_date:dos_date, probation_date:do_birth },
                success: function(response) {
                    $('#service').val('( '+response.years+' year '+response.months+' month '+response.days+' days )');
                }
            });
        }
      });

      $('#d_o_b_date').on('change', function(){
        var date_of_birth = $(this).val();
        var d_o_s = $('#d_o_s_date').val();

        var date = d_o_s.split('-');

        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);

        var dos = moment([yy, mm, dd]);
        var dos_date = yy+'-'+mm+'-'+dd;

        var date = date_of_birth.split('-');
        var dd = parseInt(date[0]);
        var mm = parseInt(date[1]);
        var yy = parseInt(date[2]);
        var dob = moment([yy, mm, dd]);
        var do_birth = yy+'-'+mm+'-'+dd;

        if(d_o_s==''){
            $('#service').val('( 0 year 0 month 0 days )');
        }else if(date_of_birth==''){
            $('#service').val('( 0 year 0 month 0 days )');
            $('#tot-service').html('For civilian calculating service please enter date of birth.');
        }else if(new Date(dos_date) < new Date(do_birth)){
            $('#service').val('( 0 year 0 month 0 days )');
            $(this).val('');
            $('#tot-service').html('Date of birth should be less than date of  superannuation age.');
        }else{
            $('#tot-service').html('');
            $.ajax({
                type:'POST',
                url:'{{ url("calculate_service") }}',
                data:{_token: "{{ csrf_token() }}", sos_date:dos_date, probation_date:do_birth },
                success: function(response) {
                    $('#service').val('( '+response.years+' year '+response.months+' month '+response.days+' days )');
                }
            });
        }
      });

      //Form Next Button
      $(".next-btn").click(function(){
        var $next;
        var $selected = $(".active");
        $next = $selected.next('li');
        $selected.removeClass("active");
        $next.closest('li').addClass('active');
      });

      //Form Previouse Button
      $(".previouse-btn").click(function(){
        var active = $('ul li.active');
        if(active.is(':first-child')){
          $('ul li:last-child').addClass('active');
          active.removeClass('active')
        }
        active.prev().addClass('active');
        active.removeClass('active')
      });

      //Add More Next of kins
      var counter = 0;
      $(document).on('click', '.add-more-next-of-kins', function(){
        counter++;
        var key = $(this).attr('data-counter');
        if(key>0){
          counter = parseInt(key)+1;
        }
        var html = "";
        html += "<tr class='transaction_row2' id='add-next-of-kin'>"+
                      "<td>"+
                        "<input type='text' id='name' name='nextkins["+counter+"][name]' class='form-control' placeholder='Enter Name'>"+
                      "</td>"+
                            "<td>"+
                              "<select name='nextkins["+counter+"][relation]' id='relation' class='form-control'>"+
                                "<option value=''>Select Relation</option>"+
                                "<option value='Father'>Father</option>"+
                                "<option value='Mother'>Mother</option>"+
                                "<option value='Brother'>Brother</option>"+
                                "<option value='Sister'>Sister</option>"+
                                "<option value='Son'>Son</option>"+
                                "<option value='Daughter'>Daughter</option>"+
                                "<option value='Spouse'>Spouse</option>"+
                                "<option value='Other'>Other</option>"+
                              "</select>"+
                            "</td>"+
                            "<td>"+
                              "<textarea id='define-other' name='nextkins["+counter+"][define_other]' class='form-control' placeholder='Define? if choose Other from relation' ></textarea>"+
                            "</td>"+
                            "<td>"+
                              "<input type='text' id='next-kin-cnic' name='nextkins["+counter+"][cnic]' maxlength='15' class='form-control cnicrelation cnic next-kin-cnic' placeholder='12345-1234567-1'>"+
                            "</td>"+
                            "<td>"+
                              "<input type='text' id='mobileno' name='nextkins["+counter+"][mobilenumber]' maxlength='12' class='form-control next-kin-mobile' placeholder='03xxxxxxxxx'>"+
                            "</td>"+
                            "<td>"+
                              "<input type='number' class='form-control' name='nextkins["+counter+"][country_code]' placeholder='Enter country code'>"+
                            "</td>"+
                            "<td>"+
                              "<select name='nextkins["+counter+"][share]' id='share' class='form-control next-of-share'>"+
                                "<option value='' selelcted>Select % share</option>";
                                  for(var i=1; i<=100; i++){
                                    html += "<option value='"+i+"'>"+i+"%</option>";
                                  }
                              html += "</select>"+
                              "<span id='error-share' style='color:red'></span>"+
                            "</td>"+
                            "<td>"+
                              "<textarea id='kinaddress' name='nextkins["+counter+"][kinaddress]' class='form-control' placeholder='Enter kinaddress'></textarea>"+
                            "</td>"+
                            "<td class='text-center'>"+
                              "<button type='button' data-counter="+counter+" class='btn btn-success add-more-next-of-kins'><i class='fa fa-plus'></i></button>"+
                              "<button type='button' class='btn btn-danger delete'><i class='fa fa-trash-o'></i></button>"+
                            "</td>"+
                          "</tr>";
                          $('#item_table').find('tbody').append(html);
      });

      //CNIC Pattern
      $(document).on('keydown', '.next-kin-cnic', function(){
        if (event.keyCode == 8 || event.keyCode == 9
                            || event.keyCode == 27 || event.keyCode == 13
                            || (event.keyCode == 65 && event.ctrlKey === true) )
                                return;
        if((event.keyCode < 48 || event.keyCode > 57 && event.keyCode < 96 || event.keyCode > 105))
            event.preventDefault();
            var length = $(this).val().length;

        if(length == 5 || length == 13)
            $(this).val($(this).val()+'-');
      });

      //Mobile Number Pattern
      $(document).on('keydown', '.next-kin-mobile', function(){
        //allow  backspace, tab, ctrl+A, escape, carriage return
        if (event.keyCode == 8 || event.keyCode == 9
                                || event.keyCode == 27 || event.keyCode == 13
                                || (event.keyCode == 65 && event.ctrlKey === true) )
                                    return;
        if((event.keyCode < 48 || event.keyCode > 57 && event.keyCode < 96 || event.keyCode > 105))
            event.preventDefault();
            var length = $(this).val().length;

        if(length == 4)
            $(this).val($(this).val()+'-');
      });

      //Add More Next of Kin CNIC
      $(document).on('click', '.add-more-next-kin-cnic', function(){
        counter++;
        var html = "<tr class='transaction_row2'>"+
                      "<td>"+
                        "<input type='file' name='transactionform2["+counter+"][nextofkinfilefront]' class='form-control' id='nextofkinfilefront' multiple='multiple' accept='image/x-png,image/gif,image/jpeg'>"+
                      "</td>"+
                      "<td>"+
                        "<input type='file' name='transactionform2["+counter+"][nextofkinfileback]' class='form-control' id='nextofkinfileback'  multiple='multiple' accept='image/x-png,image/gif,image/jpeg'>"+
                      "</td>"+
                      "<td class='text-center'>"+
                        "<button type='button' class='btn btn-success addMore3 add-more-next-kin-cnic'><i class='fa fa-plus'></i></button>"+
                        "<button type='button' class='btn btn-danger delete'><i class='fa fa-trash-o'></i></button>"+
                      "</td>"+
                    "</tr>";
                  $(this).closest('tr').after(html);
      });

      //Remove Add More
      $("body").on('click','.delete,.delete_tax',function(){
        $(this).closest('tr').remove();
      });

    //   Client side validation
      $('.membership_form').validate({
        submitHandler: function(form) {
          form.submit();
        }
      });
    </script>
  @endsection
