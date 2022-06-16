@extends('admin.master')
@section('content')
@include('flash_msgs')

{!! Form::open([
    'route' => 'Feedback.store',
    'name' => 'feedbackform'
]) !!}


<div class="col-md-12">
    <div class="panel panel-dark">
        <div class="panel-heading">
            <h4 class="panel-title">Create Feedback</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        {!! Form::label("title", "Title:", ["class" => "control-label"]) !!}
                        {!! Form::text("title", null, ["class" => "form-control"]) !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    {!! Form::label("description", "Description:", ["class" => "control-label"]) !!}

                        <textarea id="description" name="description" class="form-control" placeholder="Feedback description" ></textarea>

                </div>
                </div>
            </div>


        </div>
        <div class="panel-footer">
            <div class="form-group">
                {!! Form::submit('Create New Feedback', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}
<script>

    $(function() {

    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='feedbackform']").validate({
        alert('pak');
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        title: "title",
        description: "description",
      },
      // Specify validation error messages
      messages: {
        title: "Please enter title",
        description: "Please enter description",

      },
      errorPlacement: function(error, element)
          {
              if ( element.is(":radio") )
              {
                  error.appendTo( element.parents('.form-group') );
              }
              else
              { // This is the default behavior
                  error.insertAfter( element );
              }
           },
      submitHandler: function(form) {

           form.submit();
           }

    });

    });

    </script>
@endsection
