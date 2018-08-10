<?php
class steed_element_header_search_bar{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	
	
	function __construct(){
		$this->customize_prefix = 'header_search_bar_';
		$this->customize_section = 'steed_header_search_bar';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			?>
            <div class="header_search_bar">
                <div class="header_search_bar_in">
                    <?php get_search_form(); ?>
                </div>
            </div>
            <?php
		}
	}
	
	function customize($wp_customize){
		
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Header Search', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));

		
	}
}
$GLOBALS['steed_element_header_search_bar'] = new steed_element_header_search_bar;
function steed_element_header_search_bar(){
	$GLOBALS['steed_element_header_search_bar']->html();
}