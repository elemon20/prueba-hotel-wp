<?php
class steed_element_footer_copy_text{
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'footer_copy_text';
		$this->customize_section = 'steed_footer_bar';
		
		add_action( 'customize_register', array($this, 'customize') );
	}	
	
	function html(){
		echo '<div class="footer_copy_text"><div class="footer_copy_text_in">'.wp_kses_post(steed_theme_mod('footer_copy_text')).'</div></div>';
	}
	
	function customize($wp_customize){

		$uid = 'footer_copy_text';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Copyright Text',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'textarea',
			'priority'   => 5,
		));	
			
			
	}
}
$GLOBALS['steed_element_footer_copy_text'] = new steed_element_footer_copy_text;
function steed_element_footer_copy_text(){
	$GLOBALS['steed_element_footer_copy_text']->html();
}