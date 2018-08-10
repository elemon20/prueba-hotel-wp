<?php
class steed_element_header_logo{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	
	
	function __construct(){
		$this->customize_prefix = 'header_logo_';
		$this->customize_section = 'title_tagline';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
		
		add_theme_support( 'custom-logo', array(
			'height'      => esc_attr(steed_theme_mod($this->customize_prefix.'height'), 90), /* 70 */
			'width'       => esc_attr(steed_theme_mod($this->customize_prefix.'width'), 200), /* 240 */
			'flex-height' => true, //true, false
		));
	}	
	
	function html(){
		$output = '';
		$description = get_bloginfo( 'description', 'display' );
		
		// Try to retrieve the Custom Logo
		if (function_exists('get_custom_logo')){
			if(has_custom_logo()){
				$output = get_custom_logo();
			}
		}
	
		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
		if (empty($output)){
			if ( is_front_page() && is_home() ){
				$output = '<h1  class="site-title"><a href="' . esc_url(home_url('/')) . '">'.get_bloginfo( 'name' ).'</a></h1>';
			}else{
				$output = '<p  class="site-title"><a href="' . esc_url(home_url('/')) . '">'.get_bloginfo( 'name' ).'</a></p>';
			}
			if ( $description || is_customize_preview() ){
				$output .= '<p  class="site-description">'.$description.'</p>';
			}
		}
		
		/*Validating using wp_kses as the output contain images and h1 tags*/
		echo '<div class="header_logo">'.wp_kses($output, wp_kses_allowed_html( 'post' )).'</div>';
	}
	
	function customize($wp_customize){
		
		
		
	}
	
	public function css($css){
		$new_css = '';
			$new_css .='.header_logo{';
				 $new_css .= 'width:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'width')).';';
				 $new_css .= 'height:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'height')).';';
				 $new_css .= 'margin-top:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'margin_top')).'px;';
				 $new_css .= 'margin-bottom:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'margin_bottom')).'px;';
			$new_css .='}';

		return $css.$new_css;
	}

}
$GLOBALS['steed_element_header_logo'] = new steed_element_header_logo;
function steed_element_header_logo(){
	$GLOBALS['steed_element_header_logo']->html();
}