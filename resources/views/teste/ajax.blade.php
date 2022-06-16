@foreach($models as $model)
<p>
       						<a href="{{ route('Teste.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('Teste.edit', $model->id) }}" class="btn btn-primary">{{$model->name}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}