{!! Form::model($formModel, [
    'route' => '.index',
    'method' => 'get'
]) !!}



<div class="form-group">
{!! Form::label("id", "Id:", ["class" => "control-label"]) !!}
{!! Form::text("id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("acc_id", "Acc_id:", ["class" => "control-label"]) !!}
{!! Form::text("acc_id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("acc_type", "Acc_type:", ["class" => "control-label"]) !!}
{!! Form::text("acc_type", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("op_balance", "Op_balance:", ["class" => "control-label"]) !!}
{!! Form::text("op_balance", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("op_bt", "Op_bt:", ["class" => "control-label"]) !!}
{!! Form::text("op_bt", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("op_date", "Op_date:", ["class" => "control-label"]) !!}
{!! Form::text("op_date", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("cl_blance", "Cl_blance:", ["class" => "control-label"]) !!}
{!! Form::text("cl_blance", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("cl_bt", "Cl_bt:", ["class" => "control-label"]) !!}
{!! Form::text("cl_bt", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("cl_date", "Cl_date:", ["class" => "control-label"]) !!}
{!! Form::text("cl_date", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("admin_id", "Admin_id:", ["class" => "control-label"]) !!}
{!! Form::text("admin_id", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("status", "Status:", ["class" => "control-label"]) !!}
{!! Form::text("status", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("created_at", "Created_at:", ["class" => "control-label"]) !!}
{!! Form::text("created_at", null, ["class" => "form-control"]) !!}</div>
<div class="form-group">
{!! Form::label("updated_at", "Updated_at:", ["class" => "control-label"]) !!}
{!! Form::text("updated_at", null, ["class" => "form-control"]) !!}</div>
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>


{!! Form::close() !!}