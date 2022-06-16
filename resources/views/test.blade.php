@extends('admin.master')
@section('content')

<div id="datepicker"></div>

<p>Date: <input type="text" id="datepicker2" disabled></p>

<script type="text/javascript">
	$(function() {
  $('#datepicker').datepicker({
    onSelect: function(dateText) {
 $('#datepicker2').datepicker("setDate", $(this).datepicker("getDate"));
    }
  });
});

$(function() {
  $("#datepicker2").datepicker();
});
</script>
@endsection 