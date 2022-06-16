@foreach($models as $model)
<p>
       						<a href="{{ route('HouseCost.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('HouseCost.edit', $model->id) }}" class="btn btn-primary">{{$model->initial_cost}}</a>
    				 </p><p>
       						<a href="{{ route('HouseCost.edit', $model->id) }}" class="btn btn-primary">{{$model->created_by}}</a>
    				 </p><p>
       						<a href="{{ route('HouseCost.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('HouseCost.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}