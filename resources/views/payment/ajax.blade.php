@foreach($models as $model)
<p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->p_no}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->amount_type}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->month}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->amount}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->year}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->created_by}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('Payment.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}