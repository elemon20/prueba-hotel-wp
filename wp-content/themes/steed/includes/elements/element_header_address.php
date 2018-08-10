<?php
class steed_element_header_address{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	
	
	function __construct(){
		$this->customize_prefix = 'header_address_';
		$this->customize_section = 'steed_header_address';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="header_address"><div class="footer_address_in">';
				if(steed_theme_mod($this->customize_prefix.'font_icon') != ''){
					echo '<div class="header_address_font_icon"><i class="fa fa-'.esc_attr(steed_theme_mod($this->customize_prefix.'font_icon')).'"></i></div>';
				}
				if(steed_theme_mod($this->customize_prefix.'image_icon') != ''){
					echo '<div class="header_address_img_icon"><img src="'.esc_url(steed_theme_mod($this->customize_prefix.'image_icon')).'" alt=""></div>';
				}
				echo '<div class="header_address_text">'.wp_kses_post(steed_theme_mod($this->customize_prefix.'content')).'</div>';
			echo'</div></div>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Header Address', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		
		$uid = $this->customize_prefix.'content';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Address Text',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'textarea',
			'priority'   => 7,
		));	
	}
	
	public function css($css){
		$new_css = '';
		if(steed_theme_mod($this->customize_prefix.'icon_color') != ''){
			$new_css .='.header_address_font_icon{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'text_color') != ''){
			$new_css .='.header_address_text{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_color')).';';
			$new_css .='}';
		 }
		
		return $css.$new_css;
	}
}
$GLOBALS['steed_element_header_address'] = new steed_element_header_address;
function steed_element_header_address(){
	$GLOBALS['steed_element_header_address']->html();
}