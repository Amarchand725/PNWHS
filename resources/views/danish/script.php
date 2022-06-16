
<script>
//preventing anchor tag of pagination from changing/turning the page
$("body").on('click','.customPagination_All a',function(e){
			e.preventDefault();
});



//create div of class '.customPagination_All'
// pagination links click
$("body").on('click','.customPagination_All a',function(e){
	
	e.preventDefault();
	tbody =  $(this).parent().parent().prev().attr('data-tbody');	
	pagination_div = $(this).parent().parent().prev().attr('data-pagination');
	locationn = $(this).attr('href');
	page_needed = $(this).attr('data-page');
	t = $(this).attr('data-t'); // table name if needed , we are using here for condition
	

	// data-searched attribute created when using search , its value will be filled by searched word , on searching
	if($(this).attr('data-searched') != ''){
		searched_word = $(this).attr('data-searched');
	}else{
		searched_word = 'empty';
	}
	if($(this).attr('data-custom-form') != ''){
		custom_form = $(this).attr('data-custom-form');
	}else{
		custom_form = null;
	}
	if(locationn != null){
		
		calling_ajax( t , searched_word , tbody , pagination_div , page_needed , locationn ,custom_form);
		
	} // if loction is not null
	
	

	
});




/**** necessary data attributes on searched button ******/
//data-word
//data-tbody
//data-pagination
//data-t -> contains table name when dealing with multiple tables on same page , but we are handling multiple condition
$(".searchForWord-btn").click(function(){
	//word contains class name of text-filed 
	word =  $(this).attr('data-word') ;
	//tbody contains class name of target tbody
	tbody =  $(this).attr('data-tbody');	
        //pagination_div contains class name of target pagination div	
	pagination_div = $(this).attr('data-pagination');
        t = $(this).attr('data-t');
locationn = $(this).attr('data-url');


	searched_word = $('.'+word).val();

	if(searched_word.trim().length == 0){
		searched_word = 'empty';
	}
	
	
		
	calling_ajax( t , searched_word , tbody , pagination_div , null , locationn,null);	
	
	

	
});



function calling_ajax(t , searched_word , tbody , pagination_div , page_needed ,  locationn,custom_form){



$.ajax({ 
		type: "POST",
  
  
		url: locationn,
		data: {
		'custom_form':custom_form,	
		't':t,
		'page_needed':page_needed,
		'searchForWord':searched_word
		},
	  success: function(data_with_pagination){ 
	  //alert(data_with_pagination);
	 records = JSON.parse(data_with_pagination);
	 //alert(records.data);
	 //alert(records.pagination);
	 
	
	div_having_data_attributes = "<div class='hidden_div_having_data_attributes' style='display:none'  data-tbody='"+tbody+"' data-pagination='"+pagination_div+"' ></div>";
	  tbody_data = records.data;
	 // alert(tbody_data);
	  $('.'+tbody).html(tbody_data.toString());
	  $('.'+'<?php echo $data['pagination_class'];?>').html( div_having_data_attributes + records.pagination);
	  },
	  error: function(err){   
			  alert("failure "+err); } 
	});
}



</script>				

<script>

tbody = '<?php echo $data['tbody']?>';
pagination_div = '<?php  echo $data['pagination_class']?>';
t = '';
locationn = '<?php echo $data['url']; ?>';

 
calling_ajax(null , null , tbody , pagination_div , null ,  locationn,null);

</script>
<script>
$("#submit-custom-form").click(function(){
	
tbody = '<?php echo $data['tbody']?>';
pagination_div = '<?php echo  $data['pagination_class']?>';
custom_form = $('form.custom-search').serialize();
//alert(custom_form);
locationn = '<?php echo $data['url']; ?>';
//alert(t);
calling_ajax(t , null , tbody , pagination_div , null ,  locationn,custom_form);
return false;
});
</script>
<script>
$("#searchForWord-btn").attr('data-url','<?php echo $data['url']; ?>');
$("#searchForWord-btn").attr('data-tbody','<?php echo $data['tbody']; ?>');
$("#searchForWord-btn").attr('data-pagination','<?php echo $data['pagination_class']; ?>')
$("#searchForWord-btn").attr('data-word','<?php echo $data['class_for_search_btn']; ?>');

$("#searchForWord-input").addClass('<?php echo $data['class_for_search_btn'];?>');
</script>	
