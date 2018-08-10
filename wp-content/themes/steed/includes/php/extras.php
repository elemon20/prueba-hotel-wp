<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Steed
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function steed_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'steed_body_classes' );



if ( ! function_exists( 'steed_fonts' ) ) :
	function steed_fonts(){
		
		$fonts = array();
		$new_fonts = array();
		
		/* #0 Heading Font */
		$fonts[] = 'Arvo:400,400i,700,700i';
	
		/* #1 Menu Font */
		$fonts[] = 'PT+Sans:400,400i,700,700i';
	
		/* #2 Body Font */
		$fonts[] = 'PT+Sans:400,400i,700,700i';
		
		$std_fonts = apply_filters('steed_fonts', $fonts);
		
		$new_fonts[] = (steed_theme_mod('google_font_1') != '') ? esc_attr(steed_theme_mod('google_font_1')) : $std_fonts[0];
		$new_fonts[] = (steed_theme_mod('google_font_2') != '') ? esc_attr(steed_theme_mod('google_font_2')) : $std_fonts[1];
		$new_fonts[] = (steed_theme_mod('google_font_3') != '') ? esc_attr(steed_theme_mod('google_font_3')) : $std_fonts[2];
		
		return $new_fonts;
	}
endif;



if ( ! function_exists( 'steed_fonts_url' ) ) :
/**
 * Register Google fonts for Steed.
 *
 * Create your own steed_fonts_url() function to override in a child theme.
 *
 * @since Steed 2.0
 *
 * @return string Google fonts URL for the theme.
 * 
 * Code Source Twenty Sixteen Theme
 */
 
function steed_fonts_url() {
	$fonts_url = '';
	$subsets   = 'latin,latin-ext';
	$fonts = steed_fonts();

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' =>  implode( '|', $fonts),
			//'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url($fonts_url);
}
endif;


if(! function_exists( 'steed_fonts_style' ) ):
/**
 * Get Font style by font use
 *
 * Create your own steed_fonts_style() function to override in a child theme.
 *
 * @since Steed 2.0
 *
 */
	function steed_fonts_style($i){
		
		$fonts = steed_fonts();
		$font_string = NULL;
		$font_name = NULL;
		
		if(isset($fonts[$i])){
			$font_string = $fonts[$i];
		}
		
		if($font_string != NULL){
			$font_name = str_replace("+", " ", strstr($font_string, ':', true));
			if($font_name == ''){  
				$font_name = "'".str_replace("+", " ", $font_string)."', sans-serif";
			}else{
				$font_name = "'".str_replace("+", " ", strstr($font_string, ':', true))."', sans-serif";
			}
		}
		
		return sanitize_text_field($font_name);
	}
endif;


function steed_colors(){
	$std_colors = apply_filters('steed_colors', array(
		'primary'	=> '#1e73be',
		'primary_l'	=> '#288de6',
		'primary_d'	=> '#145690',
		'accent'	=> '#06bd27',
		'light'		=> '#ffffff',
		'dim_light'	=> '#bdbdbd',
		'dim_dark'	=> '#757575',
		'dark'		=> '#212121',
	));
	
	$primary	= (steed_theme_mod('primary_color') != '')	? sanitize_hex_color(steed_theme_mod('primary_color'))	: $std_colors['primary'];
	$primary_l	= (steed_theme_mod('primary_l_color') != '')	? sanitize_hex_color(steed_theme_mod('primary_l_color'))	: $std_colors['primary_l'];
	$primary_d	= (steed_theme_mod('primary_d_color') != '')	? sanitize_hex_color(steed_theme_mod('primary_d_color'))	: $std_colors['primary_d'];
	$accent		= (steed_theme_mod('accent_color') != '')		? sanitize_hex_color(steed_theme_mod('accent_color'))		: $std_colors['accent'];
	$light		= (steed_theme_mod('light_color') != '')		? sanitize_hex_color(steed_theme_mod('light_color'))		: $std_colors['light'];
	$dim_light	= (steed_theme_mod('dim_light_color') != '')	? sanitize_hex_color(steed_theme_mod('dim_light_color'))	: $std_colors['dim_light'];
	$dim_dark	= (steed_theme_mod('dim_dark_color') != '')	? sanitize_hex_color(steed_theme_mod('dim_dark_color'))	: $std_colors['dim_dark'];
	$dark		= (steed_theme_mod('dark_color') != '')		? sanitize_hex_color(steed_theme_mod('dark_color'))		: $std_colors['dark'];
	
	
	$colors = array(
		'primary'	=> $primary,
		'primary_l'	=> $primary_l,
		'primary_d'	=> $primary_d,
		'accent'	=> $accent,
		'light'		=> $light,
		'dim_light'	=> $dim_light,
		'dim_dark'	=> $dim_dark,
		'dark'		=> $dark,
	);
	
	return $colors;
}



