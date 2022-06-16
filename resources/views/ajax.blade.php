@foreach($models as $model)
<p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->acc_id}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->acc_type}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->op_balance}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->op_bt}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->op_date}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->cl_blance}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->cl_bt}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->cl_date}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->admin_id}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->status}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}