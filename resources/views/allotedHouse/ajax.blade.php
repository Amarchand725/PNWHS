@foreach($models as $model)
<p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->p_no}}</a>
    				 </p><p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->allocated_house}}</a>
    				 </p><p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->allocated_account_of}}</a>
    				 </p><p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->house_dues_instalment}}</a>
    				 </p><p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->allocated_by}}</a>
    				 </p><p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('AllotedHouse.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}