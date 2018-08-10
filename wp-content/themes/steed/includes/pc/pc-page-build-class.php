<?php

class steed_pc_builder{
	public $panel_id;
	public $panel_title;
	public $panel_description;
	
	public $sections_method;
	
	function __construct($settings){
		$default = array(
			'title' => '',
			'slug' => '',
			'sections' => NULL,
				
		);
		$this->settings = array_merge($default, $settings);
		
		$sections_method = array();
		
		$this->panel_id = 'steed_pc_'.esc_attr($this->settings['slug']);
		$this->panel_title = wp_kses_post($this->settings['title']);
		$this->panel_description = wp_kses_post($this->settings['description']);
		
		add_filter('steed_custom_css', array($this, 'css'));
		add_action( 'customize_register', array($this, 'customize') );
		add_action( 'steed_pc_html_'.$this->settings['slug'], array($this, 'html') );
		add_action( 'widgets_init', array($this, 'widgets_init'));
		add_action( 'wp_footer', array($this, 'js'));
		
		if(is_array($this->settings['sections'])){
			foreach($this->settings['sections'] as $key => $section){
				if(class_exists($section['name'])){
					$section_class_name = $section['name'];
					$section_config = array(
						'uid' => $this->panel_id.'_'.$section['uid'],
						'section_id' => $this->panel_id.'_'.$section['uid'],
						'panel_id' => $this->panel_id,
						'section_title' => $section['title'],
						'section_priority' => $key,
					);
					$this->sections_method[] = new $section_class_name($section['settings'], $section_config);
					
					//echo '<br>'.$section['name'];
				}
			}
		}
	}
	
	
	function customize($wp_customize){
		$wp_customize->add_panel( $this->panel_id , array(
			'title'			=> $this->panel_title,
			'description'	=> $this->panel_description,
			'priority'		=> 160,
		));
		if(is_array($this->sections_method)){
			foreach($this->sections_method as $section){
				if(method_exists($section, 'customize')){
					$section->customize($wp_customize);
				}
			}
		}
	}
	
	
	function css($css){
		$new_css = '';
		
		if(is_array($this->sections_method)){
			foreach($this->sections_method as $section){
				if(method_exists($section, 'css')){
					$new_css .= $section->css();
				}
			}
		}
		
		return $css.$new_css;
	}
	
	
	function html(){
		if(is_array($this->sections_method)){
			foreach($this->sections_method as $section){
				if(method_exists($section, 'html')){
					$section->html();
				}
			}
		}
		
	}
	
	
	function js(){
		echo '<script type="text/javascript" charset="utf-8">';
		if(is_array($this->sections_method)){
			foreach($this->sections_method as $section){
				if(method_exists($section, 'js')){
					$section->js();
				}
			}
		}
		echo '</script>';
	}
	
	
	function widgets_init(){
		if(is_array($this->sections_method)){
			foreach($this->sections_method as $section){
				if(method_exists($section, 'widgets_init')){
					$section->widgets_init();
				}
			}
		}
	}
}