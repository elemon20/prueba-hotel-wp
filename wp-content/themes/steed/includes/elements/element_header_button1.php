<?php
class steed_element_header_button1{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	
	
	function __construct(){
		$this->customize_prefix = 'header_button1_';
		$this->customize_section = 'steed_header_button1';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<a class="header_button header_button_1" href="'.esc_url(steed_theme_mod($this->customize_prefix.'link')).'">';
			
				if( steed_theme_mod($this->customize_prefix.'image_icon') != ''){
					echo '<img src="'.esc_url(steed_theme_mod($this->customize_prefix.'image_icon')).'" alt="">';
				}elseif( steed_theme_mod($this->customize_prefix.'font_icon') != ''){
					echo '<i class="fa fa-'.esc_attr(steed_theme_mod($this->customize_prefix.'font_icon')).'"></i>';
				}
				echo '<span>'.esc_attr(steed_theme_mod($this->customize_prefix.'text')).'</span>';
			echo'</a>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Header Button', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		
		$uid = $this->customize_prefix.'text';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Button Text',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'text',
			'priority'   => 7,
		));	
		$uid = $this->customize_prefix.'link';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Button Link',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'text',
			'priority'   => 7,
		));	
	}
	
	public function css($css){
		$new_css = '';
		if(steed_theme_mod($this->customize_prefix.'active')){
			$new_css .='.header_button_1{';
				if(steed_theme_mod($this->customize_prefix.'text_color') != ''){
					echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_color')).';';
				}
				if(steed_theme_mod($this->customize_prefix.'bg_color') != ''){
					echo 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color')).';';
				}
				if(steed_theme_mod($this->customize_prefix.'border_color') != ''){
					echo 'border-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'border_color')).';';
				}
				if(steed_theme_mod($this->customize_prefix.'radius') != ''){
					echo 'border-radius:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'radius')).';';
				}
				if(steed_theme_mod($this->customize_prefix.'font_size') != ''){
					echo 'font-size:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'font_size')).';';
				}
				if(steed_theme_mod($this->customize_prefix.'padding') != ''){
					echo 'padding:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'padding')).';';
				}
			$new_css .='}';


			$new_css .='.header_button_1:hover{';
				 if(steed_theme_mod($this->customize_prefix.'text_hover_color') != ''){
					echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_hover_color')).';';
				}
				if(steed_theme_mod($this->customize_prefix.'bg_hover_color') != ''){
					echo 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_hover_color')).';';
				}
				if(steed_theme_mod($this->customize_prefix.'border_color') != ''){
					echo 'border-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'border_hover_color')).';';
				}
			$new_css .='}';
		 }
		
		return $css.$new_css;
	}
}
$GLOBALS['steed_element_header_button1'] = new steed_element_header_button1;
function steed_element_header_button1(){
	$GLOBALS['steed_element_header_button1']->html();
}