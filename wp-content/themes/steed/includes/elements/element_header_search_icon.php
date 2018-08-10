<?php
class steed_element_header_search_icon{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'header_search_icon_';
		$this->customize_section = 'steed_header_search_icon';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'wp_footer', array($this, 'search_form') );
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="header_search_icon">';
				echo '<a href="#header_search_icon_form" class="header_search_icon_hand inline-lightbox"><i class="fa fa-search"></i></a>';
			echo '</div>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Header Search', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		
	}
	
	public function css($css){
		$new_css = '';
		
		if( steed_theme_mod($this->customize_prefix.'icon_color') != '' ){ 
			$new_css .= '.header_search_icon_hand{';
				$new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_color')).';'; 
			$new_css .= '}';
		}
		if( steed_theme_mod($this->customize_prefix.'icon_hover_color') != '' ){ 
			$new_css .= '.header_search_icon_hand:hover{';
				$new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_hover_color')).';'; 
			$new_css .= '}';
		}
		
		if( steed_theme_mod($this->customize_prefix.'form_bg') != '' ){ 
			$new_css .= '.header_search_icon_form input[type="text"], .header_search_icon_form input[type="submit"]{';
				$new_css .= 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'form_bg')).';'; 
			$new_css .= '}';
		}
		if( steed_theme_mod($this->customize_prefix.'form_text_color') != '' ){ 
			$new_css .= '.header_search_icon_form input[type="text"], .header_search_icon_form input[type="submit"]{';
				$new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'form_text_color')).';'; 
				$new_css .= 'border-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'form_text_color')).';'; 
			$new_css .= '}';
		}
		if( steed_theme_mod($this->customize_prefix.'popup_bg') != '' ){ 
			$new_css .= '.header_search_icon_form{';
				$new_css .= 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'popup_bg')).';'; 
			$new_css .= '}';
		}
		
		return $css.$new_css;
	}
	
	function search_form(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			?>
			<div style="display:none;">
				<div class="header_search_icon_form" id="header_search_icon_form">
					<?php get_search_form(); ?>
				</div>
			</div>
			<?php
		}
	}
}
$GLOBALS['steed_element_header_search_icon'] = new steed_element_header_search_icon;
function steed_element_header_search_icon(){
	$GLOBALS['steed_element_header_search_icon']->html();
}