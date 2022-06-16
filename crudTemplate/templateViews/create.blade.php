@extends('admin.master')
@section('content')
@include('flash_msgs')
 
{!! Form::open([
    'route' => '{modelName}.store'
]) !!}


{searchForm}

{!! Form::close() !!}

@endsection