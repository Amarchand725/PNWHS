{{ Form::open(array('url' => 'search', 'method' => 'get')) }}
    <div class="row">
        <input type="hidden" name='report' value='project_financial_report'>
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
                {!! Form::label("rank", "Rank:", ["class" => "control-label"]) !!}
                {!! Form::select("rank", $ranks, null, ["class" => "form-control", "placeholder" => "Search by Rank"]) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label("account_of", "Account Of:", ["class" => "control-label"]) !!}
                {!! Form::select("account_of", ['shaheed'=>'Shaheed', 'medical'=>'Medical', 'amount_percent'=>'Amount Percent'], null, ["class" => "form-control", "placeholder" => "Search by Alloted Account of."]) !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {!! Form::label("house_no", "House No:", ["class" => "control-label"]) !!}
                {!! Form::number("house_no", null, ["class" => "form-control", "placeholder" => "Search by House"]) !!}
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


