<?php
class steed_element_div_style_content_warp{
	public $customize_prefix;
	public $customize_section;
	
	
	function __construct(){
		$this->customize_prefix = 'content_warp_style_';
		$this->customize_section = 'steed_content_area_style';
		
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'customize_register', array($this, 'customize') );
		
		add_filter('steed_content_area_color_mood', array($this, 'color_mood'));
	}	
	
	function color_mood(){
		return ' color-'.esc_attr(steed_theme_mod($this->customize_prefix.'color_mood'));
	}
	
	
	public function css($css){
		$new_css = '#content{';
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
			if( steed_theme_mod($this->customize_prefix.'padding_top') != '' ){ 
				$new_css .= 'padding-top:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'padding_top')).';';
			}
			if( steed_theme_mod($this->customize_prefix.'padding_bottom') != '' ){ 
				$new_css .= 'padding-bottom:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'padding_bottom')).';'; 
			}
		$new_css .= '}';
		
		if(( steed_theme_mod($this->customize_prefix.'padding_top_t') != '') || ( steed_theme_mod($this->customize_prefix.'padding_bottom_t') != '' ) ){
			$new_css .= '@media (max-width: 992px) {';
				$new_css .= '#content{';
					if( steed_theme_mod($this->customize_prefix.'padding_top_t') != '' ){ 
						$new_css .= 'padding-top:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'padding_top_t')).';';
					}
					if( steed_theme_mod($this->customize_prefix.'padding_bottom_t') != '' ){ 
						$new_css .= 'padding-bottom:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'padding_bottom_t')).';'; 
					}
				$new_css .= '}';
			$new_css .= '}';
		}
		
		if(( steed_theme_mod($this->customize_prefix.'padding_top_m') != '') || ( steed_theme_mod($this->customize_prefix.'padding_bottom_m') != '' ) ){
			$new_css .= '@media (max-width: 768px) {';
				$new_css .= '#content{';
					if( steed_theme_mod($this->customize_prefix.'padding_top_m') != '' ){ 
						$new_css .= 'padding-top:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'padding_top_m')).';'; 
					}
					if( steed_theme_mod($this->customize_prefix.'padding_bottom_m') != '' ){ 
						$new_css .= 'padding-bottom:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'padding_bottom_m')).';'; 
					}
				$new_css .= '}';
			$new_css .= '}';
		}
		
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
			'description' => 'Content area Background style',
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
new steed_element_div_style_content_warp;