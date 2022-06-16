@extends('admin.master')
@section('content')
 @include('flash_msgs')

{!! Form::model($model, [
    'method' => 'PATCH',
    'route' => ['Userroles.update', $model->id]
]) !!}



 <div class="col-md-12">
     <div class="panel panel-default">
         <div class="panel-heading">
             <div class="panel-btns">
                 <a href="" class="panel-close">&times;</a>
                 <a href="" class="minimize">&minus;</a>
             </div>
             <h4 class="panel-title">User Role Update</h4>

         </div>
         <div class="panel-body">
             <div class="row">
                 <div class="col-sm-6">
                     <div class="form-group">
                         {!! Form::label("role", "Role:", ["class" => "control-label"]) !!}
                         {!! Form::text("role", null, ["class" => "form-control"]) !!}</div>
                 </div><!-- col-sm-6 -->
             </div><!-- row -->

             

             

         </div><!-- panel-body -->
         <div class="panel-footer">
             <div class='form-group'>{!! Form::submit('Update account', ['class' => 'btn btn-primary']) !!}</div>
         </div>
     </div>
 </div>

<script>
    $("#account_type").change(function(e){
        e.preventDefault();
        selectaccounttype = $(this).val();
         CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $.ajax({

            type: "POST",
            url: "<?php echo url('Account/AccountTypeDependedDropdown'); ?>",
            data: {_token: CSRF_TOKEN,
                selectaccounttype: selectaccounttype
            },
            success: function(data){
                //alert(data);
                $('.parent_acc').html(data);
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });

</script>









{!! Form::close() !!}
    @endsection


