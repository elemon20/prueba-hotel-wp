jQuery(document).ready(function ($) {
	function steed_Customize_Control_heading_tab(the_selector){
		var selector = the_selector+" .tabhand";
		var selector2 = the_selector+" .tab_all";
		var selector3 = the_selector+" .closeallitems";
		
		var b_all_ids_string = $(selector2).attr('data-all-tab');
		var b_all_ids = b_all_ids_string.split("|");
		$.each( b_all_ids, function( i, val ){
			$( val ).addClass('steed-hide');
			$( val ).addClass('steed-tab-item');
		});
		
		$( selector).on( "click", function(event) {
			event.preventDefault();
			var all_ids_string = $(this).attr('data-all-tab');
		  	var all_ids = all_ids_string.split("|");
			var this_ids_string = $(this).attr('data-tab');
			var this_ids = this_ids_string.split("|");
			$( selector ).removeClass('tabactive');
			$( this ).addClass('tabactive');
			$( selector3 ).text('x');
			$( selector3 ).addClass('tabactive');
			
			$.each( all_ids, function( i, val ){
				$( val ).addClass('steed-hide');
			});
			
			$.each( this_ids, function( i, val ){
				$( val ).removeClass('steed-hide');
			});
		});
		
		$( selector3 ).on( "click", function(event) {
			event.preventDefault();
			
			if($(this).hasClass('tabactive')){
				var all_ids_string = $(this).attr('data-all-tab');
				var all_ids = all_ids_string.split("|");
	
				$( selector ).removeClass('tabactive');
				$( this ).removeClass('tabactive');
				$( this ).text('+');
				
				$.each( all_ids, function( i, val ){
					$( val ).addClass('steed-hide');
				});
				
			}else{
				var this_ids_string = $(this).attr('data-tab');
				var this_ids = this_ids_string.split("|");
				$.each( this_ids, function( i, val ){
					$( val ).removeClass('steed-hide');
				});
				$( this ).addClass('tabactive');
				$( this ).text('x');
			}
			
		});
	}
	
	//steed_Customize_Control_heading_tab('#customize-control-steed_pc_home_page_services_grid_header');
	//steed_Customize_Control_heading_tab('#customize-control-steed_pc_home_page_services_item_style_header');
	//steed_Customize_Control_heading_tab('#customize-control-steed_pc_home_page_services_bg_header');
	
	
	$( ".steed_Customize_Control_heading.hastab" ).each(function( index ) {
		var the_div_id = '#'+$(this).parent('li').attr('id');
		//alert(the_div_id);
		steed_Customize_Control_heading_tab(the_div_id);
	});
});
