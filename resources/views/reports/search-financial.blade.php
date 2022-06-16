{{ Form::open(array('url' => 'member_financial_report', 'method' => 'get')) }}
    <div class="row">
        <input type="hidden" name='report' value='member_financial_report'>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label("p_no", "PJ No:", ["class" => "control-label"]) !!}
                {!! Form::number("p_no", null, ["class" => "form-control", "min" => "0", "placeholder" => "Search by PJ.No"]) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
                {!! Form::text("name", null, ["class" => "form-control", "placeholder" => "Search by Member Name"]) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label("rank", "Grade:", ["class" => "control-label"]) !!}
                {!! Form::select("rank", $ranks, null, ["class" => "form-control", "placeholder" => "Search by grade"]) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label("ustatus", "Status:", ["class" => "control-label"]) !!}
                {!! Form::select("status", [1=>'Active', 0=>'Deactive'], null, ["class" => "form-control", "placeholder" => "Search by Active/Deactive"]) !!}
            </div>
        </div>
        <br />
        <div class="col-md-2">
            <div class='form-group'>
                {!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit','style' => 'margin-top: 7px;']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}


