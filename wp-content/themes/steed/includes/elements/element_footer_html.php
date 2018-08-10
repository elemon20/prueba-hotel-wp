<?php
class steed_element_footer_html{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'footer_html_';
		$this->customize_section = 'steed_footer_html';
		$this->customize_panel = 'site_Footer';
		
		add_action( 'customize_register', array($this, 'customize') );
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="footer_html"><div class="footer_html_in">'.wp_kses_post(steed_theme_mod($this->customize_prefix.'content')).'</div></div>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Custom Content', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		
		if(steed_mal()){
			$uid = $this->customize_prefix.'active';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
			$wp_customize->add_control( $uid, array(
				'label'      => __('Enable Custom HTML Content', 'steed'),
				'section'    => $this->customize_section,
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
			));
		}
		$uid = $this->customize_prefix.'content';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Custom HTML Content',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'textarea',
		));	
			
			
	}
}
$GLOBALS['steed_element_footer_html'] = new steed_element_footer_html;
function steed_element_footer_html(){
	$GLOBALS['steed_element_footer_html']->html();
}