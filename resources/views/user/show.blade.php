@extends('admin.master')
@section('content')
@include('flash_msgs')

<div class="panel panel-dark">
    <div class="panel-heading">
        <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
        </div>
        <h4 class="panel-title">User Details</h4>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr><td>First name</td><td>{{$model->first_name}}</td></tr>
            <tr><td>Last name</td><td>{{$model->last_name}}</td></tr>
            <tr><td>Username</td><td>{{$model->user_name}}</td></tr>
            <tr><td>Email</td><td>{{$model->email}}</td></tr>
            <tr><td>Mobile</td><td>{{$model->mobile_no}}</td></tr>
            <tr><td>Phone</td><td>{{$model->phone}}</td></tr>
            <tr><td>User Type</td><td>{{!empty($model->userType->name) ? $model->userType->name : 'Super Admin' }}</td></tr>           
        </tbody>
    </table>
</div>

@endsection