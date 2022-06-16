@foreach($models as $model)
<p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->application_id}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->user_id}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->nex_of_kin}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->father_name_address}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->mother_name_address}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->present_address}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->permanent_address}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->status}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeDetailsOfKin.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}