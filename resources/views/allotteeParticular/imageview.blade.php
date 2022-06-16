@extends('admin.master')
@section('content')

<style>
	img {

}

img:hover {
  filter: none; /* IE6-9 */
  -webkit-filter: grayscale(0); /* Google Chrome, Safari 6+ & Opera 15+ */
 
}
</style>

	<div class="row">
    @foreach($jsondata as $image)
    <a href="{{url('/')}}/public/attachment/{{$image}}" target="_blank" class='photoday'>
		<div class="col-md-4 col-sm-12 col-xs-12"><img class="img-responsive img-thumbnail"  src="{{url('/')}}/public/attachment/{{$image}}" /></div>
       </a>
       @endforeach
    </div>




@endsection