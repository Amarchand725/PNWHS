@foreach($models as $model)
<p>
       						<a href="{{ route('Rank.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('Rank.edit', $model->id) }}" class="btn btn-primary">{{$model->name}}</a>
    				 </p><p>
       						<a href="{{ route('Rank.edit', $model->id) }}" class="btn btn-primary">{{$model->status}}</a>
    				 </p><p>
       						<a href="{{ route('Rank.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('Rank.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}