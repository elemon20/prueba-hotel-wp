<?php
define('STEED_THEME_ID', 'steed-hotel');

add_filter('tallythemesetup_load_v2', '__return_true');

if(!function_exists('TheHotel_modify_theme_intro_page')){
	function TheHotel_modify_theme_intro_page($data){
		$data['menu_name'] = 'About Hotel';
		$data['page_name'] = 'About Hotel';
		$data['welcome_title'] = sprintf( __( 'Welcome to %s! - Version ', 'the-hotel' ), 'The Hotel' );
		$data['welcome_content'] = steed_theme_mod('theme_f_description');
		$data['support_content']['second']['button_link'] = esc_url(steed_theme_mod('theme_f_doc_url')); //Documentation Link
		$data['support_content']['sixth']['button_link'] = esc_url(steed_theme_mod('theme_f_doc_url')); //Documentation Link
		$data['getting_started']['second']['button_link'] = esc_url(steed_theme_mod('theme_f_doc_url')); //Documentation Link
		$data['free_pro']['free_theme_name'] = 'Hotel';
		$data['free_pro']['pro_theme_name'] = 'Hotel PRO';
		$data['free_pro']['pro_theme_link'] = esc_url(steed_theme_mod('theme_p_url')); // PRO Theme Link
		
		return $data;
	}
}
add_filter('steed_about_page_array', 'TheHotel_modify_theme_intro_page');




if(!function_exists('TheHotel_demo_data')){
	function TheHotel_demo_data(){
		return  array(
			'xml' => get_stylesheet_directory().'/includes/demo/content.xml', //xml file path or false to disable
			'widget' => get_stylesheet_directory().'/includes/demo/widgets.wie', //wie file path or false to disable
			'home' => 'Home (Free)',  //Name or false to disable
			'blog' => 'Blog', //Name or false to disable
			'menus' => array(/*array or false to disable*/
				array('title' => 'Primary (Free)', 'location' => 'header_menu'),
			),
			'revolution_sliders' => false, //array or false to disable
			'plugins' => array(/*array or false to disable*/
				'contact-form-7/wp-contact-form-7.php',
				'elementor/elementor.php',
			),
			'demo_url' => esc_url(steed_theme_mod('theme_f_demo_url')), //Extranal Demo URL
			'demo_image' => esc_url(get_stylesheet_directory().'/screenshot.png'), //Extranal Demo image URL
			'doc_url' => esc_url(steed_theme_mod('theme_f_doc_url')), //Documentation URL
		);
	}
}
add_filter('tallythemesetup_demo_data', 'TheHotel_demo_data');


if(!function_exists('TheHotel_tgm_plugins')){
	
	function TheHotel_tgm_plugins($plugins){
		$plugins = array();
		
		//FREE	
		$plugins[] = array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		);
		$plugins[] = array(
			'name'      => 'WC Responsive Video',
			'slug'      => 'wc-responsive-video',
			'required'  => false,
		);
		$plugins[] = array(
			'name'      => 'Tally Theme Setup',
			'slug'      => 'tally-theme-setup',
			'required'  => false,
		);
		$plugins[] = array(
			'name'      => 'Elementor',
			'slug'      => 'elementor',
			'required'  => false,
		);
		
		return $plugins;
	}
}
add_filter('steed_tgm_plugins', 'TheHotel_tgm_plugins');