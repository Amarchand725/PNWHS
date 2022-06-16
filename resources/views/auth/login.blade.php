@extends('auth.masterlogin')
@section('signin')
@include('flash_msgs')
    <div class="row">
        <div class="col-md-5 center">
            <h1 align="center"><span style="color: #1caf9a "></span><b> LOGIN</b><span style="color: #1caf9a "></span></h1>
        </div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">Email / User Name / P.No</label>
            <input id="email" type="text" class="form-control uname" placeholder='Enter Email or User Name' name="email" >
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control pword" placeholder='Enter correct password' name="password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block">Login</button>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
            <!--<a class="btn btn-link" href="{{ url('/create_new_user') }}"><i class='fa fa-arrow-right'></i> Create New Account</a>-->
        </div>
    </form>
@endsection