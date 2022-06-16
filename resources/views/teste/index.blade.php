@extends('admin.master')
@section('content')

 @include('Teste._search')
<div class='ajax_content'>
@foreach($models as $model)
<p>
       						<a href="{{ route('Teste.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('Teste.edit', $model->id) }}" class="btn btn-primary">{{$model->name}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>



 @include('ajax_pagination')
@endsection