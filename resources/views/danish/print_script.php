
hide_element_classes = "<?php echo $data['hide_element_classes']; ?>";
	printable_area_id = "<?php echo $data['printable_area_id']; ?>";

	hide_classes = hide_element_classes.split(',');

	for(i=0;i<hide_classes.length;i++){
		
		$("."+hide_classes[i].trim()).css('display','none');
	}

		table = $("#"+printable_area_id).html();
			
		
		$("body").prepend("<div id='printable_div'></div>");
		$("#printable_div").html(table);
		$("#printable_div").css('display','block');
		
		window.print();

	setTimeout(function(){ 
			$("#printable_div").html('');
			for(i=0;i<hide_classes.length;i++){
			$("."+hide_classes[i].trim()).css('display','block');
			}
		   
			$("#printable_div").css('display','none');
			

	}, 1000);
	