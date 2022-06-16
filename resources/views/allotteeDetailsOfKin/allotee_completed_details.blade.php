@extends('admin.master')
@section('content')
    @include('flash_msgs')
    {{ Form::open(array('url' => 'member_more_details', 'method' => 'post')) }}
        {{-- Member Info --}}
        <div class='row'>
            <div class="col-md-12">
                <h3 class='pull-left'>Member Personal Detail:</h3>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("p_no", "P/PJ/O No:", ["class" => "control-label"]) !!}
                    {!! Form::number("p_no", $alloteeselecteddata->p_no, ["class" => "form-control", 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
                    {!! Form::text("name", $alloteeselecteddata->name, ["class" => "form-control", 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("cnic_no", "CNIC No:", ["class" => "control-label"]) !!}
                    {!! Form::text("cnic_no", $alloteeselecteddata->cnic_no, ["class" => "form-control cnic", 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("father_name_particular", "Father's Name:", ["class" => "control-label"]) !!}
                    {!! Form::text("father_name_particular", $alloteeselecteddata->father_name_particular, ["class" => "form-control", 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("tel_no", "Telphone No:", ["class" => "control-label"]) !!}
                    {!! Form::number("tel_no", $alloteeselecteddata->tel_no, ["class" => "form-control", 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("mob_no", "Mobile No:", ["class" => "control-label"]) !!}
                    {!! Form::number("mob_no", $alloteeselecteddata->mob_no, ["class" => "form-control", 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("email_address", "Email Address:", ["class" => "control-label"]) !!}
                    {!! Form::email("email_address", $alloteeselecteddata->email_address, ["class" => "form-control", 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>

        {{-- Member Wife Info --}}
        <div class='row'>
            <div class="col-md-12">
                <div class="form-group">
                    <h3 class='pull-left'>1# Wife Personal Detail:</h3>
                    <table class="table table-striped" id="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CNIC No</th>
                                <th>Mobile No</th>
                                <th>Security Clearance</th>
                                <th>Blacklist</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id='wife_tbody'>
                            @if(!empty($alloteeselecteddata->hasWife))
                                @foreach($alloteeselecteddata->hasWife as $key=>$wife)
                                    <tr class='wife_row'>
                                        <td>
                                            <input type="text" id="wife_name" name='wife[{{ $key }}][wife_name]' placeholder="Enter Name" class="form-control wife_name" value="{{ $wife->name }}">
                                        </td>
                                        <td>
                                            <input type="text" id='wife_cnic' name='wife[{{ $key }}][wife_cnic]' placeholder="Enter CNIC" class="form-control wife_cnic" value="{{ $wife->cnic_no }}">
                                        </td>
                                        <td>
                                            <input type="text" id='wife_mobile' name='wife[{{ $key }}][wife_mobile]' placeholder="Enter Mobile No" class="form-control wife_mobile" value="{{ $wife->mobile_no }}">
                                        </td>
                                        <td>
                                            <input type="checkbox" id="wife_security_clearance" name="wife[{{ $key }}][wife_security_clearance]" {{ $wife->security_clearance==1?'checked':'' }} value="1">
                                            <label for="clearance">Security Clearance</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="wife_blacklist" name="wife[{{ $key }}][wife_blacklist]" {{ $wife->blacklist==1?'checked':'' }} value="1">
                                            <label for="vehicle1" >blacklist</label>
                                        </td>
                                        <td class="text-center">
                                            <button type='button' class='btn btn-success wifeaddMore' data-key="{{ $key }}"><i class="fa fa-plus"></i></button>
                                            <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class='wife_row'>
                                    <td>
                                    <input type="text" id="wife_name" name='wife[0][wife_name]' placeholder="Enter Name" class="form-control wife_name" value="">
                                    </td>
                                    <td>
                                        <input type="text" id='wife_cnic' name='wife[0][wife_cnic]' placeholder="Enter CNIC" class="form-control wife_cnic">
                                    </td>
                                    <td>
                                        <input type="text" id='wife_mobile' name='wife[0][wife_mobile]' placeholder="Enter Mobile No" class="form-control wife_mobile">
                                    </td>
                                    <td>
                                        <input type="checkbox" id="wife_security_clearance" name="wife[0][wife_security_clearance]" value="1">
                                        <label for="clearance">Security Clearance</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="wife_blacklist" name="wife[0][wife_blacklist]" value="1">
                                        <label for="vehicle1" >blacklist</label>
                                    </td>
                                    <td class="text-center">
                                        <button type='button' class='btn btn-success wifeaddMore' data-key="0"><i class="fa fa-plus"></i></button>
                                        <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
	        </div>
        </div>

        {{-- Member Children Info --}}
        <div class='row'>
            <div class="col-md-12">
                <h3 class='pull-left'>2# Children Detail:</h3>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("total child", "Total child:", ["class" => "control-label"]) !!}
                    {!! Form::text("total_child", null, ["class" => "form-control", "placeholder" => "Enter No of Children"]) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label("child_b_form", "Child B Form:", ["class" => "control-label"]) !!}
                    {!! Form::text("child_b_form", 'B Form Selected', ["class" => "form-control",'readonly' => 'readonly']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <br />
                    <table class="table table-striped" id="item_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>security Clearance</th>
                                <th>Blacklist</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id='children_tbody'>
                            @if(!empty($alloteeselecteddata->hasChild))
                                @foreach($alloteeselecteddata->hasChild as $key=>$child)
                                    <tr class='children_row'>
                                        <td>
                                        <input type="text" id="child_name" name='children[{{ $key }}][child_name]' placeholder="Enter Name" class="form-control" value="{{ $child->name }}">
                                        </td>
                                        <td>
                                            <input type="number" id='child_age' name='children[{{ $key }}][child_age]' placeholder="Enter Age" class="form-control child_age" value="{{ $child->age }}">
                                        </td>
                                        <td>
                                            <select  id="child_gender" name="children[{{ $key }}][child_gender]" class='form-control'>
                                                <option value="">Select gender</option>
                                                <option value="male" {{ $child->gender=='male'?'selected':'' }}>Male</option>
                                                <option value="female" {{ $child->gender=='female'?'selected':'' }}>Female</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="child_security_clearance" name="children[{{ $key }}][child_security_clearance]" {{ $wife->security_clearance==1?'checked':'' }} value="1">
                                            <label for="vehicle1">Child Security Clearance</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="child_blacklist" name="children[{{ $key }}][child_blacklist]" {{ $wife->blacklist==1?'checked':'' }} value="1">
                                            <label for="vehicle1" >Child blacklist</label>
                                        </td>
                                        <td class="text-center">
                                            <button type='button' class='btn btn-success childrenaddMore' data-key="{{ $key }}"><i class="fa fa-plus"></i></button>
                                            <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class='children_row'>
                                    <td>
                                        <input type="text" id="child_name" name='children[0][child_name]' placeholder="Enter Name" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" id='child_age' name='children[0][child_age]' placeholder="Enter Age" class="form-control child_age">
                                    </td>
                                    <td>
                                        <select  id="child_gender" name="children[0][child_gender]" class='form-control'>
                                            <option value="">Select gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="child_security_clearance" name="children[0][child_security_clearance]" value="1">
                                        <label for="vehicle1">Child Security Clearance</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="child_blacklist" name="children[0][child_blacklist]" value="1">
                                        <label for="vehicle1" >Child blacklist</label>
                                    </td>
                                    <td class="text-center">
                                        <button type='button' class='btn btn-success childrenaddMore' data-key="0"><i class="fa fa-plus"></i></button>
                                        <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Member Made Info --}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h3 class='pull-left'>3# Made Personal Detail:</h3>
                    <table class="table table-striped" id="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CNIC No</th>
                                <th>Mobile No</th>
                                <th>Security Clearance</th>
                                <th>Blacklist</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id='made_tbody'>
                            @if(!empty($alloteeselecteddata->hasMade))
                                @foreach($alloteeselecteddata->hasMade as $key=>$made)
                                    <tr class='made_row'>
                                        <td>
                                            <input type="text" id="made_name" name='made[{{ $key }}][made_name]' placeholder="Enter Name" class="form-control made_name" value="{{ $made->name }}">
                                        </td>
                                        <td>
                                            <input type="text" id='made_cnic' name='made[{{ $key }}][made_cnic]' placeholder="Enter CNIC No" class="form-control made_cnic" value="{{ $made->cnic_no }}">
                                        </td>
                                        <td>
                                            <input type="text" id='made_mobile' name='made[{{ $key }}][made_mobile]' placeholder="Enter Mobile No" class="form-control made_mobile" value="{{ $made->mobile_no }}">
                                        </td>
                                        <td>
                                            <input type="checkbox" id="made_security_clearance" name="made[{{ $key }}][made_security_clearance]" {{ $made->security_clearance==1?'checked':'' }} value="1">
                                            <label for="clearance">Security Clearance</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="made_blacklist" name="made[{{ $key }}][made_blacklist]" {{ $made->blacklist==1?'checked':'' }} value="1">
                                            <label for="vehicle1" >blacklist</label>
                                        </td>
                                        <td class="text-center">
                                            <button type='button' class='btn btn-success madeaddMore' data-key="{{ $key }}"><i class="fa fa-plus"></i></button>
                                            <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class='made_row'>
                                    <td>
                                        <input type="text" id="made_name" name='made[0][made_name]' placeholder="Enter Name" class="form-control made_name">
                                    </td>
                                    <td>
                                        <input type="text" id='made_cnic' name='made[0][made_cnic]' placeholder="Enter CNIC No" class="form-control made_cnic">
                                    </td>
                                    <td>
                                        <input type="text" id='made_mobile' name='made[0][made_mobile]' placeholder="Enter Mobile No" class="form-control made_mobile">
                                    </td>
                                    <td>
                                        <input type="checkbox" id="made_security_clearance" name="made[0][made_security_clearance]" value="1">
                                        <label for="clearance">Security Clearance</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="made_blacklist" name="made[0][made_blacklist]" value="1">
                                        <label for="vehicle1" >blacklist</label>
                                    </td>
                                    <td class="text-center">
                                        <button type='button' class='btn btn-success madeaddMore' data-key="0"><i class="fa fa-plus"></i></button>
                                        <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>        
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Member Driver Info --}}
        <div class='row'>
            <div class="col-md-12">
                <div class="form-group">
                    <h3 class=''>4# Driver Personal Detail:</h3>
                    <table class="table table-striped" id="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CNIC No</th>
                                <th>Mobile No</th>
                                <th>Security Clearance</th>
                                <th>Blacklist</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id='driver_tbody'>
                            @if(!empty($alloteeselecteddata->hasDriver))
                                @foreach($alloteeselecteddata->hasDriver as $key=>$driver)
                                    <tr class='driver_row'>
                                        <td>
                                            <input type="text" id="driver_name" name='driver[{{ $key }}][driver_name]' placeholder="Enter Name" class="form-control driver_name" value="{{ $driver->name }}">
                                        </td>
                                        <td>
                                            <input type="text" id='driver_cnic' name='driver[{{ $key }}][driver_cnic]' placeholder="Enter CNIC No" class="form-control driver_cnic" value="{{ $driver->cnic_no }}">
                                        </td>
                                        <td>
                                            <input type="text" id='driver_mobile' name='driver[{{ $key }}][driver_mobile]' placeholder="Enter Mobile No" class="form-control driver_mobile" value="{{ $driver->mobile_no }}">
                                        </td>
                                        <td>
                                            <input type="checkbox" id="driver_security_clearance" name="driver[{{ $key }}][driver_security_clearance]" {{ $driver->security_clearance==1?'checked':'' }} value="1">
                                            <label for="clearance">Security Clearance</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="driver_blacklist" name="driver[{{ $key }}][driver_blacklist]" {{ $driver->blacklist==1?'checked':'' }} value="1">
                                            <label for="vehicle1" >blacklist</label>
                                        </td>
                                        <td class="text-center">
                                            <button type='button' class='btn btn-success driveraddMore' data-key="{{ $key }}"><i class="fa fa-plus"></i></button>
                                            <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class='driver_row'>
                                    <td>
                                        <input type="text" id="driver_name" name='driver[0][driver_name]' placeholder="Enter Name" class="form-control driver_name">
                                    </td>
                                    <td>
                                        <input type="text" id='driver_cnic' name='driver[0][driver_cnic]' placeholder="Enter CNIC No" class="form-control driver_cnic">
                                    </td>
                                    <td>
                                        <input type="text" id='driver_mobile' name='driver[0][driver_mobile]' placeholder="Enter Mobile No" class="form-control driver_mobile">
                                    </td>
                                    <td>
                                        <input type="checkbox" id="driver_security_clearance" name="driver[0][driver_security_clearance]" value="1">
                                        <label for="clearance">Security Clearance</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="driver_blacklist" name="driver[0][driver_blacklist]" value="1">
                                        <label for="vehicle1" >blacklist</label>
                                    </td>
                                    <td class="text-center">
                                        <button type='button' class='btn btn-success driveraddMore' data-key="0"><i class="fa fa-plus"></i></button>
                                        <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Member Chef Info --}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h3 class=''>5# Chef Personal Detail:</h3>
                    <table class="table table-striped" id="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CNIC No</th>
                                <th>Mobile No</th>
                                <th>Security Clearance</th>
                                <th>Blacklist</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id='chef_tbody'>
                            @if(!empty($alloteeselecteddata->hasChef))
                                @foreach($alloteeselecteddata->hasChef as $key=>$chef)
                                    <tr class='chef_row'>
                                        <td>
                                            <input type="text" id="chef_name" name='chef[{{ $key }}][chef_name]' placeholder="Enter Name" class="form-control chef_name" value="{{ $chef->name }}">
                                        </td>
                                        <td>
                                            <input type="text" id='chef_cnic' name='chef[{{ $key }}][chef_cnic]' placeholder="Enter CNIC No" class="form-control chef_cnic" value="{{ $chef->cnic_no }}">
                                        </td>
                                        <td>
                                            <input type="text" id='chef_mobile' name='chef[{{ $key }}][chef_mobile]' placeholder="Enter Mobile No" class="form-control chef_mobile" value="{{ $chef->mobile_no }}">
                                        </td>
                                        <td>
                                            <input type="checkbox" id="chef_security_clearance" name="chef[{{ $key }}][chef_security_clearance]" {{ $chef->security_clearance?'checked':'' }} value="1">
                                            <label for="clearance">Security Clearance</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="chef_blacklist" name="chef[{{ $key }}][chef_blacklist]" {{ $chef->blacklist?'checked':'' }} value="1">
                                            <label for="vehicle1" >blacklist</label>
                                        </td>
                                        <td class="text-center">
                                            <button type='button' class='btn btn-success chefaddMore' data-key="{{ $key }}"><i class="fa fa-plus"></i></button>
                                            <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class='chef_row'>
                                    <td>
                                        <input type="text" id="chef_name" name='chef[0][chef_name]' placeholder="Enter Name" class="form-control chef_name">
                                    </td>
                                    <td>
                                        <input type="text" id='chef_cnic' name='chef[0][chef_cnic]' placeholder="Enter CNIC No" class="form-control chef_cnic">
                                    </td>
                                    <td>
                                        <input type="text" id='chef_mobile' name='chef[0][chef_mobile]' placeholder="Enter Mobile No" class="form-control chef_mobile">
                                    </td>
                                    <td>
                                        <input type="checkbox" id="chef_security_clearance" name="chef[0][chef_security_clearance]" value="1">
                                        <label for="clearance">Security Clearance</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="chef_blacklist" name="chef[0][chef_blacklist]" value="1">
                                        <label for="vehicle1" >blacklist</label>
                                    </td>
                                    <td class="text-center">
                                        <button type='button' class='btn btn-success chefaddMore' data-key="0"><i class="fa fa-plus"></i></button>
                                        <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Member Gardener Info --}}
        <div class="row">
            <div class="col-md-12">
                <h3 class=''>6# Gardener Personal Detail:</h3>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <table class="table table-striped" id="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>CNIC No</th>
                                <th>Mobile No</th>
                                <th>Security Clearance</th>
                                <th>Blacklist</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id='gardener_tbody'>
                            @if(!empty($alloteeselecteddata->hasGardener))
                                @foreach($alloteeselecteddata->hasGardener as $key=>$gardener)
                                    <tr class='gardener_row'>
                                        <td>
                                            <input type="text" id="gardener_name" name='gardener[{{ $key }}][gardener_name]' placeholder="Enter Name" class="form-control gardener_name" value="{{ $gardener->name }}">
                                        </td>
                                        <td>
                                            <input type="text" id='gardener_cnic' name='gardener[{{ $key }}][gardener_cnic]' placeholder="Enter CNIC No" class="form-control gardener_cnic" value="{{ $gardener->cnic_no }}">
                                        </td>
                                        <td>
                                            <input type="text" id='gardener_mobile' name='gardener[{{ $key }}][gardener_mobile]' placeholder="Enter Mobile No" class="form-control gardener_mobile" value="{{ $gardener->mobile_no }}">
                                        </td>
                                        <td>
                                            <input type="checkbox" id="gardener_security_clearance" name="gardener[{{ $key }}][gardener_security_clearance]" {{ $gardener->security_clearance==1?'checked':'' }} value="1">
                                            <label for="clearance">Security Clearance</label>
                                        </td>
                                        <td>
                                            <input type="checkbox" id="gardener_blacklist" name="gardener[{{ $key }}][gardener_blacklist]" {{ $gardener->blacklist==1?'checked':'' }} value="1">
                                            <label for="vehicle1" >blacklist</label>
                                        </td>
                                        <td class="text-center">
                                            <button type='button' class='btn btn-success gardeneraddMore' data-key="{{ $key }}"><i class="fa fa-plus"></i></button>
                                            <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class='gardener_row'>
                                    <td>
                                        <input type="text" id="gardener_name" name='gardener[0][gardener_name]' placeholder="Enter Name" class="form-control gardener_name">
                                    </td>
                                    <td>
                                        <input type="text" id='gardener_cnic' name='gardener[0][gardener_cnic]' placeholder="Enter CNIC No" class="form-control gardener_cnic">
                                    </td>
                                    <td>
                                        <input type="text" id='gardener_mobile' name='gardener[0][gardener_mobile]' placeholder="Enter Mobile No" class="form-control gardener_mobile">
                                    </td>
                                    <td>
                                        <input type="checkbox" id="gardener_security_clearance" name="gardener[0][gardener_security_clearance]" value="1">
                                        <label for="clearance">Security Clearance</label>
                                    </td>
                                    <td>
                                        <input type="checkbox" id="gardener_blacklist" name="gardener[0][gardener_blacklist]" value="1">
                                        <label for="vehicle1" >blacklist</label>
                                    </td>
                                    <td class="text-center">
                                        <button type='button' class='btn btn-success gardeneraddMore' data-key="0"><i class="fa fa-plus"></i></button>
                                        <button type='button' class='btn btn-danger delete'><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Save Data Button --}}
        <div class='row'>
            <div class="col-md-12">
                <div class="form-group">
                    @if(empty($alloteeselecteddata->hasWife) AND empty($alloteeselecteddata->hasChild) AND empty($alloteeselecteddata->hasMade) AND empty($alloteeselecteddata->hasDriver) AND empty($alloteeselecteddata->hasChef) AND empty($alloteeselecteddata->hasGardener) )
                        <button type="submit" class="btn btn-success next"><i class="fa fa-save"></i> Submit</button>
                    @else
                        <input type="hidden" name="form_status" value="update">
                        <button type="submit" class="btn btn-info next"><i class="fa fa-pencil"></i> Save Changes</button>
                    @endif
                </div>
            </div>
        </div>
        
    {!! Form::close() !!}
    
    <!-- Wife work -->
    <script>
       $(document).on('click', '.wifeaddMore', function(){
            var counter = $(this).attr('data-key');
            counter++;
            var new_tr  = $(this).closest(".wife_row").clone();

            //getting name attributes
            var wife_name = "wife["+counter+"][wife_name]";
            var wife_cnic = "wife["+counter+"][wife_cnic]";
            var wife_mobile = "wife["+counter+"][wife_mobile]";
            var wife_security_clearance = "wife["+counter+"][wife_security_clearance]";
            var wife_blacklist = "wife["+counter+"][wife_blacklist]";
            
            //setting name attributes
            new_tr.find('#wife_name').attr('name',wife_name).val('');
            new_tr.find('#wife_cnic').attr('name',wife_cnic).val('');
            new_tr.find('#wife_mobile').attr('name',wife_mobile).val('');
            new_tr.find('#wife_security_clearance').attr('name',wife_security_clearance).val('1');
            new_tr.find('#wife_blacklist').attr('name',wife_blacklist).val('1');
            $("#wife_tbody").append(new_tr);
        });
        $("body").on('click','.delete,.delete_tax',function(){
            $(this).closest('tr').remove();
        });
    </script>
    <!--End Wife work -->

    <!-- Children work -->
    <script>
        jQuery('#autoResizeTA').autogrow();
        $("body").on('click','.childrenaddMore',function(){
            var counter = $(this).attr('data-key');
            counter++;
            var new_tr  = $(this).closest(".children_row").clone();
            //getting name attributes
            var child_name = "children["+counter+"][child_name]";
            var child_age = "children["+counter+"][child_age]";
            var child_gender = "children["+counter+"][child_gender]";
            var child_security_clearance = "children["+counter+"][child_security_clearance]";
            var child_blacklist = "children["+counter+"][child_blacklist]";

            //setting name attributes
            new_tr.find('#child_name').attr('name',child_name).val('');
            new_tr.find('#child_age').attr('name',child_age).val('');
            new_tr.find('#child_gender').attr('name',child_gender).val('');
            new_tr.find('#child_security_clearance').attr('name',child_security_clearance).val('1');
            new_tr.find('#child_blacklist').attr('name',child_blacklist).val('1');

            $("#children_tbody").append(new_tr);
        });
        $("body").on('click','.delete,.delete_tax',function(){
            $(this).closest('tr').remove();
        });
    </script>
    <!--End Children work -->

    <!-- Start Made work -->
    <script>
        jQuery('#autoResizeTA').autogrow();
        $("body").on('click','.madeaddMore',function(){
            var counter = $(this).attr('data-key');
            counter++;
            var new_tr  = $(this).closest(".made_row").clone();
            //getting name attributes
            var made_name = "made["+counter+"][made_name]";
            var made_cnic = "made["+counter+"][made_cnic]";
            var made_mobile = "made["+counter+"][made_mobile]";
            var made_security_clearance = "made["+counter+"][made_security_clearance]";
            var made_blacklist = "made["+counter+"][made_blacklist]";

            //setting name attributes
            new_tr.find('#made_name').attr('name',made_name).val('');
            new_tr.find('#made_cnic').attr('name',made_cnic).val('');
            new_tr.find('#made_mobile').attr('name',made_mobile).val('');
            new_tr.find('#made_security_clearance').attr('name',made_security_clearance).val('1');
            new_tr.find('#made_blacklist').attr('name',made_blacklist).val('1');

            $("#made_tbody").append(new_tr);
        });
        $("body").on('click','.delete,.delete_tax',function(){
            $(this).closest('tr').remove();
        });
    </script>
    <!--End Made work -->

    <!-- Start Driver work -->
    <script>
        jQuery('#autoResizeTA').autogrow();
        $("body").on('click','.driveraddMore',function(){
            var counter = $(this).attr('data-key');
            counter++;
            var new_tr  = $(this).closest(".driver_row").clone();
            //getting name attributes
            var driver_name = "driver["+counter+"][driver_name]";
            var driver_cnic = "driver["+counter+"][driver_cnic]";
            var driver_mobile = "driver["+counter+"][driver_mobile]";
            var driver_security_clearance = "driver["+counter+"][driver_security_clearance]";
            var driver_blacklist = "driver["+counter+"][driver_blacklist]";

            //setting name attributes
            new_tr.find('#driver_name').attr('name',driver_name).val('');
            new_tr.find('#driver_cnic').attr('name',driver_cnic).val('');
            new_tr.find('#driver_mobile').attr('name',driver_mobile).val('');
            new_tr.find('#driver_security_clearance').attr('name',driver_security_clearance).val('1');
            new_tr.find('#driver_blacklist').attr('name',driver_blacklist).val('1');

            $("#driver_tbody").append(new_tr);
        });
        $("body").on('click','.delete,.delete_tax',function(){
            $(this).closest('tr').remove();
        });
    </script>
    <!--End Driver work -->

    <!-- Start Chef work -->
    <script>
        jQuery('#autoResizeTA').autogrow();
        $("body").on('click','.chefaddMore',function(){
            var counter = $(this).attr('data-key');
            counter++;
            var new_tr  = $(this).closest(".chef_row").clone();
            //getting name attributes
            var chef_name = "chef["+counter+"][chef_name]";
            var chef_cnic = "chef["+counter+"][chef_cnic]";
            var chef_mobile = "chef["+counter+"][chef_mobile]";
            var chef_security_clearance = "chef["+counter+"][chef_security_clearance]";
            var chef_blacklist = "chef["+counter+"][chef_blacklist]";

            //setting name attributes
            new_tr.find('#chef_name').attr('name',chef_name).val('');
            new_tr.find('#chef_cnic').attr('name',chef_cnic).val('');
            new_tr.find('#chef_mobile').attr('name',chef_mobile).val('');
            new_tr.find('#chef_security_clearance').attr('name',chef_security_clearance).val('1');
            new_tr.find('#chef_blacklist').attr('name',chef_blacklist).val('1');

            $("#chef_tbody").append(new_tr);
        });
        $("body").on('click','.delete,.delete_tax',function(){
            $(this).closest('tr').remove();
        });
    </script>
    <!--End Chef work -->

    <!-- Start Gardener work -->
    <script>
        jQuery('#autoResizeTA').autogrow();
        $("body").on('click','.gardeneraddMore',function(){
            var counter = $(this).attr('data-key');
            counter++;
            var new_tr  = $(this).closest(".gardener_row").clone();
            //getting name attributes
            var gardener_name = "gardener["+counter+"][gardener_name]";
            var gardener_cnic = "gardener["+counter+"][gardener_cnic]";
            var gardener_mobile = "gardener["+counter+"][gardener_mobile]";
            var gardener_security_clearance = "gardener["+counter+"][gardener_security_clearance]";
            var gardener_blacklist = "gardener["+counter+"][gardener_blacklist]";

            //setting name attributes
            new_tr.find('#gardener_name').attr('name',gardener_name).val('');
            new_tr.find('#gardener_cnic').attr('name',gardener_cnic).val('');
            new_tr.find('#gardener_mobile').attr('name',gardener_mobile).val('');
            new_tr.find('#gardener_security_clearance').attr('name',gardener_security_clearance).val('1');
            new_tr.find('#gardener_blacklist').attr('name',gardener_blacklist).val('1');

            $("#gardener_tbody").append(new_tr);
        });
        $("body").on('click','.delete,.delete_tax',function(){
            $(this).closest('tr').remove();
        });
    </script>
    <!--End Gardener work -->
@endsection