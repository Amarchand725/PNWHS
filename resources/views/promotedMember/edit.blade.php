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
                        {!! Form::text("old_p_no", null, ["class" => "form-control",  "placeholder" => "Enter Old P/PJO No"]) !!}
                        <span id='error-reg_file_no' style='color:red'> {{ $errors->first('old_p_no') }}</span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("new_p_no", "New P/PJO No:", ["class" => "control-label"]) !!}
                        <span style='color:red'>*</span>
                        {!! Form::text("new_p_no", null, ["class" => "form-control",  "placeholder" => "Enter new P/PJO No"]) !!}
                        <span id='error-reg_file_no' style='color:red'> {{ $errors->first('new_p_no') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                @if(Auth::user()->hasRole->role=='Admin')
                    <div class="col-md-6">
                        <div class="form-group">
                            <!--{!! Form::label("", "Registration /File Number :", ["class" => "control-label"]) !!}-->
                            <!--|Last Allotted File Number: <b id='last_reg_file_no'></b>-->
                            {!! Form::label("file_registration_no", "Registration /File Number |Last Allotted File Number:", ["class" => "control-label"]) !!}
                            <span><b id='last_reg_file_no'></b></span>
                            <span style='color:red'>*</span>
                            {!! Form::number("file_registration_no", null, ["class" => "form-control", "id" => "reg_file_no", "placeholder" => "Enter Registeration File No"]) !!}
                            <span id='error-reg_file_no' style='color:red'> {{ $errors->first('reg_file_no') }}</span>
                        </div>
                    </div>
                @endif
                <div class="col-sm-3">
                    <br />
                    <div class="form-check">
                        @if($model->soldier=="civilian")
                            <input class="form-check-input" type="radio" name="soldier" id="civilian" value="civilian" checked>
                        @else
                            <input class="form-check-input" type="radio" name="soldier" id="civilian" value="civilian">
                        @endif
                        <label class="form-check-label" for="civilian">
                            Civilian
                        </label>
                    </div>
                    <div class="form-check">
                        @if($model->soldier=="uniform")
                            <input class="form-check-input" type="radio" name="soldier" id="uniform" value="uniform" checked>
                        @else
                            <input class="form-check-input" type="radio" name="soldier" id="uniform" value="uniform">
                        @endif
                        <label class="form-check-label" for="uniform">
                            Uniform
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("promoted_rank_id", "Promoted To Rank:", ["class" => "control-label"]) !!}
                        <span style='color:red'>*</span>
                        {!! Form::select("promoted_rank_id", $ranks, null, ["class" => "form-control", "id" => "rank-rate", "placeholder" => "Select promoted rank"]) !!}
                        <span id='error-reg_file_no' style='color:red'> {{ $errors->first('promoted_rank_id') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    {!! Form::label("rank_rate", "Rank/Rate", ["class" => "control-label"]) !!}
                    <small>(for example MCPO/WTR, FCPO(CHEF), Assistant)</small>
                    <span style='color:red'>*</span>
                    {!! Form::text("rank_rate", null, ["class" => "form-control", "placeholder" => "Enter Rank/Rate/Designation"]) !!}
                    <span style='color:red'> {{ $errors->first('rank_rate') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::label("d_o_sod", "Date of SOD:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                        <input type="text" class='form-control' name='d_o_sod' value='{{ $model->d_o_sod }}' id='d_o_sod_date'>
                        <span style='color:red'> {{ $errors->first('d_o_sod') }}</span>
                    </div>
                </div>

                <div class="col-md-6 uniform-input">
                    {!! Form::label("d_o_sos", "Date of SOS:", ["class" => "control-label"]) !!}
                    <small><b>(to be calculated form date of completion of probationary period)</b></small>
                    <div class="form-group">
                        <input type="text" class='form-control' value='{{ $model->d_o_sos }}' name='d_o_sos'
                            id='d_o_sos_date'>
                        <span style='color:red' id='error-sos'> {{ $errors->first('d_o_sos') }}</span>
                    </div>
                </div>
                <div class="col-md-6 civilian-input">
                    {!! Form::label("d_o_s", "Date of Superannuation age:", ["class" => "control-label"]) !!}
                    <small><b>(for Navy Civilians)</b></small>
                    <div class="form-group">
                        <input type="text" class='form-control' value='{{ $model->d_o_s }}' name='d_o_s'
                            id='d_o_s_date'>
                        <span style='color:red' id='error-dos'> {{ $errors->first('d_o_s') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    {!! Form::label("d_o_p", "Date of Promotion to Present Rank:", ["class" => "control-label"]) !!}
                    <span style='color:red'>*</span>
                    <div class="form-group">
                        <input type="text" class='form-control' name='d_o_p' value='{{ $model->d_o_p }}' id='d_o_p_date'>
                        <span style='color:red'> {{ $errors->first('d_o_p') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("gross_salary", "Gross Salary:", ["class" => "control-label"]) !!}
                        {!! Form::number("gross_salary", null, ["class" => "form-control", "placeholder" => "Enter Gross Salary"]) !!}
                        <span style='color:red'> {{ $errors->first('Salary') }}</span>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-sm-6">
                    <div class='form-group'>{!! Form::submit('Update PromotedMember', ['class' => 'btn btn-primary']) !!}</div>
                </div>
            </div>
        </div>
	</div>

    <script>
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

        //Civilian & Uniform
        var soldier_val = $("input[type=radio][name='soldier']:checked").val();
        if (soldier_val == 'civilian') {
            $('.uniform-input').hide();
            $('.civilian-input').show();
        }
        else if (soldier_val == 'uniform') {
            $('.uniform-input').show();
            $('.civilian-input').hide();
        }
     });

    //Civilian & Uniform
    $('input[type=radio][name=soldier]').change(function() {
        if (this.value == 'civilian') {
            $('.uniform-input').hide();
            $('.civilian-input').show();
            var date_sod = $('#d_o_s_date').val();
            if(date_sod==''){
                $('#error-dos').html('Please enter "Date of Superannuation age"');
                $('#error-sos').html('');
            }else{
                $('#error-dos').html('');
            }
        }
        else if (this.value == 'uniform') {
            $('.uniform-input').show();
            $('.civilian-input').hide();
            var date_sos = $('#d_o_sos_date').val();
            if(date_sos==''){
                $('#error-sos').html('Please enter "Date of SOS"');
                $('#error-dos').html('');
            }else{
                $('#error-sos').html('');
            }

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
