@foreach($models as $model)
<p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->user_id}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->p_no}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->name}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->rank_rate}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->cnic_no}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->d_o_b}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->father_name}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->d_o_e}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->branch}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->d_o_c}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->d_o_p}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->d_o_sod}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->d_o_sos}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->total_service}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->d_o_s}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->tel_no}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->mob_no}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->email_address}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->status}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('AllotteeParticular.edit', $model->id) }}" class="btn btn-primary">{{$model->update_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}