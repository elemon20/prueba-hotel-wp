<?php
class steed_element_footer_credit{
	public $customize_section;	
	
	function __construct(){
		$this->customize_section = 'steed_footer_bar';
		
		add_action( 'customize_register', array($this, 'customize') );
	}	
	
	function html(){
		if( steed_theme_mod('disable_theme_credit2') != true){
			echo '<div class="footer_credit">Theme Designed By <a href="'.esc_url('http://tallythemes.com').'" title="Design By TallyThemes.com">TallyThemes</a> | Powered by <a href="'.esc_url('http://wordpress.org').'">WordPress</a></div>';
		}
	}
	
	function customize($wp_customize){
			
	}
}

$GLOBALS['steed_element_footer_credit'] = new steed_element_footer_credit;
function steed_element_footer_credit(){
	$GLOBALS['steed_element_footer_credit']->html();
}