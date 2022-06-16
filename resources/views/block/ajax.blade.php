@foreach($models as $model)
<p>
       						<a href="{{ route('Block.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('Block.edit', $model->id) }}" class="btn btn-primary">{{$model->name}}</a>
    				 </p><p>
       						<a href="{{ route('Block.edit', $model->id) }}" class="btn btn-primary">{{$model->description}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}