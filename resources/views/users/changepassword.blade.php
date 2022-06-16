@extends('admin.master')
@section('content')
    @include('flash_msgs')

    {!! Form::open([
        'url' => 'Users/storeChangePassword'.'/'.$id
    ]) !!}

    <div class="col-md-12">
        <div class="panel panel-dark">
            <div class="panel-heading">
                <h4 class="panel-title"><i class='fa fa-key'></i> Change Password</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label("password", "Old Password:", ["class" => "control-label"]) !!}
                            <input type="password" class="form-control" name="password" placeholder="Enter old password" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label("newpassword", "New Password:", ["class" => "control-label"]) !!}
                            <input type="password" class="form-control newpassword" name="newpassword" placeholder="Type new password" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label("retype", "Retype Password:", ["class" => "control-label"]) !!}
                            <input type="password" class="form-control retype" name="retype" placeholder=" Retype new password" required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="">
                    <div class="form-group">
                        {!! Form::submit('Change Password', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
<script>
$(document).ready(function(){

$('.retype').blur(function(){
   var newpassword =  $('.newpassword').val();
   var retype =  $(this).val();
   if(retype == newpassword){

   }
   else{
    alert('Please Put same password');
    $(this).val('');
    $('.newpassword').val('');
   }
});


});
</script>
@endsection