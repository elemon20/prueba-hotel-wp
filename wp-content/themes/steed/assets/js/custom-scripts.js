/*
	Responsive Menu
------------------------------------------------------------------------*/
jQuery(document).ready(function($) {
	"use strict";
	
	var ph1_responsive_menu = $(".responsive-menu");
	
    function steed_build_responsive_nav_inner(){
		jQuery( "<i class='fa fa-plus'></i>" ).appendTo(".responsive-menu li.menu-item-has-children" );
		var ttes_menu_panels = $('.responsive-menu > ul li.menu-item-has-children ul.sub-menu').hide();
		
		$('.responsive-menu > ul li.menu-item-has-children i').on( "click", function() {
			if($(this).prev('ul.sub-menu, ul.children').hasClass('active')){
				$(this).prev('ul.sub-menu, ul.children').slideUp();
				$(this).prev('ul.sub-menu, ul.children').removeClass('active');
			}else{
				if(!$(this).parent().parent().hasClass('active')){
					ttes_menu_panels.slideUp();
					ttes_menu_panels.removeClass('active');
				}
				
				$(this).prev('ul.sub-menu, ul.children').slideDown();
				$(this).prev('ul.sub-menu, ul.children').addClass('active');
			}
			
			if($(this).hasClass('fa-plus')){
				$(this).removeClass('fa-plus');
				$(this).addClass('fa-minus');
			}else if($(this).hasClass('fa-minus')){
				$(this).removeClass('fa-minus');
				$(this).addClass('fa-plus');
			}
			return false;
		});
	}
    
	$('a.responsive-menu-hand').on( "click", function() {
		$( $(this).attr('href') ).clone().appendTo( ph1_responsive_menu );
		steed_build_responsive_nav_inner();
		
		if($(".responsive-menu").hasClass('active')){
			$(".responsive-menu").slideUp();
			$(".responsive-menu").removeClass('active');
			$(".responsive-menu ul").remove();
			$("body").removeClass('mobile-menu-active');
		}else{
			$(".responsive-menu").slideDown();
			$(".responsive-menu").addClass('active');
			$("body").addClass('mobile-menu-active');
		}
		return false;
	});
	
	$('a.responsive-menu-close').on( "click", function() {
		$(".responsive-menu").slideUp();
		$(".responsive-menu").removeClass('active');
		$(".responsive-menu ul").remove();
		$("body").removeClass('mobile-menu-active');
	});
	
	
});

/*
	Make the WordPress Gallery masonry
------------------------------------------------------------------------*/
jQuery(document).ready(function($) {
	"use strict";
	if(!$('body').hasClass('elementor-page')){
		var $container = $('.gallery');
		$container.imagesLoaded(function () {
			$container.masonry({
				itemSelector: '.gallery-item',
				animationOptions: {
					duration: 250,
					easing: 'linear',
					queue: false
				},
				fitWidth : true,
			});
		});
		
		$(window).resize(function () {		
			$container.masonry('layout');
		});
		
		$('.gallery-item a[href$=".gif"], .gallery-item a[href$=".jpg"], .gallery-item a[href$=".png"]').magnificPopup({type:'image'});
	}
	
});


/*	
	Register Lightbox by magnific-popup
------------------------------------------------------------------------*/
jQuery(document).ready(function($) {
	"use strict";
	
	$('.image-lightbox').magnificPopup({type:'image'});
	$('.video-lightbox').magnificPopup({type:'iframe'});
	$('.inline-lightbox').magnificPopup({type:'inline'});
	
	$('.image-lightbox-child').magnificPopup({type:'image'});
	$('.video-lightbox-child').magnificPopup({
		type:'iframe',
		delegate: 'a',
	});
	$('.inline-lightbox-child').magnificPopup({type:'inline'});
	
});