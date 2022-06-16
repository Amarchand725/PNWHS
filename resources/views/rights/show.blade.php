@extends('admin.master')
@section('content')

<div class="panel panel-dark">
    <div class="panel-heading">
        <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
        </div>
        <h4 class="panel-title">User Rights Details</h4>
    </div>
    <table class="table table-bordered">
        <tbody>
            <tr><th>Name</th><td>{{$model->name}}</td></tr>
            <tr><th>Description</th><td>{{!empty($model->description) ? $model->description : "-"}}</td></tr>
            <tr><th>Date</th><td>{{date('l jS F Y', strtotime($model->created_at))}}</td></tr>    
        </tbody>
    </table>
</div>

@endsection