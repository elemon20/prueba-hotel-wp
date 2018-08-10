<?php
class steed_element_div_style_main_menu{
	public $customize_prefix;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'main_menu_style_';
		$this->customize_section = 'steed_main_menu';
		$this->style_class = '#mavigation-holder';
		
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'customize_register', array($this, 'customize') );

	}	
	
	public function css($css){
		$new_css = $this->style_class.'{';
			if( steed_theme_mod($this->customize_prefix.'bg_color') != '' ){ 
				$new_css .= 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_image') != '' ){ 
				$new_css .= 'background-image:url('.esc_url(steed_theme_mod($this->customize_prefix.'bg_image')).');'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_size') != '' ){ 
				$new_css .= 'background-size:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_size')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_position') != '' ){ 
				$new_css .= 'background-position:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_position')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_attachment') != '' ){ 
				$new_css .= 'background-attachment:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_attachment')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_repeat') != '' ){ 
				$new_css .= 'background-repeat:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_repeat')).';'; 
			}
		$new_css .= '}';
		
		
		return $css.$new_css;
	}
	
	
	
	function customize($wp_customize){
		
		/*_----------
		background
		_
		----------------*/
		$uid = $this->customize_prefix.'bg_header';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
			'label'      => 'Background',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => 'Menu Area Background style',
			'priority'   => 7,
		)));
		
		$uid = $this->customize_prefix.'bg_image';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $uid, array(
			'label'      => __('Background Image', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'priority'   => 7,
		)));

		
	}
}
new steed_element_div_style_main_menu;