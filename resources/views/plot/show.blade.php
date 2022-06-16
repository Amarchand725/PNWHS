@extends('admin.master')
@section('content')
@include('flash_msgs')

{!! Form::open([

]) !!}

<div class='container'>
<div class='row'>
<?php
            $dataofjson =    json_decode($model->image); 
            ?>
              <?php foreach ($dataofjson as $key => $dataofjson) {
            ?>
            <div class='col-md-4'>
            <a href='<?= url('public/attachment/'.$dataofjson); ?>'>
 <img class='img-responsive img-thumbnail' style='width:100%;height:170px;' src='<?= url('public/attachment/'.$dataofjson); ?>' />
 </a>
 </div>
 
            <?php
            } ?>

</div>
</div>

            
          
           
           
@endsection