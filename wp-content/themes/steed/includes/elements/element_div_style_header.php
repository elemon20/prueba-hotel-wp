<?php
class steed_element_div_style_header{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'header_style_';
		$this->customize_panel = 'site_header';
		$this->customize_section = 'steed_header_style';
		$this->style_class = '#masthead';
		
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'customize_register', array($this, 'customize') );
		
		add_filter('steed_header_color_mood', array($this, 'color_mood'));
	}	
	
	function color_mood(){
		if(steed_theme_mod($this->customize_prefix.'color_mood') != ''){
			return ' color-'.esc_attr(steed_theme_mod($this->customize_prefix.'color_mood'));
		}
	}
	
	
	public function css($css){
		$steed_colors = steed_colors();
		
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
		
		$new_css .= '.site-header.color-dark .site-title a{ color:'.$steed_colors['dark'].'; }';
		$new_css .= '.site-header.color-light .site-title a{ color:'.$steed_colors['light'].'; }';
		
		
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
			'description' => 'Header Background style',
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
new steed_element_div_style_header;