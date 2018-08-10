<?php
class steed_element_header_email{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	
	
	function __construct($settings = array()){
		$this->customize_prefix = 'header_email_';
		$this->customize_section = 'steed_header_email';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
		add_action('customize_preview_init', array($this, 'live_js') );
		
		
	}	
	
	function html($settings){
		$default = array(
			'class' => '',
		);
		$settings =array_merge($default, $settings);
		if( (steed_theme_mod($this->customize_prefix.'active') == true) || is_customize_preview()){
			
			$has_icon = 'no_icon';
			if((steed_theme_mod($this->customize_prefix.'font_icon') != '') || (steed_theme_mod($this->customize_prefix.'image_icon') != '')){
				$has_icon = 'has_icon';
			}
			
			echo '<div class="header_email '.$has_icon.' '.esc_attr($settings['class']).'">';
				echo '<a href="mailto:'.esc_attr(steed_theme_mod($this->customize_prefix.'content')).'">';
					
					echo '<div class="header_email_img">';
						if((steed_theme_mod($this->customize_prefix.'font_icon') != '')){
							echo '<i class="fa '.esc_attr(steed_theme_mod($this->customize_prefix.'font_icon')).'"></i>';
						}elseif((steed_theme_mod($this->customize_prefix.'image_icon') != '')){
							echo '<img src="'.esc_url(steed_theme_mod($this->customize_prefix.'image_icon')).'" alt="">';
						}
					echo '</div>';
					
					echo '<div class="header_email_text">';
						if((steed_theme_mod($this->customize_prefix.'text') != '') || is_customize_preview()){
							echo '<span>'.wp_kses_post(steed_theme_mod($this->customize_prefix.'text')).'</span>';
						}
						echo '<strong>'.esc_attr(steed_theme_mod($this->customize_prefix.'content')).'</strong>';
					echo '</div>';
					
				echo '</a>';
			echo'</div>';
		}
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Header Email', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));
		
		$uid = $this->customize_prefix.'content';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage'));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Email Address',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'text',
			'priority'   => 7,
		));	
		$uid = $this->customize_prefix.'text';
		$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage'));
		$wp_customize->add_control( $uid, array(
			'label'      => 'Info Text',
			'section'    => $this->customize_section,
			'settings'   => $uid,
			'description' => '',
			'type'       => 'text',
			'priority'   => 7,
		));	

	}
	
	public function css($css){
		$new_css = '';
		if(steed_theme_mod($this->customize_prefix.'icon_color') != ''){
			$new_css .='.header_email i{';
				 $new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'text_color') != ''){
			$new_css .='.header_email a, .header_email a:hover{';
				 $new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_color')).';';
			$new_css .='}';
		 }
		
		if(steed_theme_mod($this->customize_prefix.'icon_hover_color') != ''){
			$new_css .='.header_email:hover i{';
				 $new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_hover_color')).';';
			$new_css .='}';
		 }
		 if(steed_theme_mod($this->customize_prefix.'text_hover_color') != ''){
			$new_css .='.header_email:hover a, .header_email a:hover{';
				 $new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'text_hover_color')).';';
			$new_css .='}';
		 }
		 
		return $css.$new_css;
	}
	
	function live_js(){
		$show_script = false;
		ob_start();
		?>
		<?php if($show_script): ?><script type="text/javascript"><?php endif; ?>
			(function($){
				wp.customize( '<?php echo $this->customize_prefix.'active'; ?>', function( value ) {
					value.bind( function( newval ) {
						if(newval == true){
							$( '.header_email' ).css( 'display', 'block' );
						}else{
							$( '.header_email' ).css( 'display', 'none' );
						}
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'content'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email strong' ).html( newval );
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'text'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email span' ).html( newval );
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'font_icon'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email_img' ).html( '<i class="fa '+newval+'"></i>' );
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'image_icon'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email_img' ).html( '<img src="'+newval+'"></i>' );
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'icon_color'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email i' ).css( "color", newval );
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'icon_hover_color'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email i' ).customizee_hover_color_effect_helper({ newval : newval });
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'text_color'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email span, .header_email strong' ).css( 'color', newval );
						
					});
				});
				wp.customize( '<?php echo $this->customize_prefix.'text_hover_color'; ?>', function( value ) {
					value.bind( function( newval ) {
						$( '.header_email span, .header_email strong' ).customizee_hover_color_effect_helper({ newval : newval });
					});
				});
			})(jQuery);
		<?php if($show_script): ?></script><?php endif; ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_add_inline_script( 'steed-customize-preview', $output, 'after' );
	}
}
$GLOBALS['steed_element_header_email'] = new steed_element_header_email;
function steed_element_header_email($settings = array()){
			
	$GLOBALS['steed_element_header_email']->html($settings);
}