<?php
class steed_element_header_social_icons{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'header_social_icons_';
		$this->customize_section = 'steed_header_social_icons';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
	}	
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			
			$icon_1 = steed_theme_mod($this->customize_prefix.'icon_1', '');
			$text_1 = steed_theme_mod($this->customize_prefix.'text_1', '');
			$icon_2 = steed_theme_mod($this->customize_prefix.'icon_2', '');
			$text_2 = steed_theme_mod($this->customize_prefix.'text_2', '');
			$icon_3 = steed_theme_mod($this->customize_prefix.'icon_3', '');
			$text_3 = steed_theme_mod($this->customize_prefix.'text_3', '');
			$icon_4 = steed_theme_mod($this->customize_prefix.'icon_4', '');
			$text_4 = steed_theme_mod($this->customize_prefix.'text_4', '');
			$icon_5 = steed_theme_mod($this->customize_prefix.'icon_5', '');
			$text_5 = steed_theme_mod($this->customize_prefix.'text_5', '');
			$icon_6 = steed_theme_mod($this->customize_prefix.'icon_6', '');
			$text_6 = steed_theme_mod($this->customize_prefix.'text_6', '');	
		
			?>
            <div class="social-icons header_social_icons">
                <?php if(!empty($icon_1) && !empty($text_1)): ?>
                    <a href="<?php echo $text_1; ?>" rel="nofollow">
                        <?php
                            if(strpos($icon_1, 'fa') !== false){
                                echo '<i class="fa '.esc_attr($icon_1).'"></i>';	
                            }else{
                                echo '<img src="'.esc_url($icon_1).'" alt="">';	
                            }
                        ?>
                    </a>
                <?php endif; ?>
                <?php if(!empty($icon_2) && !empty($text_2)): ?>
                    <a href="<?php echo $text_2; ?>" rel="nofollow">
                        <?php
                            if(strpos($icon_2, 'fa-') !== false){
                                echo '<i class="fa '.esc_attr($icon_2).'"></i>';	
                            }else{
                                echo '<img src="'.esc_url($icon_2).'" alt="">';	
                            }
                        ?>
                    </a>
                <?php endif; ?>
                <?php if(!empty($icon_3) && !empty($text_3)): ?>
                    <a href="<?php echo $text_3; ?>" rel="nofollow">
                        <?php
                            if(strpos($icon_3, 'fa-') !== false){
                                echo '<i class="fa '.esc_attr($icon_3).'"></i>';	
                            }else{
                                echo '<img src="'.esc_url($icon_3).'" alt="">';	
                            }
                        ?>
                    </a>
                <?php endif; ?>
                <?php if(!empty($icon_4) && !empty($text_4)): ?>
                    <a href="<?php echo $text_4; ?>" rel="nofollow">
                        <?php
                            if(strpos($icon_4, 'fa-') !== false){
                                echo '<i class="fa '.esc_attr($icon_4).'"></i>';	
                            }else{
                                echo '<img src="'.esc_url($icon_4).'" alt="">';	
                            }
                        ?>
                    </a>
                <?php endif; ?>
                <?php if(!empty($icon_5) && !empty($text_5)): ?>
                    <a href="<?php echo $text_5; ?>" rel="nofollow">
                        <?php
                            if(strpos($icon_5, 'fa-') !== false){
                                echo '<i class="fa '.esc_attr($icon_5).'"></i>';	
                            }else{
                                echo '<img src="'.esc_url($icon_5).'" alt="">';	
                            }
                        ?>
                    </a>
                <?php endif; ?>
                <?php if(!empty($icon_6) && !empty($text_6)): ?>
                    <a href="<?php echo $text_6; ?>" rel="nofollow">
                        <?php
                            if(strpos($icon_6, 'fa-') !== false){
                                echo '<i class="fa '.esc_attr($icon_6).'"></i>';	
                            }else{
                                echo '<img src="'.esc_url($icon_6).'" alt="">';	
                            }
                        ?>
                    </a>
                    <?php echo  $this->html_after; ?>
                <?php endif; ?>
            </div>
            <?php
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Social Icons', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		

		
		$uid = $this->customize_prefix.'icon_1';
		$wp_customize->add_setting($uid, array( 'default' => 'fa-facebook', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #1 Icon', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Font Awesome Icon class or the image URL of the social media.',
			'priority'   => 7,
		));
		$uid = $this->customize_prefix.'text_1';
		$wp_customize->add_setting($uid, array( 'default' => '#', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #1 Link', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Enter the Full URL incloding <code>http://</code>',
			'priority'   => 7,
		));
		
		$uid = $this->customize_prefix.'icon_2';
		$wp_customize->add_setting($uid, array( 'default' => 'fa-twitter', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #2 Icon', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Font Awesome Icon class or the image URL of the social media.',
			'priority'   => 7,
		));
		$uid = $this->customize_prefix.'text_2';
		$wp_customize->add_setting($uid, array( 'default' => '#', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #2 Link', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Enter the Full URL incloding <code>http://</code>',
			'priority'   => 7,
		));
		
		$uid = $this->customize_prefix.'icon_3';
		$wp_customize->add_setting($uid, array( 'default' => 'fa-linkedin', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #3 Icon', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Font Awesome Icon class or the image URL of the social media.',
			'priority'   => 7,
		));
		$uid = $this->customize_prefix.'text_3';
		$wp_customize->add_setting($uid, array( 'default' => '#', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #3 Link', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Enter the Full URL incloding <code>http://</code>',
			'priority'   => 7,
		));
		
		$uid = $this->customize_prefix.'icon_4';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #4 Icon', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Font Awesome Icon class or the image URL of the social media.',
			'priority'   => 7,
		));
		$uid = $this->customize_prefix.'text_4';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #4 Link', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Enter the Full URL incloding <code>http://</code>',
			'priority'   => 7,
		));
		
		$uid = $this->customize_prefix.'icon_5';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #5 Icon', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Font Awesome Icon class or the image URL of the social media.',
			'priority'   => 7,
		));
		$uid = $this->customize_prefix.'text_5';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #5 Link', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Enter the Full URL incloding <code>http://</code>',
			'priority'   => 7,
		));
		
		$uid = $this->customize_prefix.'icon_6';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #6 Icon', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Font Awesome Icon class or the image URL of the social media.',
			'priority'   => 7,
		));
		$uid = $this->customize_prefix.'text_6';
		$wp_customize->add_setting($uid, array( 'default' => '', 'sanitize_callback' => 'esc_url', ));
		$wp_customize->add_control( $uid, array(
			'label'      => __('Social #6 Link', 'steed'),
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'type'       => 'text',
			'description' => 'Enter the Full URL incloding <code>http://</code>',
			'priority'   => 7,
		));
		
			
	}
	
	public function css($css){
		$new_css = '.header_social_icons a{';
			if( steed_theme_mod($this->customize_prefix.'bg_color') != '' ){ 
				$new_css .= 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'border_color') != '' ){ 
				$new_css .= 'border-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'border_color')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'icon_color') != '' ){ 
				$new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_color')).';'; 
			}
		$new_css .= '}';
		$new_css .= '.header_social_icons a:hover{';
			if( steed_theme_mod($this->customize_prefix.'bg_color_h') != '' ){ 
				$new_css .= 'background-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'bg_color_h')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'border_color_h') != '' ){ 
				$new_css .= 'border-color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'border_color_h')).';'; 
			}
			if( steed_theme_mod($this->customize_prefix.'icon_color_h') != '' ){ 
				$new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_color_h')).';'; 
			}
		$new_css .= '}';
		
		return $css.$new_css;
	}
}
$GLOBALS['steed_element_header_social_icons'] = new steed_element_header_social_icons;
function steed_element_header_social_icons(){
	$GLOBALS['steed_element_header_social_icons']->html();
}