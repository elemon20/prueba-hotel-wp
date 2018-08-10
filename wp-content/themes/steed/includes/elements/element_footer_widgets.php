<?php
class steed_element_footer_widgets{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'footer_widgets_';
		$this->customize_section = 'steed_footer_widgets';
		$this->customize_panel = 'site_Footer';
		$this->style_class = '.footer-widgets';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_action( 'widgets_init',  array($this, 'widgets_init') );
		add_filter('steed_custom_css', array($this, 'css'));
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			
			$layout = esc_attr(steed_theme_mod($this->customize_prefix.'layout'));
			$layout_tab = esc_attr(steed_theme_mod($this->customize_prefix.'layout_t'));
			$layout_mobile = esc_attr(steed_theme_mod($this->customize_prefix.'layout_m'));
			
			$widget_1 = false;
			$widget_2 = false;
			$widget_3 = false;
			$widget_4 = false;
			$widget_1_col = '12';
			$widget_2_col = '12';
			$widget_3_col = '12';
			$widget_4_col = '12';
			$layout_array = explode("/", $layout);
			
			if(isset($layout_array[0])){ $widget_1 = true; $widget_1_col = $layout_array[0]; }
			if(isset($layout_array[1])){ $widget_2 = true; $widget_2_col = $layout_array[1]; }
			if(isset($layout_array[2])){ $widget_3 = true; $widget_3_col = $layout_array[2]; }
			if(isset($layout_array[3])){ $widget_4 = true; $widget_4_col = $layout_array[3]; }
		
			echo '<div class="footer-widgets color-'.esc_attr(steed_theme_mod($this->customize_prefix.'color_mood')).'">';
				echo '<div class="footer-widgets-in container-width container-fluid">';
					echo '<div class="row">';
						if($widget_1){ 
							echo '<div class="col-md-'.$widget_1_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.' ">';
								dynamic_sidebar( $this->customize_prefix.'widget_1' );
							echo '</div>';
						}
						if($widget_2){ 
							echo '<div class="col-md-'.$widget_2_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
								dynamic_sidebar( $this->customize_prefix.'widget_2' );
							echo '</div>';
						}
						if($widget_3){ 
							echo '<div class="col-md-'.$widget_3_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
								dynamic_sidebar( $this->customize_prefix.'widget_3' );
							echo '</div>';
						}
						if($widget_4){ 
							echo '<div class="col-md-'.$widget_4_col.' col-sm-'.$layout_tab.' col-xs-'.$layout_mobile.'">';
								dynamic_sidebar( $this->customize_prefix.'widget_4' );
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
	}
	
	
	public function css($css){
		$new_css = $this->style_class.'{';
			if( steed_theme_mod($this->customize_prefix.'bg_color') != '' ){ 
				$new_css .= 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_image') != '' ){ 
				$new_css .= 'background-image:url('.esc_url(steed_theme_mod($this->customize_prefix.'bg_image')).');'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_size') != '' ){ 
				$new_css .= 'background-size:'.esc_attr(steed_theme_mod($this->customize_prefix.'bg_size')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_position') != '' ){ 
				$new_css .= 'background-position:'.esc_attr(steed_theme_mod($this->customize_prefix.'bg_position')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_attachment') != '' ){ 
				$new_css .= 'background-attachment:'.esc_attr(steed_theme_mod($this->customize_prefix.'bg_attachment')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'bg_repeat') != '' ){ 
				$new_css .= 'background-repeat:'.esc_attr(steed_theme_mod($this->customize_prefix.'bg_repeat')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'padding_top') != '' ){ 
				$new_css .= 'padding-top:'.esc_attr(steed_theme_mod($this->customize_prefix.'padding_top')).';';
			}
			if( steed_theme_mod($this->customize_prefix.'padding_bottom') != '' ){ 
				$new_css .= 'padding-bottom:'.esc_attr(steed_theme_mod($this->customize_prefix.'padding_bottom')).';'; 
			}
		$new_css .= '}';
		
		if(( steed_theme_mod($this->customize_prefix.'padding_top_t') != '') || ( steed_theme_mod($this->customize_prefix.'padding_bottom_t') != '' ) ){
			$new_css .= '@media (max-width: 992px) {';
				$new_css .= $this->style_class.'{';
					if( steed_theme_mod($this->customize_prefix.'padding_top_t') != '' ){ 
						$new_css .= 'padding-top:'.esc_attr(steed_theme_mod($this->customize_prefix.'padding_top_t')).';';
					}
					if( steed_theme_mod($this->customize_prefix.'padding_bottom_t') != '' ){ 
						$new_css .= 'padding-bottom:'.esc_attr(steed_theme_mod($this->customize_prefix.'padding_bottom_t')).';'; 
					}
				$new_css .= '}';
			$new_css .= '}';
		}
		
		if(( steed_theme_mod($this->customize_prefix.'padding_top_m') != '') || ( steed_theme_mod($this->customize_prefix.'padding_bottom_m') != '' ) ){
			$new_css .= '@media (max-width: 768px) {';
				$new_css .= $this->style_class.'{';
					if( steed_theme_mod($this->customize_prefix.'padding_top_m') != '' ){ 
						$new_css .= 'padding-top:'.esc_attr(steed_theme_mod($this->customize_prefix.'padding_top_m')).';'; 
					}
					if( steed_theme_mod($this->customize_prefix.'padding_bottom_m') != '' ){ 
						$new_css .= 'padding-bottom:'.esc_attr(steed_theme_mod($this->customize_prefix.'padding_bottom_m')).';'; 
					}
				$new_css .= '}';
			$new_css .= '}';
		}
		
		return $css.$new_css;
	}
	
	function customize($wp_customize){
		
		$uid = $this->customize_prefix.'active';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Enable Footer Widgets', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'checkbox',
			'description' => '',
			'priority'   => 5,
		));
		
		/*_----------
		background
		_
		----------------*/
		$uid = $this->customize_prefix.'bg_header';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control(new steed_Customize_Control_heading($wp_customize, $uid, array(
			'label'      => 'Background',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => 'Footer Widgets Background style',
			'priority'   => 7,
		)));
		
		$uid = $this->customize_prefix.'bg_image';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, $uid, array(
			'label'      => __('Background Image', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'priority'   => 7,
		)));
	}
	
	function widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__('Footer #1', 'steed' ),
			'id'            => $this->customize_prefix.'widget_1',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar( array(
			'name'          => esc_html__(  'Footer #2', 'steed' ),
			'id'            => $this->customize_prefix.'widget_2',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar( array(
			'name'          => esc_html__(  'Footer #3', 'steed' ),
			'id'            => $this->customize_prefix.'widget_3',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Footer #4', 'steed' ),
			'id'            => $this->customize_prefix.'widget_4',
			'description'   => '',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
	}
}
$GLOBALS['steed_element_footer_widgets'] = new steed_element_footer_widgets;
function steed_element_footer_widgets(){
	$GLOBALS['steed_element_footer_widgets']->html();
}