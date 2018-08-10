<?php
class steed_element_footer_ads{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'footer_ads_';
		$this->customize_section = 'steed_footer_ads';
		$this->customize_panel = 'site_Footer';
		
		add_action( 'customize_register', array($this, 'customize') );
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="footer_ads"><div class="footer_ads_in">'.wp_kses_post(steed_theme_mod($this->customize_prefix.'content')).'</div></div>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Advertisement', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		
		if(steed_mal()){
			$uid = $this->customize_prefix.'active';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Enable Footer Advertisement', 'steed'),
				'section'    => $this->customize_section,
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
			));
		}
		$uid = $this->customize_prefix.'content';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Advertisement Code',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => 'Enter the full advertisement code here.',
			'type'       => 'textarea',
		));	
			
			
	}
}
$GLOBALS['steed_element_footer_ads'] = new steed_element_footer_ads;
function steed_element_footer_ads(){
	$GLOBALS['steed_element_footer_ads']->html();
}