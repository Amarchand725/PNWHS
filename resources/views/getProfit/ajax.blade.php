@foreach($models as $model)
<p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->profit_rate_id}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->p_no}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->account_of}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->paid_amount}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->profit_amount}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->total_amount}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('GetProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}