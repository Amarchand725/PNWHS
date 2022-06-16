@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Contractor.update', $model->id],
    'files' => 'true'
]) !!}

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>
            <h4 class="panel-title">Update Contractor</h4>
        </div>
        <input type='hidden' name='oldimage' value='{{$model->image}}' />
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label("name", "Name:", ["class" => "control-label"]) !!}
                        {!! Form::text("name", null, ["class" => "form-control"]) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("mobile_no", "Mobile Number:", ["class" => "control-label"]) !!}
                        {!! Form::text("mobile_no", null, ["class" => "form-control"]) !!}
                    </div>
                </div>
            
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label("email", "Email:", ["class" => "control-label"]) !!}
                        {!! Form::text("email", null, ["class" => "form-control"]) !!}
                    </div>
                </div>
           
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label("description", "Description:", ["class" => "control-label"]) !!}
                        {!! Form::textarea("description", null, ["class" => "form-control" , 'cols' => "2" , "rows" => "4"]) !!}
                    </div>
                </div>
           
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label("Address", "Address:", ["class" => "control-label"]) !!}
                        {!! Form::textarea("address", null, ["class" => "form-control" , 'cols' => "2" , "rows" => "4"]) !!}
                    </div>
                </div>

                @if(!empty($model->image))
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            
                                <div class='col-md-4'>
                                    <a href='<?= url('public/attachment/'.$model->image); ?>'>
                                        <img class='img-responsive img-thumbnail' style='width:100%;height:170px;' src='<?= url('public/attachment/'.$model->image); ?>' />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <span>No Found Logo</span>
                @endif

                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        {!! Form::label("image", "Images:", ["class" => "control-label"]) !!}
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
           </div>
        
        <div class="panel-footer">
            <div class="form-group">
                {!! Form::submit('Update Users', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>





{!! Form::close() !!}
<script>
$(document).ready(function(){
$('.switch').change(function(){
    if ($('#passwordcheck').is(':checked')) {
        $('.pass').removeAttr('readonly');
    }
    else{
        $(".pass").attr("readonly",'readonly');
    }
});
});
</script>
 <script>
$(document).ready(function(){
  $("#currentpassword").blur(function(){
	  //var json={};
	var currentpassword = $('#currentpassword').val();
	var user_id = $('#userid').val();
	        var CSRF_TOKEN = $("meta[name='csrf-token']").attr('content');
	        $.ajax({
	            type: "POST",
	            url: "<?php echo url('Users/checkpass'); ?>",
	            data: {_token: CSRF_TOKEN,
                    currentpassword: currentpassword,
				user_id: user_id,
	        },
	        success: function(data){
	         if(data == 0){
					alert(data);
			 }
			 else{
				alert(data);
			 }
	        }
	    });
  });
});
</script>
@endsection






















