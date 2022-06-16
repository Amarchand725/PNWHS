@foreach($models as $model)
<p>
       						<a href="{{ route('PaymentPolicy.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('PaymentPolicy.edit', $model->id) }}" class="btn btn-primary">{{$model->rank_id}}</a>
    				 </p><p>
       						<a href="{{ route('PaymentPolicy.edit', $model->id) }}" class="btn btn-primary">{{$model->registration_payment}}</a>
    				 </p><p>
       						<a href="{{ route('PaymentPolicy.edit', $model->id) }}" class="btn btn-primary">{{$model->monthly_instalment}}</a>
    				 </p><p>
       						<a href="{{ route('PaymentPolicy.edit', $model->id) }}" class="btn btn-primary">{{$model->effective_date}}</a>
    				 </p><p>
       						<a href="{{ route('PaymentPolicy.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('PaymentPolicy.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}