(function ( $ ) {
	 "use strict";
    $.fn.pc_toggle = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            active_class: "pc-active"
        }, options );
 
        // Greenify the collection based on the settings variable.
        $( this ).on( "click", function() {
			if($(this).hasClass(settings.active_class)){
				$(this).removeClass(settings.active_class);
				$(this).next().removeClass(settings.active_class);
				$(this).next().slideUp( "slow", function() {});
			}else{
				$(this).addClass(settings.active_class);
				$(this).next().addClass(settings.active_class);
				$(this).next().slideDown( "slow", function() {});
			}
		});
 
    };
 
}( jQuery ));


(function ( $ ) {
	 "use strict";
    $.fn.pc_accordion = function( options ) {
 
        // This is the easiest way to have default options.
        var settings = $.extend({
            // These are the defaults.
            active_class: "pc-active",
			hand: ".pc_accordion_hand",
        }, options );
 
        // Greenify the collection based on the settings variable.
        $( this ).on( "click", function() {			
			if($(this).hasClass(settings.active_class)){
				$(settings.hand).removeClass(settings.active_class);
				$(settings.hand).next().removeClass(settings.active_class);
				$(settings.hand).next().slideUp( "slow");
			}else{
				$(settings.hand).removeClass(settings.active_class);
				$(settings.hand).next().removeClass(settings.active_class);
				$(settings.hand).next().slideUp( "slow");
				
				$(this).addClass(settings.active_class);
				$(this).next().addClass(settings.active_class);
				$(this).next().slideDown( "slow");
			}
		});
 
    };
 
}( jQuery ));

(function ( $ ) {
	 "use strict";
	$.fn.pc_hover_color_effect = function() {
		return this.each( function() {
			var hover_color = $(this).attr("data-hover-color");
			var already_color = $(this).attr("data-already-color");
			$(this).hover(
				function() {
					$(this).css("color", hover_color);
					//alert('on');
				}, function() {
					$(this).css("color", already_color);
					//alert('off');
				}
			);
		});
	};
}( jQuery ));


(function ( $ ) {
	 "use strict";
	$.fn.customizee_hover_color_effect_helper = function(options) {
		// This is the easiest way to have default options.
        var settings = $.extend({
			newval: "",
        }, options );
		
		var already_color = $(this).css("color");
		$(this).addClass( "data-hover-color");
		$(this).attr( "data-already-color",  already_color);
		$(this).attr( "data-hover-color", settings.newval );
		$('.data-hover-color').pc_hover_color_effect();
	};
}( jQuery ));


jQuery(document).ready(function($) {
	"use strict";
	
	
	function pc_follow_height(){
		$( ".pc-follow-height" ).each(function( index ) {
			var get_height = $($(this).attr('data-follow')).outerHeight();
			$(this).css('min-height', get_height);
		});
	}
	
	function pc_follow_height_d(){
		var pc_window_width = $( window ).width();
		
		if(pc_window_width > 992){
			$( ".pc-follow-height-d" ).each(function( index ) {
				var get_height = $($(this).attr('data-follow')).outerHeight();
				$(this).css('min-height', get_height);
			});
		}else{
			$( ".pc-follow-height-d" ).each(function( index ) {
				$(this).css('min-height', 'auto');
			});
		}
	}
	
	function pc_follow_height_t(){
		var pc_window_width = $( window ).width();
		
		if(pc_window_width <= 992){
			$( ".pc-follow-height-t" ).each(function( index ) {
				var get_height = $($(this).attr('data-follow')).outerHeight();
				$(this).css('min-height', get_height);
			});
		}else{
			$( ".pc-follow-height-t" ).each(function( index ) {
				$(this).css('min-height', 'auto');
			});
		}
	}
	
	function pc_follow_height_m(){
		var pc_window_width = $( window ).width();
		
		if(pc_window_width <= 768){
			$( ".pc-follow-height-m" ).each(function( index ) {
				var get_height = $($(this).attr('data-follow')).outerHeight();
				$(this).css('min-height', get_height);
			});
		}else{
			$( ".pc-follow-height-m" ).each(function( index ) {
				$(this).css('min-height', 'auto');
			});
		}
	}
	
	
	
	
	
	function pc_bg_full(){
		var pc_window_width = $( window ).width();
		$( ".pc-bg-full" ).each(function( index ) {
			var alinement = $(this).attr('data-aline');
			var raw_size = $(this).attr('data-size');
			var size = '';
			if( raw_size === '3'){
				size = 4;
			}else if(raw_size === '4'){
				size = 3;
			}else if(raw_size === '6'){
				size = 2;
			}else if(raw_size === '8'){
				size = 1.5;
			}else if(raw_size === '9'){
				size = 1.3332;
			}else if(raw_size === '12'){
				size = 1;
			}
			
			if(pc_window_width < 992){
				size = 1;
			}
			
			
			var content_width = '';
			var get_margin = '';
			var get_width = '';
			
			
			if(size === 1){
				content_width = $($(this).attr('data-content')).outerWidth();
				get_margin = ( pc_window_width - +content_width ) / 2;
				get_width = (content_width / size) + (get_margin * 2);

				$(this).css('width', get_width);
				$(this).css('margin-right', -get_margin);
				$(this).css('margin-left', -get_margin);
			}else{
				content_width = $($(this).attr('data-content')).outerWidth();
				get_margin = ( pc_window_width - +content_width ) / 2;
				get_width = (content_width / size) + get_margin;
				
				$(this).css('width', get_width);
				if(alinement === 'left'){
					$(this).css('margin-left', -get_margin);
					$(this).css('margin-right', 0);
				}else if(alinement === 'right'){
					$(this).css('margin-right', -get_margin);
					$(this).css('margin-left', 0);
				}
			}
			
		});
	}

	
	pc_bg_full();
	pc_follow_height();
	pc_follow_height_d();
	pc_follow_height_t();
	pc_follow_height_m();
	
	$( window ).resize(function() {
	 	pc_bg_full();
		pc_follow_height();
		pc_follow_height_d();
		pc_follow_height_t();
		pc_follow_height_m();
	});
	
	
	
});