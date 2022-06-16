@foreach($models as $model)
<p>
       						<a href="{{ route('Plot.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('Plot.edit', $model->id) }}" class="btn btn-primary">{{$model->plot_no}}</a>
    				 </p><p>
       						<a href="{{ route('Plot.edit', $model->id) }}" class="btn btn-primary">{{$model->type}}</a>
    				 </p><p>
       						<a href="{{ route('Plot.edit', $model->id) }}" class="btn btn-primary">{{$model->size}}</a>
    				 </p><p>
       						<a href="{{ route('Plot.edit', $model->id) }}" class="btn btn-primary">{{$model->block}}</a>
    				 </p><p>
       						<a href="{{ route('Plot.edit', $model->id) }}" class="btn btn-primary">{{$model->amount}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}