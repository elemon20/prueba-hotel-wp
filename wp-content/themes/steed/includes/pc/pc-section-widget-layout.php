<?php

if(!class_exists('steed_pc_section_widget_layout')):

	class steed_pc_section_widget_layout{
		public $uid;
		public $section_id;
		public $panel_id;
		public $section_title;
		public $section_priority;
		
		function __construct($settings, $config){
			/*
			:::::Customizer Settings::::
			column
			column_t
			column_m
			column_gap
			
			:::::CSS class style::::
			.pcswl / .pcswl-grid, .pcswl-flexslider, .pcswl-tab, .pcswl-owlcarousel, .pcswl-masonry, .pcswl-accordion, .pcswl-toggle 
			.pcswl .steed_pc_section_in
			.pcswl_content
			.pcswl_ul
			.pcswl_li
			.pcswl_item
			.pcswl_item_in
			.pcswl_item_title
			*/
			
			$default = array(
				'widget_title' => 'Text',
				'widget_slug' => 'widget_text',
				'widget_search' => 'search string',
				'css_class' => '',
				'customize_description' => '',
				'layout' => 'grid',//grid, flexslider, tab, owlcarousel, masonry, accordion, toggle
				'title_tag' => 'h4',
				
				'header' => false,
				'background' => false,
				'padding' => false,
				'item_style' => false,
				'content_width' => false,
				'content_style' => false,
				'color_mood' => false,
				'text_align' => false,
				
				'flexslider_height' => false,
				'flexslider_options' => false,
				'flexslider_options2' => false,
				'flexslider_width' => false,
			);
			$this->settings =array_merge($default, $settings);
			
			$this->uid = $config['uid'];
			$this->section_id = $config['section_id'];
			$this->panel_id = $config['panel_id'];
			$this->section_title = $config['section_title'];
			$this->section_priority = $config['section_priority'];
			
			add_action('customize_controls_print_scripts', array($this, 'customize_js'), 30);
			add_action('customize_controls_print_styles', array($this, 'customize_css'));
			add_action('customize_preview_init', array($this, 'live_js') );
		}
		
		
		function html(){
			$settings = $this->settings;
			
			$div_class  = 'pcswl';
			if(($settings['layout'] == 'grid') || ($settings['layout'] == 'masonry')){
				$div_class .=  ' pc-col-'.steed_theme_mod($this->uid.'_column', '4');
				$div_class .=  ' pc-col-t-'.steed_theme_mod($this->uid.'_column_t', '2');
				$div_class .=  ' pc-col-m-'.steed_theme_mod($this->uid.'_column_m', '1');
			}
			$div_class .=  ' pc-widget-'.$settings['widget_slug'];
			$div_class .=  ' pcswl-'.$settings['layout'];
			$div_class .=  ' '.$this->uid;
			$div_class .=  ' '.$settings['css_class'];
			$div_class .=  ' pc-text-align-'.esc_attr(steed_theme_mod($this->uid.'_text_align'));
			
			if(steed_theme_mod($this->uid.'_color_mood') != ''){
				$color_mood = ' color-'.esc_attr(steed_theme_mod($this->uid.'_color_mood')).' ';
			}else{
				$color_mood = ' color-dark ';
			}
			
			if(steed_theme_mod($this->uid.'_disable') == false){
				echo '<section class="steed_pc_section '.esc_attr($div_class.$color_mood).'">';
					echo '<div class="steed_pc_section_in">';
					
						if(((steed_theme_mod($this->uid.'_title') != '') || (steed_theme_mod($this->uid.'_des') != '') || is_customize_preview()) && ($settings['header'] == true)){
							echo '<div class="steed_pc_section_header">';
								echo '<div class="steed_pc_section_header_in">';
									if((steed_theme_mod($this->uid.'_title') != '') || is_customize_preview()){
										echo '<h2>'.wp_kses_post(steed_theme_mod($this->uid.'_title')).'</h2>'; 
									}
									if((steed_theme_mod($this->uid.'_title') != '') || is_customize_preview()){
										echo '<p>'.wp_kses_post(steed_theme_mod($this->uid.'_des')).'</p>'; 
									}
								echo '</div>';
							echo '</div>';
						}
					
						
						if($settings['layout'] == 'flexslider'){
							echo '<div class="pcswl_content flexslider">';
								echo '<ul class="pcswl_ul slides">';
									dynamic_sidebar( $this->uid );
								echo '</ul>';
							echo '</div>';
						}else{
							echo '<div class="pcswl_content">';
								echo '<ul class="pcswl_ul">';
									dynamic_sidebar( $this->uid );
								echo '</ul>';
							echo '</div>';
						}			
						//echo '</div>';
						
					echo '</div>';
					echo '<div class="pcswl_overlay"></div>';
				echo '</section>';
			}elseif(is_customize_preview() && (steed_theme_mod($this->uid.'_disable') == true)){
				echo '<div style="display:none;">';
					dynamic_sidebar( $this->uid );
				echo '</div>';
			}
		}
		
		
		function widgets_init() {
			$settings = $this->settings;
			register_sidebar( array(
				'name'          => $this->section_title,
				'id'            => $this->uid,
				'description'   => $this->settings['customize_description'],
				'before_widget' => '<li id="%1$s" class="pcswl_li"><div class="pcswl_item"><div class="pcswl_item_in %2$s">',
				'after_widget'  => '</div></div></li>',
				'before_title'  => '<'.$settings['title_tag'].' class="pcswl_item_title">',
				'after_title'   => '</'.$settings['title_tag'].'>',
			));
		}
		
		
		function css(){
			$settings = $this->settings;
				$column_gap = steed_theme_mod($this->uid.'_column_gap', '20px');
			
				$bg_image =  steed_theme_mod($this->uid.'_bg_image');
				$bg_color =  steed_theme_mod($this->uid.'_bg_color');
				$bg_overlay =  steed_theme_mod($this->uid.'_bg_overlay_color');
				$bg_repeat =  steed_theme_mod($this->uid.'_bg_repeat');
				$bg_attachment =  steed_theme_mod($this->uid.'_bg_attachment');
				$bg_position =  steed_theme_mod($this->uid.'_bg_position');
				$bg_size =  steed_theme_mod($this->uid.'_bg_size');
				
				$title_color =  steed_theme_mod($this->uid.'_title_color');
				$des_color =  steed_theme_mod($this->uid.'_des_color');
				$title_align =  steed_theme_mod($this->uid.'_title_align');
				
				$padding_top =  steed_theme_mod($this->uid.'_padding_top');
				$padding_bottom =  steed_theme_mod($this->uid.'_padding_bottom');
				$padding_top_t =  steed_theme_mod($this->uid.'_padding_top_t');
				$padding_bottom_t =  steed_theme_mod($this->uid.'_padding_bottom_t');
				$padding_top_m =  steed_theme_mod($this->uid.'_padding_top_m');
				$padding_bottom_m =  steed_theme_mod($this->uid.'_padding_bottom_m');
				
				$content_width =  steed_theme_mod($this->uid.'_content_width');
				$full_width =  steed_theme_mod($this->uid.'_full_width');
				
				//item_style
				$item_bg_color =  steed_theme_mod($this->uid.'_item_bg_color');
				$item_bg_h_color =  steed_theme_mod($this->uid.'_item_bg_h_color');
				$item_text_color =  steed_theme_mod($this->uid.'_item_text_color');
				$item_text_h_color =  steed_theme_mod($this->uid.'_item_text_h_color');
				$item_padding =  steed_theme_mod($this->uid.'_item_padding');
				$item_radius =  steed_theme_mod($this->uid.'_item_radius');
				$item_min_height =  steed_theme_mod($this->uid.'_item_min_height');
				$item_min_height_t =  steed_theme_mod($this->uid.'_item_min_height_t');
				$item_min_height_m =  steed_theme_mod($this->uid.'_item_min_height_m');
				
				//Flexslider Height
				$flexslider_height =  steed_theme_mod($this->uid.'_flexslider_height');
				$flexslider_height_t =  steed_theme_mod($this->uid.'_flexslider_height_t');
				$flexslider_height_m =  steed_theme_mod($this->uid.'_flexslider_height_m');
				
				//Flexslider Content Width
				$flexslider_width =  steed_theme_mod($this->uid.'_flexslider_width');
				
			ob_start();
				
				/*
					Grid & masonry
				-----------------------*/
				if(($column_gap != '') && (($settings['layout'] == 'grid') || ($settings['layout'] == 'masonry'))){
					echo '.'.$this->uid.' .pcswl_ul{'; 
						echo 'margin:-'.esc_attr($column_gap).';'; 
					echo '}';
					echo '.'.$this->uid.' .pcswl_item{'; 
						echo 'margin:'.esc_attr($column_gap).';'; 
					echo '}';
				}
				
				/*
					item_style
				-----------------------*/
				if(($settings['item_style'] == true) && ($settings['layout'] == 'grid') || ($settings['layout'] == 'masonry')){
					echo '.'.$this->uid.' .pcswl_item{'; 
						if($item_bg_color != ''){ echo 'background-color:'.steed_sanitize_rgba($item_bg_color).';'; }
						if($item_padding != ''){ echo 'padding:'.esc_attr($item_padding).';'; }
						if($item_text_color != ''){ echo 'color:'.esc_attr($item_text_color).';'; }
						if($item_radius != ''){ echo 'border-radius:'.esc_attr($item_radius).';'; }
						if($item_min_height != ''){ echo 'min-height:'.esc_attr($item_min_height).';'; }
					echo '}';
					
					echo '.'.$this->uid.' .pcswl_item:hover{'; 
						if($item_bg_h_color != ''){ echo 'background-color:'.steed_sanitize_rgba($item_bg_h_color).';'; }
						if($item_text_h_color != ''){ echo 'color:'.esc_attr($item_text_h_color).';'; }
					echo '}';
					
					echo '.'.$this->uid.' .pcswl_item h1,
						  .'.$this->uid.' .pcswl_item h2,
						  .'.$this->uid.' .pcswl_item h3,
						  .'.$this->uid.' .pcswl_item h4,
						  .'.$this->uid.' .pcswl_item h5,
						  .'.$this->uid.' .pcswl_item h6{'; 
						if($item_text_color != ''){ echo 'color:'.esc_attr($item_text_color).';'; }
					echo '}';
					
					echo '.'.$this->uid.' .pcswl_item:hover h1,
						  .'.$this->uid.' .pcswl_item:hover h2,
						  .'.$this->uid.' .pcswl_item:hover h3,
						  .'.$this->uid.' .pcswl_item:hover h4,
						  .'.$this->uid.' .pcswl_item:hover h5,
						  .'.$this->uid.' .pcswl_item:hover h6{'; 
						if($item_text_h_color != ''){ echo 'color:'.esc_attr($item_text_h_color).';'; }
					echo '}';
					
					if($item_min_height_t != ''){
						echo '@media (max-width: 992px) {';
							echo '.'.$this->uid.' .pcswl_item{'; 
								 echo 'min-height:'.esc_attr($item_min_height_t).';';
							echo '}';
						echo '}';
					}
					if($item_min_height_m != ''){
						echo '@media (max-width: 768px) {';
							echo '.'.$this->uid.' .pcswl_item{'; 
								 echo 'min-height:'.esc_attr($item_min_height_m).';';
							echo '}';
						echo '}';
					}	
				}
			
				/*
					Background
				-----------------------*/
				if(($bg_repeat != '') || ($bg_attachment != '') || ($bg_position != '') || ($bg_size != '') || ($bg_image != '') || ($bg_color != '')){
					echo '.'.$this->uid.'{'; 
						if($bg_image != ''){ echo 'background-image:url('.esc_url( $bg_image ).');'; }
						if($bg_repeat != ''){ echo 'background-repeat:'.esc_attr($bg_repeat).';'; }
						if($bg_attachment != ''){ echo 'background-attachment:'.esc_attr($bg_attachment).';'; }
						if($bg_position != ''){ echo 'background-position:'.esc_attr($bg_position).';'; }
						if($bg_size != ''){ echo 'background-size:'.esc_attr($bg_size).';'; }
						if($bg_color != ''){ echo 'background-color:'.steed_sanitize_rgba($bg_color).';'; }
					echo '}';
				}
				
				if($content_width != ''){
					echo '.'.$this->uid.' .steed_pc_section_in{'; 
						echo 'max-width:'.esc_attr($content_width).';';
					echo '}';
				}
				if($full_width != ''){
					echo '.'.$this->uid.' .steed_pc_section_in{'; 
						echo 'width:'.esc_attr($full_width).';';
					echo '}';
				}
				
				if($title_color != ''){
					echo '.'.$this->uid.' .steed_pc_section_header h2{'; 
						echo 'color:'.steed_sanitize_rgba($title_color).';';
					echo '}';
				}
				if($des_color != ''){
					echo '.'.$this->uid.' .steed_pc_section_header p{'; 
						echo 'color:'.steed_sanitize_rgba($des_color).';';
					echo '}';
				}
				if($title_align != ''){
					echo '.'.$this->uid.' .steed_pc_section_header h2, .'.$this->uid.' .steed_pc_section_header p{'; 
						echo 'text-align:'.esc_attr($title_align).';';
					echo '}';
				}
				
				
				/*
					Padding
				-----------------------*/
				if(($padding_top != '') || ($padding_bottom != '')){
					
					echo '.'.$this->uid.'{'; 
						if($padding_top != ''){ echo 'padding-top:'.esc_attr($padding_top).';'; }
						if($padding_bottom != ''){ echo 'padding-bottom:'.esc_attr($padding_bottom).';'; }
					echo '}';
				}
				if(($padding_top_t != '') || ($padding_bottom_t != '')){
					echo '@media (max-width: 992px) {';
						echo '.'.$this->uid.'{'; 
							if($padding_top_t != ''){ echo 'padding-top:'.esc_attr($padding_top_t).';'; }
							if($padding_bottom_t != ''){ echo 'padding-bottom:'.esc_attr($padding_bottom_t).';'; }
						echo '}';
					echo '}';
				}
				if(($padding_top_m != '') || ($padding_bottom_m != '')){
					echo '@media (max-width: 768px) {';
						echo '.'.$this->uid.'{'; 
							if($padding_top_m != ''){ echo 'padding-top:'.esc_attr($padding_top_m).';'; }
							if($padding_bottom_m != ''){ echo 'padding-bottom:'.esc_attr($padding_bottom_m).';'; }
						echo '}';
					echo '}';
				}			
				
				if($bg_overlay != ''){
					echo '.'.$this->uid.' .pcswl_overlay{';
						echo 'background-color:'.steed_sanitize_rgba($bg_overlay).';';
					echo '}';
				}
				
				
				/*
					Flexslider Height
				-----------------------*/
				if(($settings['layout'] == 'flexslider') && ($settings['flexslider_height'] == true)){
					if($flexslider_height != ''){
						echo '.'.$this->uid.' .scw-warp-in{';
							echo 'height:'.esc_attr($flexslider_height).';';
						echo '}';
					}
					if($flexslider_height_t != ''){
						echo '@media (max-width: 992px) {';
							echo '.'.$this->uid.' .scw-warp-in{';
								echo 'height:'.esc_attr($flexslider_height_t).';';
							echo '}';
						echo '}';
					}
					if($flexslider_height_m != ''){
						echo '@media (max-width: 768px) {';
							echo '.'.$this->uid.' .scw-warp-in{';
								echo 'height:'.esc_attr($flexslider_height_m).';';
							echo '}';
						echo '}';
					}
				}
				
				/*
					Flexslider Content Width
				-----------------------*/
				if(($settings['layout'] == 'flexslider') && ($settings['flexslider_width'] == true)){
					if($flexslider_width != ''){
						echo '.'.$this->uid.' .scw-warp-in{';
							echo 'max-width:'.esc_attr($flexslider_width).';';
						echo '}';
					}
				}
			$output = ob_get_contents();
			ob_end_clean();
			
			return 	$output;
		}
		
		
		function js(){
			$settings = $this->settings;
			$temp = false;
			
			if($temp){ ?><script type="text/javascript" charset="utf-8"><?php }

			if($settings['layout'] == 'flexslider'){
				$flexslider_animation =  (steed_theme_mod($this->uid.'_flexslider_animation') != '') ? steed_theme_mod($this->uid.'_flexslider_animation') : 'fade';
				$flexslider_direction =  (steed_theme_mod($this->uid.'_flexslider_direction') != '') ? steed_theme_mod($this->uid.'_flexslider_direction') : 'horizontal';
				$flexslider_reverse =  (steed_theme_mod($this->uid.'_flexslider_reverse') == true) ? 'true' : 'false';
				$flexslider_animationLoop =  (steed_theme_mod($this->uid.'_flexslider_animationLoop') == true) ? 'true' : 'false';
				$flexslider_smoothHeight =  (steed_theme_mod($this->uid.'_flexslider_smoothHeight') == true) ? 'true' : 'false';
				$flexslider_autoPlay =  (steed_theme_mod($this->uid.'_flexslider_slideshow') == true) ? 'true' : 'false';
				$flexslider_slideshowSpeed =  (steed_theme_mod($this->uid.'_flexslider_slideshowSpeed') != '') ? steed_theme_mod($this->uid.'_flexslider_slideshowSpeed') : '7000';
				$flexslider_animationSpeed =  (steed_theme_mod($this->uid.'_flexslider_animationSpeed') != '') ? steed_theme_mod($this->uid.'_flexslider_animationSpeed') : '600';
				$flexslider_controlNav =  (steed_theme_mod($this->uid.'_flexslider_controlNav') == true) ? 'true' : 'false';
				$flexslider_directionNav =  (steed_theme_mod($this->uid.'_flexslider_directionNav') == true) ? 'true' : 'false';
				
				$flexslider_itemWidth =  (steed_theme_mod($this->uid.'_flexslider_itemWidth') != '') ? steed_theme_mod($this->uid.'_flexslider_itemWidth') : '0';
				$flexslider_itemMargin =  (steed_theme_mod($this->uid.'_flexslider_itemMargin') != '') ? steed_theme_mod($this->uid.'_flexslider_itemMargin') : '0';
				$flexslider_minItems =  (steed_theme_mod($this->uid.'_flexslider_minItems') != '') ? steed_theme_mod($this->uid.'_flexslider_minItems') : '0';
				$flexslider_maxItems =  (steed_theme_mod($this->uid.'_flexslider_maxItems') != '') ? steed_theme_mod($this->uid.'_flexslider_maxItems') : '0';
				$flexslider_move =  (steed_theme_mod($this->uid.'_flexslider_move') != '') ? steed_theme_mod($this->uid.'_flexslider_move') : '0';
				?>
				jQuery(document).ready(function($) {
					function <?php echo $this->uid; ?>_flefslider(){
						$('.<?php echo $this->uid; ?> .flexslider').flexslider({
							
							animation: "<?php echo esc_attr($flexslider_animation); ?>",
							direction: "<?php echo esc_attr($flexslider_direction); ?>",
							reverse: <?php echo esc_attr($flexslider_reverse); ?>, 
							animationLoop: <?php echo esc_attr($flexslider_animationLoop); ?>, 
							smoothHeight: <?php echo esc_attr($flexslider_smoothHeight); ?>,
							slideshow: <?php echo esc_attr($flexslider_autoPlay); ?>,
							slideshowSpeed: <?php echo esc_attr($flexslider_slideshowSpeed); ?>, 
							animationSpeed: <?php echo esc_attr($flexslider_animationSpeed); ?>,
							
							controlNav: <?php echo esc_attr($flexslider_controlNav); ?>,
							directionNav: <?php echo esc_attr($flexslider_directionNav); ?>,
								
							itemWidth: <?php echo esc_attr($flexslider_controlNav); ?>, 
							itemMargin: <?php echo esc_attr($flexslider_controlNav); ?>,
							minItems: <?php echo esc_attr($flexslider_controlNav); ?>, 
							maxItems: <?php echo esc_attr($flexslider_controlNav); ?>, 
							move: <?php echo esc_attr($flexslider_controlNav); ?>,
						});
					}
					<?php echo $this->uid; ?>_flefslider();
				});
                <?php
			}
			
			if($settings['layout'] == 'toggle'){
				?>
				jQuery(document).ready(function($) {
					$('.<?php echo $this->uid; ?> .pcswl_item_title').pc_toggle();
				});
				<?php
			}
			if($settings['layout'] == 'accordion'){
				?>
				jQuery(document).ready(function($) {
					$('.<?php echo $this->uid; ?> .pcswl_item_title').pc_accordion({
						hand: '.<?php echo $this->uid; ?> .pcswl_item_title',	
					});
				});
				<?php
			}
			
			if($temp){ ?></script><?php }
		}
		
		
		function customize($wp_customize){
			$settings = $this->settings;
			$section_id = 'sidebar-widgets-'.$this->uid;
			
			$uid = $this->uid.'_disable';
			$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage'));
			$wp_customize->add_control( $uid, array(
				'label'      => 'Disable '.$this->section_title,
				'section'    => $section_id,
				'settings'   => $uid,
				'type'       => 'checkbox',
				'description' => '',
				'priority'	=> -1,
			));
			if($settings['header'] == true){
				$uid = $this->uid.'_title';
				$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage'));
				$wp_customize->add_control( $uid, array(
					'label'      => 'Title',
					'section'    => $section_id,
					'settings'   => $uid,
					'type'       => 'text',
					'description' => '',
					'priority'	=> -1,
				));
				$uid = $this->uid.'_des';
				$wp_customize->add_setting($uid, array( 'default' => steed_customiz_std($uid), 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage'));
				$wp_customize->add_control( $uid, array(
					'label'      => 'Description',
					'section'    => $section_id,
					'settings'   => $uid,
					'type'       => 'text',
					'description' => '',
					'priority'	=> -1,
				));

			}
			
			
			$the_uid = $this->uid;
			do_action('steed_pc_section_widget_layout', $wp_customize, $section_id, $the_uid, $settings );

			return $wp_customize;
			
		}
		
		
		function customize_js(){
			$settings = $this->settings;
			?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					/* Move our widgets into the widgets panel */
					wp.customize.bind('ready', function() {
						wp.customize.section( 'sidebar-widgets-<?php echo $this->uid; ?>' ).panel( '<?php echo $this->panel_id; ?>' );
						wp.customize.section( 'sidebar-widgets-<?php echo $this->uid; ?>' ).priority( '<?php echo $this->section_priority; ?>' );
						
						jQuery('#customize-control-sidebars_widgets-<?php echo $this->uid; ?> .add-new-widget').on( "click",function(){
							if(jQuery('body').hasClass('<?php echo $this->uid; ?>')){
								jQuery('body').removeClass('<?php echo $this->uid; ?>');
								jQuery('#widgets-search').attr('value', '');
								jQuery('#widgets-search').trigger('keyup');
							}else{
								jQuery('body').addClass('<?php echo $this->uid; ?>');
								jQuery('#widgets-search').attr('value', '<?php echo esc_attr($settings['widget_search']); ?>');
								jQuery('#widgets-search').trigger('keyup');
							}
						});
						
						jQuery('#available-widgets-list .widget-tpl').on( "click",function(){
							if(jQuery('body').hasClass('<?php echo $this->uid; ?>')){
								jQuery('body').removeClass('<?php echo $this->uid; ?>');
								jQuery('#widgets-search').attr('value', '');
								jQuery('#widgets-search').trigger('keyup');
							}							
						});
						
						jQuery('#customize-controls').on( "click",function(){
							if(!jQuery('body').hasClass('adding-widget')){
								jQuery('body').removeClass('<?php echo $this->uid; ?>');
								jQuery('#widgets-search').attr('value', '');
								jQuery('#widgets-search').trigger('keyup');
							}
						});
						
					});
				});
			</script>			
			<?php	
		}
		
		
		function customize_css(){
			?>
			<style type="text/css">
				#sub-accordion-section-sidebar-widgets-<?php echo $this->uid; ?> li.customize-control-checkbox,
				#sub-accordion-section-sidebar-widgets-<?php echo $this->uid; ?> li.customize-control-text,
				#sub-accordion-section-sidebar-widgets-<?php echo $this->uid; ?> li.customize-control-textarea,
				#sub-accordion-section-sidebar-widgets-<?php echo $this->uid; ?> li.customize-control-select,
				#sub-accordion-section-sidebar-widgets-<?php echo $this->uid; ?> li.customize-control-alpha-color,
				#sub-accordion-section-sidebar-widgets-<?php echo $this->uid; ?> li.customize-control-image,
				#sub-accordion-section-sidebar-widgets-<?php echo $this->uid; ?> li.customize-control-steed-heading{
					display:list-item !important;
				}
			</style>			
			<?php	
		}
		
		
		function live_js(){
			$settings = $this->settings;
			$show_script = false;
			ob_start();
			?>
            <?php if($show_script): ?><script type="text/javascript"><?php endif; ?>
				( function( $ ) {
					wp.customize( '<?php echo $this->uid.'_disable'; ?>', function( value ) {
						value.bind( function( newval ) {
							if(newval == true){
								$( '.<?php echo $this->uid; ?>' ).css( 'display', 'none' );
							}else{
								$( '.<?php echo $this->uid; ?>' ).css( 'display', 'block' );
							}
						});
					});
					<?php if($settings['header'] == true): ?>
						wp.customize( '<?php echo $this->uid.'_title'; ?>', function( value ) {
							value.bind( function( to ) {
								$( '<?php echo '.'.$this->uid.' .steed_pc_section_header h2'; ?>' ).text( to );
							} );
						} );
						wp.customize( '<?php echo $this->uid.'_des'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '<?php echo '.'.$this->uid.' .steed_pc_section_header p'; ?>' ).text( newval );
							} );
						} );
					<?php endif; ?>
						
					//Background
					<?php if($settings['background'] == true): ?>
						wp.customize( '<?php echo $this->uid.'_bg_color'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?>' ).css( 'background-color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_bg_overlay_color'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '<?php echo '.'.$this->uid.' .pcswl_overlay'; ?>' ).css( 'background-color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_bg_image'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?>' ).css( 'background-image', 'url(' + newval + ')' );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_bg_repeat'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?>' ).css( 'background-repeat', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_bg_attachment'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?>' ).css( 'background-attachment', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_bg_positionr'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?>' ).css( 'background-position', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_bg_size'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?>' ).css( 'background-size', newval );
							} );
						});
						
						wp.customize( '<?php echo $this->uid.'_title_color'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?> .steed_pc_section_header h2' ).css( 'color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_des_color'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?> .steed_pc_section_header p' ).css( 'color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_title_align'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?> .steed_pc_section_header h2, .<?php echo $this->uid; ?> .steed_pc_section_header p' ).css( 'text-align', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_content_width'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?> .steed_pc_section_in' ).css( 'max-width', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_full_width'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?> .steed_pc_section_in' ).css( 'width', newval );
							} );
						});
					<?php endif; ?>
						
						
					//Padding
					<?php if($settings['padding'] == true): ?>
						wp.customize( '<?php echo $this->uid.'_padding_top'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?>' ).css( 'padding-top', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_padding_bottom'; ?>', function( value ) {
							value.bind( function( newval ) {
								$( '.<?php echo $this->uid; ?>' ).css( 'padding-bottom', newval );
							} );
						});
					<?php endif; ?>	
							
					//Column
					<?php if(($settings['layout'] == 'grid') || $settings['layout'] == 'masonry'): ?>
						wp.customize( '<?php echo $this->uid.'_column'; ?>', function( value ) {
							value.bind( function( newval ) {
								if(newval != ''){
									if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-1' )){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-1' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-2')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-2' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-3')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-3' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-4')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-4' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-5')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-5' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-6')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-6' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-7')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-7' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-' );
									}
									$( '.<?php echo $this->uid; ?>' ).addClass( 'pc-col-'+newval );
								}
							} );
						});
						wp.customize( '<?php echo $this->uid.'_column_t'; ?>', function( value ) {
							value.bind( function( newval ) {
								if(newval != ''){
									if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-1' )){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-1' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-2')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-2' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-3')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-3' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-4')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-4' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-5')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-5' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-6')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-6' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-7')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-7' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-t-')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-t-' );
									}
									$( '.<?php echo $this->uid; ?>' ).addClass( 'pc-col-t-'+newval );
								}
							} );
						});
						wp.customize( '<?php echo $this->uid.'_column_m'; ?>', function( value ) {
							value.bind( function( newval ) {
								if(newval != ''){
									if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-1' )){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-1' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-2')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-2' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-3')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-3' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-4')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-4' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-5')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-5' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-6')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-6' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-7')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-7' );
									}else if($( '.<?php echo $this->uid; ?>' ).hasClass( 'pc-col-m-')){
										$( '.<?php echo $this->uid; ?>' ).removeClass( 'pc-col-m-' );
									}
									$( '.<?php echo $this->uid; ?>' ).addClass( 'pc-col-m-'+newval );
								}
							} );
						});
						wp.customize( '<?php echo $this->uid.'_column_gap'; ?>', function( value ) {
							value.bind( function( newval ) {
								if(newval != ''){
									$('.<?php echo $this->uid; ?> .pcswl_ul' ).css( 'margin', '-'+newval );
									$('.<?php echo $this->uid; ?> .pcswl_item' ).css( 'margin', newval );
								}
							} );
						});
						wp.customize( '<?php echo $this->uid.'_item_min_height'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?> .pcswl_item' ).css( 'min-height', newval );
							} );
						});
					<?php endif; ?>
					
					<?php if(($settings['item_style'] == true) && ($settings['layout'] == 'grid') || ($settings['layout'] == 'masonry')): ?>
						wp.customize( '<?php echo $this->uid.'_item_bg_color'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?> .pcswl_item' ).css( 'background-color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_item_bg_h_color'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?> .pcswl_item:hover' ).css( 'background-color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_item_text_color'; ?>', function( value ) {
							value.bind( function( newval ) {
									$('.<?php echo $this->uid; ?> .pcswl_item' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item h1' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item h2' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item h3' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item h4' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item h5' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item h6' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item p' ).css( 'color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_item_text_h_color'; ?>', function( value ) {
							value.bind( function( newval ) {
									$('.<?php echo $this->uid; ?> .pcswl_item:hover' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item:hover h1' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item:hover h2' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item:hover h3' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item:hover h4' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item:hover h5' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item:hover h6' ).css( 'color', newval );
									$('.<?php echo $this->uid; ?> .pcswl_item:hover p' ).css( 'color', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_item_padding'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?> .pcswl_item' ).css( 'padding', newval );
							} );
						});
						wp.customize( '<?php echo $this->uid.'_item_radius'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?> .pcswl_item' ).css( 'border-radius', newval );
							} );
						});
					<?php endif; ?>
					
					/*=== Flexslider Height ===*/
					<?php if(($settings['layout'] == 'flexslider') && ($settings['flexslider_height'] == true)): ?>
						wp.customize( '<?php echo $this->uid.'_flexslider_height'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?> .scw-warp-in' ).css( 'height', newval );
							} );
						});
					<?php endif; ?>
					
					/*=== Flexslider Width ===*/
					<?php if(($settings['layout'] == 'flexslider') && ($settings['flexslider_width'] == true)): ?>
						wp.customize( '<?php echo $this->uid.'_flexslider_width'; ?>', function( value ) {
							value.bind( function( newval ) {
								$('.<?php echo $this->uid; ?> .scw-warp-in' ).css( 'max-width', newval );
							} );
						});
					<?php endif; ?>
				} )( jQuery );
			<?php if($show_script): ?></script><?php endif; ?>
            <?php
			$output = ob_get_contents();
			ob_end_clean();
			
			wp_add_inline_script( 'steed-customize-preview', $output, 'after' );
		}
	}
endif;