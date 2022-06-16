@foreach($models as $model)
<p>
       						<a href="{{ route('CsvData.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('CsvData.edit', $model->id) }}" class="btn btn-primary">{{$model->csv_file_id}}</a>
    				 </p><p>
       						<a href="{{ route('CsvData.edit', $model->id) }}" class="btn btn-primary">{{$model->p_no}}</a>
    				 </p><p>
       						<a href="{{ route('CsvData.edit', $model->id) }}" class="btn btn-primary">{{$model->deducted_amount}}</a>
    				 </p><p>
       						<a href="{{ route('CsvData.edit', $model->id) }}" class="btn btn-primary">{{$model->deducted_date}}</a>
    				 </p><p>
       						<a href="{{ route('CsvData.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('CsvData.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}