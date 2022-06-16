{!! Form::model($formModel, [
    'route' => 'CsvData.index',
    'method' => 'get'
]) !!}

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
        {!! Form::label("p_no", "P.No/PJO No:", ["class" => "control-label"]) !!}
        {!! Form::text("p_no", null, ["class" => "form-control", "placeholder" => "Search by P/PJO No"]) !!}</div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
        {!! Form::label("deducted_date", "Deducted Date:", ["class" => "control-label"]) !!}
        {!! Form::text("deducted_date", null, ["class" => "form-control", "placeholder" => "Search by Deducted Date"]) !!}</div>
    </div>
    <div class="col-sm-4">
        <div class='form-group'>
            <br />
            <button type="submit" class='btn btn-primary' style="margin-top: 5px;"><i class='fa fa-search'></i> Search</button>
        </div>   
    </div>
</div>

{!! Form::close() !!}