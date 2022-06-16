@extends('auth.masterlogin')
@section('signin')
    @include('flash_msgs')
    <div class="row">
        <div class="col-md-5 center">
            <h1 align="center"><span style="color: #1caf9a "></span><b> Register</b><span style="color: #1caf9a "></span></h1>
        </div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user_store') }}">
        @csrf
        <div class="form-group">
            <label for="p_no">P.NO <span style='color:red'>*</span></label>
            <input id="p_no" type="number" class="form-control" value="{{ old('p_no') }}" name="p_no" placeholder='Enter P.No'>
            <span style='color:red'>{{ $errors->first('p_no') }}</span>
        </div>
        <div class="form-group">
            <label for="p_no">Name <span style='color:red'>*</span></label>
            <input id="name" type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder='Enter Name'>
            <span style='color:red'>{{ $errors->first('name') }}</span>
        </div>
        <div class="form-group">
            <label for="cell">Cell <span style='color:red'>*</span></label>
            <input id="cell" type="text" maxlength="11" class="form-control cell" value="{{ old('cell') }}" name="cell" placeholder='03xxxxxxxxx'>
            <span style='color:red'>{{ $errors->first('cell') }}</span>
        </div>
        <div class="form-group">
            <label for="email">Password</label>
            <input id="password" type="password" class="form-control pword" name="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block"><i class='fa fa-submit'></i> Submit</button>
            <a class="btn btn-link" href="{{ url('/login') }}"><i class='fa fa-arrow-right'></i> Go to Login</a>
        </div>
    </form>
@endsection