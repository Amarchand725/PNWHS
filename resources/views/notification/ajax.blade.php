@foreach($models as $model)
<p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->record_id}}</a>
    				 </p><p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->order_for}}</a>
    				 </p><p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->seen}}</a>
    				 </p><p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->seperate_view}}</a>
    				 </p><p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->title}}</a>
    				 </p><p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('Notification.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}