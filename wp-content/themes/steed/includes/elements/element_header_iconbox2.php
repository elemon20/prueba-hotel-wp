<?php
class steed_element_header_iconbox2{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	
	
	function __construct(){
		$this->customize_prefix = 'header_iconbox2_';
		$this->customize_section = 'steed_header_iconbox2';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="header_iconbox header_iconbox_2">';
				if(steed_theme_mod($this->customize_prefix.'font_icon') != ''){
					echo '<i class="fa fa-'.esc_attr(steed_theme_mod($this->customize_prefix.'font_icon')).'"></i>';
				}
				if(steed_theme_mod($this->customize_prefix.'image_icon') != ''){
					echo '<img src="'.esc_url(steed_theme_mod($this->customize_prefix.'link')).'" alt="'.wp_kses_post(steed_theme_mod($this->customize_prefix.'title')).'">';
				}
				echo '<a href="'.esc_url(steed_theme_mod($this->customize_prefix.'content')).'">';
					echo '<strong>'.wp_kses_post(steed_theme_mod($this->customize_prefix.'title')).'</strong>';
					echo '<span>'.wp_kses_post(steed_theme_mod($this->customize_prefix.'des')).'</span>';
				echo '</a>';
			echo'</div>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'IconBox #2', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		
		$uid = $this->customize_prefix.'title';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Title',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'text',
			'priority'   => 7,
		));	
		$uid = $this->customize_prefix.'des';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Description',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'text',
			'priority'   => 7,
		));	
		$uid = $this->customize_prefix.'link';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Link',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'text',
			'priority'   => 7,
		));	
	}
	
	public function css($css){
		$new_css = '';
		if(steed_theme_mod($this->customize_prefix.'text_color') != ''){
			$new_css .='.header_iconbox_2 a, .header_iconbox_2 strong{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'des_color') != ''){
			$new_css .='.header_iconbox_2 span{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'des_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'icon_color') != ''){
			$new_css .='.header_iconbox_2 i.fa{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'bg_color') != ''){
			$new_css .='.header_iconbox_2 i.fa{';
				 echo 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color')).';';
			$new_css .='}';
		 }

			if(steed_theme_mod($this->customize_prefix.'text_hover_color') != ''){
			$new_css .='.header_iconbox_2:hover a, .header_iconbox_1:hover strong{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_hover_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'des_hover_color') != ''){
			$new_css .='.header_iconbox_2:hover span{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'des_hover_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'icon_hover_color') != ''){
			$new_css .='.header_iconbox_2:hover i.fa{';
				 echo 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_hover_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'bg_color') != ''){
			$new_css .='.header_iconbox_2:hover i.fa{';
				 echo 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color')).';';
			$new_css .='}';
		 }
		return $css.$new_css;
	}
}
$GLOBALS['steed_element_header_iconbox2'] = new steed_element_header_iconbox2;
function steed_element_header_iconbox2(){
	$GLOBALS['steed_element_header_iconbox2']->html();
}