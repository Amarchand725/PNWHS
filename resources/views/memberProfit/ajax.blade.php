@foreach($models as $model)
<p>
       						<a href="{{ route('MemberProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('MemberProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->rate}}</a>
    				 </p><p>
       						<a href="{{ route('MemberProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->effected_date}}</a>
    				 </p><p>
       						<a href="{{ route('MemberProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->status}}</a>
    				 </p><p>
       						<a href="{{ route('MemberProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->created_by}}</a>
    				 </p><p>
       						<a href="{{ route('MemberProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('MemberProfit.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}