if(! function_exists( 'steed_custom_css' ) ):
/**
 * Generate Dynamic CSS 
 *
 * Create your own steed_custom_css() function to override in a child theme.
 *
 * @since Steed 2.0
 *
 *@ use steed_colors filter to overwrite color code
 */

function steed_custom_css(){
	$colors = steed_colors();
	
	$primary_color = $colors['primary'];
	$primary_l_color = $colors['primary_l'];
	$primary_d_color = $colors['primary_d'];
	$accent_color = $colors['accent'];
	$light_color = $colors['light'];
	$dim_light_color = $colors['dim_light'];
	$dark_color = $colors['dark'];
	$dim_dark_color = $colors['dim_dark'];
	
	$css = '';
	
	/* Font */
	$css .= 'body{ font-family:'.steed_fonts_style(2).'; }';
	$css .= '.main-navigation, .main-navigation a{ font-family:'. steed_fonts_style(1).'; }';
	$css .= 'h1, h2, h3, h4, h5, h6{ font-family:'. steed_fonts_style(0).'; }';
	
	if(steed_theme_mod('h1_size') != '') { $css .= 'h1{ font-size:'. esc_attr(steed_theme_mod('h1_size')).' !important; }'; }
	if(steed_theme_mod('h2_size') != '') { $css .= 'h2{ font-size:'. esc_attr(steed_theme_mod('h2_size')).' !important; }'; }
	if(steed_theme_mod('h3_size') != '') { $css .= 'h3{ font-size:'. esc_attr(steed_theme_mod('h3_size')).' !important; }'; }
	if(steed_theme_mod('h4_size') != '') { $css .= 'h4{ font-size:'. esc_attr(steed_theme_mod('h4_size')).' !important; }'; }
	if(steed_theme_mod('h5_size') != '') { $css .= 'h5{ font-size:'. esc_attr(steed_theme_mod('h5_size')).' !important; }'; }
	if(steed_theme_mod('h6_size') != '') { $css .= 'h6{ font-size:'. esc_attr(steed_theme_mod('h6_size')).' !important; }'; }
	if(steed_theme_mod('body_font_size') != '') { $css .= 'body{ font-size:'. esc_attr(steed_theme_mod('body_font_size')).' !important; }'; }
	
	/* Primary & Accent */
	$css .= 'a{ color:'.$primary_color.'; }';
	$css .= 'a:hover{ color:'.$accent_color.'; }';
	$css .= '.widget_search input[type="submit"]{ background-color:'.$primary_color.';}';
	$css .= '.widget_search input[type="search"]{ border-color:'.$primary_color.'; }';
	$css .= '.widget_meta ul li:hover,
.widget_pages ul li:hover,
.widget_nav_menu ul li:hover,
.widget_recent_entries ul li:hover,
.widget_archive ul li:hover,
.widget_categories ul li:hover,
.widget_recent_comments ul li:hover{ color: '.$accent_color.'; }';

	$css .= '.element_button{ background-color:'.$primary_color.'; border-color:'.$primary_color.'; }';
	$css .= '.element_button:hover{ background-color:'.$primary_d_color.'; border-color:'.$primary_d_color.'; }';
	$css .= '.element_button.border_style{ color:'.$primary_color.';  }';
	$css .= '.element_button.border_style:hover{ background-color:'.$primary_color.'; }';
	
	$css .= 'body button, body input[type="button"], body input[type="reset"], body input[type="submit"]{ background-color:'.$primary_color.'; border-color:'.$primary_color.'; color:'.$light_color.'; }';
	$css .= 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover{ background-color:'.$primary_l_color.'; border-color:'.$primary_l_color.'; color:'.$light_color.'; }';
	
	
	/* Primary Class */
	$css .= 'html .pc_bg{ background-color:'.$primary_color.'; }';
	$css .= 'html .pc_bg_hover:hover{ background-color:'.$primary_color.'; }';
	$css .= 'html .pc_border{ border-color:'.$primary_color.'; }';
	$css .= 'html .pc_border_hover:hover{ border-color:'.$primary_color.'; }';
	$css .= 'html .pc_text{ color:'.$primary_color.'; }';
	$css .= 'html .pc_text_hover:hover{ color:'.$primary_color.'; }';
	
	/* Primary Dark Class */
	$css .= 'html .pdc_bg{ background-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_bg_hover:hover{ background-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_border{ border-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_border_hover:hover{ border-color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_text{ color:'.$primary_d_color.'; }';
	$css .= 'html .pdc_text_hover:hover{ color:'.$primary_d_color.'; }';
	
	/* Primary Light Class */
	$css .= 'html .plc_bg{ background-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_bg_hover:hover{ background-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_border{ border-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_border_hover:hover{ border-color:'.$primary_l_color.'; }';
	$css .= 'html .plc_text{ color:'.$primary_l_color.'; }';
	$css .= 'html .plc_text_hover:hover{ color:'.$primary_l_color.'; }';
	
	/* Accent Class */
	$css .= 'html .ac_bg{ background-color:'.$accent_color.'; }';
	$css .= 'html .ac_bg_hover:hover{ background-color:'.$accent_color.'; }';
	$css .= 'html .ac_border{ border-color:'.$accent_color.'; }';
	$css .= 'html .ac_border_hover:hover{ border-color:'.$accent_color.'; }';
	$css .= 'html .ac_text{ color:'.$accent_color.'; }';
	$css .= 'html .ac_text_hover:hover{ color:'.$accent_color.'; }';
	
	/* Light Class */
	$css .= 'html .lc_bg{ background-color:'.$light_color.'; }';
	$css .= 'html .lc_bg_hover:hover{ background-color:'.$light_color.'; }';
	$css .= 'html .lc_border{ border-color:'.$light_color.'; }';
	$css .= 'html .lc_border_hover:hover{ border-color:'.$light_color.'; }';
	$css .= 'html .lc_text{ color:'.$light_color.'; }';
	$css .= 'html .lc_text_hover:hover{ color:'.$light_color.'; }';
	
	/* Dim Light Class */
	$css .= 'html .dlc_bg{ background-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_bg_hover:hover{ background-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_border{ border-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_border_hover:hover{ border-color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_text{ color:'.$dim_light_color.'; }';
	$css .= 'html .dlc_text_hover:hover{ color:'.$dim_light_color.'; }';
	
	/* Dark Class */
	$css .= 'html .dc_bg{ background-color:'.$dark_color.'; }';
	$css .= 'html .dc_bg_hover:hover{ background-color:'.$dark_color.'; }';
	$css .= 'html .dc_border{ border-color:'.$dark_color.'; }';
	$css .= 'html .dc_border_hover:hover{ border-color:'.$dark_color.'; }';
	$css .= 'html .dc_text{ color:'.$dark_color.'; }';
	$css .= 'html .dc_text_hover:hover{ color:'.$dark_color.'; }';
	
	/* Dim Dark Class */
	$css .= 'html .ddc_bg{ background-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_bg_hover:hover{ background-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_border{ border-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_border_hover:hover{ border-color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_text{ color:'.$dim_dark_color.'; }';
	$css .= 'html .ddc_text_hover:hover{ color:'.$dim_dark_color.'; }';
	
	/* Dark Text */
	$css .= 'html .color-dark h1,html .color-dark h2,html .color-dark h3,html .color-dark h4,html .color-dark h5,html .color-dark h6{color:'.$dark_color.';}';
	$css .= 'html .color-dark{ color:'.$dark_color.'; }';
	$css .= 'html .color-dark{ border-color:'.$dim_light_color.'; }';
	
	/* Light Text */
	$css .= 'html .color-light h1, html .color-light h2, html .color-light h3, html .color-light h4, html .color-light h5, html .color-light h6{color:'.$light_color.';}';
	$css .= 'html .color-light{ color:'.$light_color.'; }';
	$css .= 'html .color-light{ border-color:'.$dim_dark_color.'; }';
	
	
	/* Button Color */
	$css .= '.pc-btn-fill-primary{ background-color:'.$primary_color.'; border-color:'.$primary_color.'; }';
	$css .= '.pc-btn-fill-primary:hover{ background-color:'.$primary_l_color.'; border-color:'.$primary_l_color.'; }';
	$css .= '.pc-btn-border-primary{ border-color:'.$primary_color.'; color:'.$primary_color.'; }';
	$css .= '.pc-btn-border-primary:hover{ background-color:'.$primary_color.'; border-color:'.$primary_color.'; }';

	return $css;
}
endif;



function steed_wp_kses($string){
		$my_allowed = wp_kses_allowed_html( 'post' );
	// iframe
		$my_allowed['iframe'] = array(
			'src'             => array(),
			'height'          => array(),
			'width'           => array(),
			'frameborder'     => array(),
			'allowfullscreen' => array(),
		);
		// form fields - input
		$my_allowed['input'] = array(
			'class' => array(),
			'id'    => array(),
			'name'  => array(),
			'value' => array(),
			'type'  => array(),
		);
		// select
		$my_allowed['select'] = array(
			'class'  => array(),
			'id'     => array(),
			'name'   => array(),
			'value'  => array(),
			'type'   => array(),
		);
		// select options
		$my_allowed['option'] = array(
			'selected' => array(),
		);
		// style
		$my_allowed['style'] = array(
			'types' => array(),
		);
		return wp_kses($string, $my_allowed);
	}