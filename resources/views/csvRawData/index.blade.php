@extends('admin.master')
@section('content')

 @include('CsvRawData._search')
<div class='ajax_content'>
@foreach($models as $model)
<p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->csv_raw_file_id}}</a>
    				 </p><p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->p_no}}</a>
    				 </p><p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->rank}}</a>
    				 </p><p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->name}}</a>
    				 </p><p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->submitted_amount}}</a>
    				 </p><p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->date}}</a>
    				 </p><p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('CsvRawData.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>



 @include('ajax_pagination')
@endsection