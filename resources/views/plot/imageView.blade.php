<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style>
	img {
  filter: gray; /* IE6-9 */
  -webkit-filter: grayscale(1); /* Google Chrome, Safari 6+ & Opera 15+ */
    -webkit-box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
    box-shadow: 0px 2px 6px 2px rgba(0,0,0,0.75);
    margin-bottom:20px;
}

img:hover {
  filter: none; /* IE6-9 */
  -webkit-filter: grayscale(0); /* Google Chrome, Safari 6+ & Opera 15+ */
 
}
</style>

<div class="container">
	<?php echo"<pre>"; print_r($model); die(); ?>
	<div class="row">
  <a href="#" class="photoday">
		<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive img-thumbnail" src="{{url('/')}}/public/attachment/$model->image" /></div>
    </a> 
    </div>
</div>
{{$model->image}}


