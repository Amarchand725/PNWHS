@foreach($models as $model)
<p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->created_by}}</a>
    				 </p><p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->old_p_no}}</a>
    				 </p><p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->new_p_no}}</a>
    				 </p><p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->promoted_rank_id}}</a>
    				 </p><p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->promoted_date}}</a>
    				 </p><p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('PromotedMember.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}