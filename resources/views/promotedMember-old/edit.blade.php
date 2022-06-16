@extends('admin.master')
@section('content')
@include('flash_msgs')

    <style>
        input[type=date], input[type=time], input[type=datetime-local], input[type=month] {
            line-height: 10px;
        }
    </style>

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['PromotedMember.update', $model->id]
]) !!}

    <div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">Promote Member</h4>                   
		</div>
		<div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    {!! Form::label("old_p_no", "Old P/PJO No:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    {!! Form::text("old_p_no", null, ["class" => "form-control", "required" => "required", "placeholder" => "Enter Old P/PJO No"]) !!}</div>
                    <span id='error-reg_file_no' style='color:red'> {{ $errors->first('old_p_no') }}</span>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    {!! Form::label("new_p_no", "New P/PJO No:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    {!! Form::text("new_p_no", null, ["class" => "form-control", "required" => "required", "placeholder" => "Enter new P/PJO No"]) !!}</div>
                    <span id='error-reg_file_no' style='color:red'> {{ $errors->first('new_p_no') }}</span>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("file_registration_no", "Registration /File Number :", ["class" => "control-label"]) !!}
                        <span style='color:red'>*</span>
                        {!! Form::number("file_registration_no", null, ["class" => "form-control", "id" => "file_registration_no", "required" => "required", "placeholder" => "Enter Registeration File No", 'required' => 'required']) !!}
                        <span id='error-file_registration_no' style='color:red'> {{ $errors->first('file_registration_no') }}</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <br />
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="soldier" id="civilian" value="civilian" {{ ($model->soldier=="civilian")? "checked" : "" }}>
                      <label class="form-check-label" for="civilian">
                        Civilian 
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="soldier" id="militry" value="militry" {{ ($model->soldier=="military")? "checked" : "" }}>
                      <label class="form-check-label" for="militry">
                        Military
                      </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("promoted_rank_id", "Promoted To Rank:", ["class" => "control-label"]) !!}
                        <span style='color:red'>*</span>
                        {!! Form::select("promoted_rank_id", $ranks, null, ["class" => "form-control" , "required" => "required", "required" => "required", "placeholder" => "Select promoted rank"]) !!}
                        <span id='error-reg_file_no' style='color:red'> {{ $errors->first('promoted_rank_id') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label("d_o_p", "Date of Promotion to Present Rank:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                        <input type="date" class='form-control' name='d_o_p' value='{{ $model->d_o_p }}' id='d_o_p' required>
                    </div>
                    <span style='color:red'> {{ $errors->first('d_o_p') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::label("d_o_sod", "Date of SOD:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                        <input type="date" class='form-control' name='d_o_sod' value='{{ $model->d_o_sod }}' id='d_o_sod' required>
                    </div>
                    <span style='color:red'> {{ $errors->first('d_o_sod') }}</span>
                </div>
            
                <div class="col-md-6 military-input" style='display:none'>
                    {!! Form::label("d_o_sos", "Date of SOS:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <small><b>(to be calculated form date of completion of probationary period)</b></small>
                    <div class="form-group">
                        <input type="date" class='form-control' name='d_o_sos' value='{{ $model->d_o_sos }}' id='d_o_sos' required>
                    </div>
                    <span style='color:red'> {{ $errors->first('d_o_sos') }}</span>
                </div>
                <div class="col-md-6 civilian-input">
                    {!! Form::label("d_o_s", "Date of Superannuation age:", ["class" => "control-label"]) !!}
                    <small><b>(for Navy Civilians)</b></small>
                    <span style='color:red'>*</span>
                    <div class="form-group">
                        <input type="date" class='form-control' name='d_o_s' value='{{ old("d_o_s") }}' id='d_o_s' required>
                    </div>
                    <span style='color:red'> {{ $errors->first('d_o_s') }}</span>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("gross_salary", "Gross Salary:", ["class" => "control-label"]) !!}
                        {!! Form::number("gross_salary", null, ["class" => "form-control", "placeholder" => "Enter Gross Salary"]) !!}
                    </div>
                    <span style='color:red'> {{ $errors->first('Salary') }}</span>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-sm-6">
                    <div class='form-group'>{!! Form::submit('Create New PromotedMember', ['class' => 'btn btn-primary']) !!}</div>
                </div>
            </div>
        </div>
	</div>

    <script>
        //Civilian & Military auto loaded
        $(document).ready(function(){
            var checked = $("input[type=radio][name='soldier']:checked").val();
            if (checked == 'civilian') {
                $('.military-input').hide();
                $('.civilian-input').show();
            }
            else if (checked == 'military') {
                $('.military-input').show();
                $('.civilian-input').hide();
            }
        });
        //Civilian & Military
        $('input[type=radio][name=soldier]').change(function() {
            if (this.value == 'civilian') {
                $('.military-input').hide();
                $('.civilian-input').show();
            }
            else if (this.value == 'militry') {
                $('.military-input').show();
                $('.civilian-input').hide();
            }
        });

        //Client side validation
        $('.promoted_member_form').validate({
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>

{!! Form::close() !!}

@endsection