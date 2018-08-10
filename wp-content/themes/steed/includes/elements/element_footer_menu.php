<?php
class steed_element_footer_menu{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'footer_menu_';
		$this->customize_section = 'steed_footer_menu';
		$this->customize_panel = 'site_Footer';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_action( 'after_setup_theme', array($this, 'after_setup_theme') );
		add_filter('steed_custom_css', array($this, 'css'));
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="footer_menu"><div class="footer_menu_in">';
				wp_nav_menu( array( 'theme_location' => 'footer_menu', 'menu_id' => 'footer_menu' ) );
			echo '</div></div>';
		}
	}
	
	function after_setup_theme(){
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'footer_menu' => __( 'Footer Menu', 'steed' ),
		) );
	}
	
	public function css($css){
		$new_css = '';
		$selector = '#footer_menu';
		
		$menu_text_color			= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_color'));
		$menu_text_hover_color		= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_hover_color'));
		$menu_border_color			= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'border_color'));
		$menu_border_hover_color	= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'border_hover_color'));
		$menu_bg_color				= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color'));
		$menu_bg_hover_color		= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_hover_color'));
		
		$submenu_text_color			= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'submenu_text_color'));
		$submenu_text_hover_color	= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'submenu_text_hover_color'));
		$submenu_border_color		= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'submenu_border_color'));
		$submenu_border_hover_color	= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'submenu_border_hover_color'));
		$submenu_bg_color			= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'submenu_bg_color'));
		$submenu_bg_hover_color		= steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'submenu_bg_hover_color'));

		
		$css_1  =  ($menu_text_color != '') ? 'color:'.$menu_text_color.';' : '';
		$css_1 .=  ($menu_bg_color != '') ? 'background-color:'.$menu_bg_color.';' : '';
		$css_1 .=  ($menu_border_color != '') ? 'border-color:'.$menu_border_color.';' : '';
		if( !empty($css_1) ){ $new_css .= $selector.' > li{ '.$css_1.' }';  }
		if( !empty($menu_text_color) ){ $new_css .= 'a.responsive-menu-hand{ color:'.$menu_text_color.'; }';  }
		
		$css_2  =  ($menu_text_hover_color != '') ? 'color:'.$menu_text_hover_color.';' : '';
		$css_2 .=  ($menu_bg_hover_color != '') ? 'background-color:'.$menu_bg_hover_color.';' : '';
		$css_2 .=  ($menu_border_hover_color != '') ? 'border-color:'.$menu_border_hover_color.';' : '';
		if( !empty($css_2) ){ 
			$new_css .= $selector.' > li:hover, 
					 '.$selector.' > .current_page_item,
					 '.$selector.' > .current-menu-item,
					 '.$selector.' > .current_page_ancestor{ '.$css_2.' }'; 
		}
		
		$css_3  =  ($submenu_text_color != '') ? 'color:'.$submenu_text_color.';' : '';
		$css_3 .=  ($submenu_bg_color != '') ? 'background-color:'.$submenu_bg_color.';' : '';
		$css_3 .=  ($submenu_border_color != '') ? 'border-color:'.$submenu_border_color.';' : '';
		if( !empty($css_3) ){ $new_css .= $selector.' li ul li{ '.$css_3.' }'; }
		
		$css_4  =  ($submenu_text_hover_color != '') ? 'color:'.$submenu_text_hover_color.';' : '';
		$css_4 .=  ($submenu_bg_hover_color != '') ? 'background-color:'.$submenu_bg_hover_color.';' : '';
		$css_4 .=  ($submenu_border_hover_color != '') ? 'border-color:'.$submenu_border_hover_color.';' : '';
		if( !empty($css_4) ){ 
			$new_css .= $selector.' li ul li:hover, 
					 '.$selector.' li ul .current_page_item,
					 '.$selector.' li ul .current-menu-item,
					 '.$selector.' li ul .current_page_ancestor{ '.$css_4.' }'; 
		}
		
		return $css.$new_css;
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Footer Menu', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
			'priority'   => 7,
		));
		
		$uid = $this->customize_prefix.'active';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Enable Footer Menu', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'checkbox',
			'description' => '',
			'priority'   => 7,
		));
			
			
	}
}
$GLOBALS['steed_element_footer_menu'] = new steed_element_footer_menu;
function steed_element_footer_menu(){
	$GLOBALS['steed_element_footer_menu']->html();
}