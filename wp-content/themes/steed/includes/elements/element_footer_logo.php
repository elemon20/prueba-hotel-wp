<?php
class steed_element_footer_logo{
	public $customize_prefix;
	public $customize_section;
	
	
	function __construct(){
		$this->customize_prefix = 'footer_logo_';
		$this->customize_section = 'title_tagline';
		
		add_action( 'customize_register', array($this, 'customize') );
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="footer_logo"><a href="' . esc_url(home_url('/')) . '"><img src="'.esc_url(steed_theme_mod($this->customize_prefix.'url')).'" alt="'.get_bloginfo( 'name' ).'"</a></div>';
		}
	}
	
	function customize($wp_customize){
		
		if(steed_mal()){
			$uid = $this->customize_prefix.'active';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Enable Footer Logo', 'steed'),
				'section'    => $this->customize_section,
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
			));
		}
		$uid = $this->customize_prefix.'url';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $uid, array(
			'label'      => 'Footer Logo',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
		)));	
			
			
	}
}
$GLOBALS['steed_element_footer_logo'] = new steed_element_footer_logo;
function steed_element_footer_logo(){
	$GLOBALS['steed_element_footer_logo']->html();
}