{!! Form::model($formModel, [
    'route' => 'Construction.index',
    'method' => 'get'
]) !!}



<div class="row">
<div class="col-md-4">
      <div class="form-group">
					<?php  $constructor = DB::table('constructor')->pluck('name','id'); ?>
                        {!! Form::label("constructor", "Constructor:", ["class" => "control-label"]) !!}
                        {{ Form::select('constructor_id',$constructor, null, array('class' => 'form-control','placeholder' => 'Select Constructor (Builder)') ) }}
				</div>
                </div>
<br>
<div class="row">
    <div class="col-md-4">
<div class='form-group'>{!! Form::submit('Search', ['class' => 'btn btn-primary','name'=>'submit']) !!}</div>
    </div></div>

{!! Form::close() !!}


