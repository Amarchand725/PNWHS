{{ Form::open(array('url' => 'eligibility_report', 'method' => 'get')) }}
    <div class="row">
        <input type="hidden" name='report' value='eligibility_report'>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label("p_no", "PJ No:", ["class" => "control-label"]) !!}
                {!! Form::number("p_no", null, ["class" => "form-control", "min" => "0", "placeholder" => "Search by PJ.No"]) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
                {!! Form::text("name", null, ["class" => "form-control", "placeholder" => "Search by Member Name"]) !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label("rank", "Grade:", ["class" => "control-label"]) !!}
                {!! Form::select("rank", $ranks, null, ["class" => "form-control", "placeholder" => "Search by grade"]) !!}
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


