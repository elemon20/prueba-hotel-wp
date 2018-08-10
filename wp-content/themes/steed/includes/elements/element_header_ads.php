<?php
class steed_element_header_ads{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'header_ads_';
		$this->customize_section = 'steed_header_ads';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'content') == true){
			echo '<div class="header_ads"><div class="header_ads_in">'.wp_kses_post(steed_theme_mod($this->customize_prefix.'content')).'</div></div>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Advertisement', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		

		$uid = $this->customize_prefix.'content';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Advertisement Code',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => 'Enter the full advertisement code here.',
			'type'       => 'textarea',
			'priority'   => 7,
		));	
			
			
	}
}
$GLOBALS['steed_element_header_ads'] = new steed_element_header_ads;
function steed_element_header_ads(){
	$GLOBALS['steed_element_header_ads']->html();
}