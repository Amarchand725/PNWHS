@foreach($models as $model)
<p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->id}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->first_Name}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->email}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->password}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->user_type}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->user_of}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->created_by}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->remember_token}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->created_at}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->updated_at}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->dob}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->lastName}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->mobile}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->username}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->annual_leaves}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->active}}</a>
    				 </p><p>
       						<a href="{{ route('User.edit', $model->id) }}" class="btn btn-primary">{{$model->company}}</a>
    				 </p><hr>
    <hr>
@endforeach
{{ $models->appends($_GET)->links() }}