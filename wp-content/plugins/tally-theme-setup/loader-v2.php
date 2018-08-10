<?php
//add_filter('tallythemesetup_load_v2', '__return_true');
$sample = array(
	'xml' => '', //xml file path or false to disable
	'widget' => '', //wie file path or false to disable
	'home' => 'Home',  //Name or false to disable
	'blog' => 'Blog', //Name or false to disable
	'menus' => array(/*array or false to disable*/
		array('title' => 'Primary', 'location' => 'header_menu'),
		array('title' => 'Footer', 'location' => 'footer_menu'),
	),
	'revolution_sliders' => array('slider_path.zip', 'slider_path.zip'), //array or false to disable
	'plugins' => array(/*array or false to disable*/
		'tally-theme-setup/tally-theme-setup.php',
		'contact-form-7/wp-contact-form-7.php',
		'option-tree/ot-loader.php'
	),
	'demo_url' => '', //Extranal Demo URL
	'demo_image' => '', //Extranal Demo image URL
	'doc_url' => '', //Documentation URL
);
class tallythemesetup_load_v2{
	public $demo_data;
	public $theme_slug;
	public $options_name;
	public $user_meta_id;
	
	function __construct(){
		$this->demo_data = apply_filters('tallythemesetup_demo_data', false);
		
		if(($this->demo_data !== false) && is_array($this->demo_data)){
			
			$theme_data = wp_get_theme();
			$this->theme_slug = strtolower(str_replace(" ", "_", $theme_data->get('Name')));
			$this->options_name = array(
				'xml' => 'tallythemesetup_'.$this->theme_slug.'_xml',
				'widget' => 'tallythemesetup_'.$this->theme_slug.'_widget',
				'home' => 'tallythemesetup_'.$this->theme_slug.'_home',
				'blog' => 'tallythemesetup_'.$this->theme_slug.'_blog',
				'menus' => 'tallythemesetup_'.$this->theme_slug.'_menus',
				'revolution_slider' => 'tallythemesetup_'.$this->theme_slug.'_revolution_sliders',
			);
			$this->user_meta_id = 'tallythemesetup_'.$this->theme_slug.'_user_notice';
			add_action( 'wp_ajax_tallythemesetup_demo_import', array($this, 'demo_import'));
			add_action( 'admin_enqueue_scripts', array($this, 'scripts') );
			add_action('admin_notices', array($this, 'admin_notice'));
			add_action('admin_menu', array($this, 'admin_page'));
		}
	}
	
	
	function demo_import(){
		
		$this->xml_import();
		$this->widget_import();
		$this->update_reading_setting();
		$this->update_menu();
		$this->revolution_slider();
		
		die(); // this is required to return a proper result
	}
	
	
	/*
		XML importer
	------------------------------------------------------------------*/
	function xml_import(){
		if(($this->demo_data['xml'] === false) && $_REQUEST['target'] == 'xml_import'){
			update_option($this->options_name['xml'], 'disable');
			
		}
		if(!file_exists($this->demo_data['xml']) && $_REQUEST['target'] == 'xml_import'){
			update_option($this->options_name['xml'], 'notfound');
			echo 'XML file not found:<br>'.$this->demo_data['xml'];
		}
		
		if(($this->demo_data['xml'] !== false) && ($_REQUEST['target'] == 'xml_import') && file_exists($this->demo_data['xml'])):
				
			include(TALLYTHEMESETUP__PLUGIN_DRI.'inc/WXR-parsers.php');
			include(TALLYTHEMESETUP__PLUGIN_DRI.'inc/import-xml.php');
		
			if ( class_exists('tallythemesetup_import') ){ 
				$import_filepath = $this->demo_data['xml'];
				$WP_Import = new tallythemesetup_import();
				$WP_Import->fetch_attachments = true;
							
				set_time_limit(0);
				ob_start();
				$WP_Import->import($import_filepath);
				$log = ob_get_contents();
				ob_end_clean();
				
				if($WP_Import->check()){
					echo '<p>Sample contents are imported.</p>';
					update_option($this->options_name['xml'], 'done');
				}else{
					echo '<p>XML Import Fail</p>';
					update_option($this->options_name['xml'], 'fail');
				}
			}else{
				echo '<p>Class: <strong>tallythemesetup_import</strong> not found</p>';
				update_option($this->options_name['xml'], 'fail');
			}
		endif;
	}
	
	/*
		Widget importer
	------------------------------------------------------------------*/
	function widget_import(){
		if(($this->demo_data['widget'] === false) && $_REQUEST['target'] == 'widget_import'){
			update_option($this->options_name['widget'], 'disable');
		}elseif(!file_exists($this->demo_data['widget']) && $_REQUEST['target'] == 'widget_import'){
			update_option($this->options_name['widget'], 'notfound');
			echo 'Widget file not found:<br>'.$this->demo_data['widget'];
		}
		
		if(($this->demo_data['widget'] !== false) && ($_REQUEST['target'] == 'widget_import') && file_exists($this->demo_data['widget'])):
			if ( !function_exists( 'tallythemesetup_process_widget_data' ) ){ 
				require_once TALLYTHEMESETUP__PLUGIN_DRI.'/inc/import-widgets-wie.php';
			}
			if(function_exists( 'tallythemesetup_process_widget_data' )){
	
				$wie_filepath = $this->demo_data['widget'];
				
				if(tallythemesetup_process_widget_data( $wie_filepath )){
					echo '<p>Widgets are imported.</p>';
					update_option($this->options_name['widget'], 'done');
				}else{
					echo '<p>Widgets Import Fail</p>';
					update_option($this->options_name['widget'], 'fail');
				}
			}
		endif;
	}
	
	/*
		Setup Home page as front page
	------------------------------------------------------------------*/
	function update_reading_setting(){
		
		//Home
		if(($this->demo_data['home'] !== false) && $_REQUEST['target'] == 'setup_home'){
			$home_page_data = get_page_by_title( $this->demo_data['home'] );
			if($home_page_data){
				update_option( 'page_on_front', $home_page_data->ID);
				update_option( 'show_on_front', 'page' );
				update_option($this->options_name['home'], 'done');
				echo '<p>Set home page as Front page.</p>';
			}else{
				echo 'Page not found!';
				update_option($this->options_name['home'], 'fail');
			}
		}else{
			update_option($this->options_name['home'], 'disable');
		}
		
		//Blog
		if(($this->demo_data['blog'] !== false) && $_REQUEST['target'] == 'setup_home'){
			$home_blog_data = get_page_by_title( $this->demo_data['blog'] );
			if($home_blog_data){
				update_option( 'page_for_posts', $home_blog_data->ID);
				update_option($this->options_name['blog'], 'done');
				echo '<p>Set Blog page as Post page.</p>';
			}else{
				echo '<p>Page not found!</p>';
				update_option($this->options_name['blog'], 'fail');
			}
		}else{
			update_option($this->options_name['blog'], 'disable');
		}	
	}
	
	
	/*
		Setup the menu
	------------------------------------------------------------------*/
	function update_menu(){
		
		if(($this->demo_data['menus'] !== false) && ($_REQUEST['target'] == 'setup_menu') && is_array($this->demo_data['menus'])){
			$locations = array();
			foreach($this->demo_data['menus'] as $demo_menu){
				$menu = get_term_by('name', $demo_menu['title'], 'nav_menu');
				if(isset($menu)){
					$locations[$demo_menu['location']] = $menu->term_id;
				}
			}
			set_theme_mod('nav_menu_locations', $locations);
			echo '<p>Menus are imported.</p>';
			update_option($this->options_name['menus'], 'done');
			

		}else{
			update_option($this->options_name['menus'], 'disable');
		}
	}
	
	/*
		Import revolution slider
	------------------------------------------------------------------*/
	function revolution_slider(){
		if(($this->demo_data['revolution_sliders'] !== false) && ($_REQUEST['target'] == 'revolution_slider_import') && is_array($this->demo_data['revolution_sliders'])){
			foreach($this->demo_data['revolution_sliders'] as $slider){
				if(file_exists($slider)){
					$RevSlider = new RevSlider();
					if($RevSlider->importSliderFromPost(true, true, tallythemesetup_demo_files_url($slider))){
						update_option($this->options_name['revolution_sliders'], 'done');
						echo '<p>Slider imported</p>';
					}else{
						update_option($this->options_name['revolution_sliders'], 'fail');
						echo '<p>Import Fail</p>';
					}
				}else{
					echo 'Slider siz file not found:'.$slider;
					update_option($this->options_name['revolution_sliders'], 'notfound');
				}
			}
		}else{
			update_option($this->options_name['revolution_sliders'], 'disable');
		}
		
	}
	
	
	function scripts() {
		wp_enqueue_style( 'tally-theme-setup', TALLYTHEMESETUP__PLUGIN_URL . 'assets/css/admin.css');
		wp_enqueue_script( 'tally-theme-setup', TALLYTHEMESETUP__PLUGIN_URL.'assets/js/bootstrapguru-import.js', array('jquery'), '', true ); 
	}



	function admin_notice() {
		global $current_user;
		$user_id = $current_user->ID;
		$theme = wp_get_theme();
		
		$plugins_lists = $this->demo_data['plugins'];
		$theme_demo_url = $this->demo_data['demo_url'];
		
		//print_r($plugins_lists);
		$plugins_lists_count = count($plugins_lists);
		
		$installed_plugin_count = 0;
		if(is_array($plugins_lists)){
			foreach($plugins_lists as $plugins_list){
				if(is_plugin_active( $plugins_list )){
					$installed_plugin_count++;
					//echo $plugins_list.'<br>';
				}
			}
		}
		//echo $installed_plugin_count;
		$all_data_imported = $this->is_all_data_imported();

				
		$user_ignored_notice = false;
		if( get_user_meta($user_id, $this->user_meta_id, 'yes') == 'yes' ) {
			$user_ignored_notice = true;
		}	
		
		$is_current_page_impoter_page = false;
		if(isset($_GET['page'])){
			if($_GET['page'] == 'tallythemesetup-demo-importer'){
				$is_current_page_impoter_page = true;
			}
		}
		
		$is_current_page_tgmpa_page = false;
		if(isset($_GET['page'])){
			if($_GET['page'] == 'tgmpa-install-plugins'){
				$is_current_page_tgmpa_page = true;
			}
		}
		
		if ($user_ignored_notice == false) {
			if($all_data_imported == false){
			?>
			<div class="tallythemesetup_notice">
				<h2><?php _e( 'Thanks for installing <strong>'.$theme->get( 'Name' ).'</strong> Theme', 'tally-theme-setup' ); ?></h2>
				<?php if($installed_plugin_count == $plugins_lists_count): ?>
					<?php if($is_current_page_impoter_page == true): ?>
						<p>Now you are in the Sample Data Impoter page. Please click on <strong>Import Sample Data</strong> button to make your site look like the theme demo.</p>
					<?php else: ?>
						<p>You are away of one simple step to make your site look like the Theme 
						<a href="<?php echo $theme_demo_url; ?>" target="_blank">Demo</a> Please click on the button below and it will take you to the Demo Impoter page</p>
						<a class="button button-primary button-hero" href="<?php echo admin_url('themes.php?page=tallythemesetup-demo-importer'); ?>">Take me to the Impoter Page</a> 
					<?php endif; ?>
				<?php else: ?>  
					<p>If you want to make the site look like the <a href="<?php echo $theme_demo_url; ?>" target="_blank">Demo</a> of the theme please follow the simple 2 steps below.</p>
					<ol>
						<li>Install Recommended Plugins</li>
						<li>Import Sample Data</li>
					</ol>
					<?php if($is_current_page_tgmpa_page == true): ?>
						<p>Below are the listed Required Plugins that need to install. Please install all plugins.</p>
					<?php else: ?>
						<a class="button button-primary button-hero" href="<?php echo admin_url('themes.php?page=tgmpa-install-plugins'); ?>">Install Recommended Plugins</a> 
					<?php endif; ?>
				<?php endif; ?>   
				<a class="n-dismiss" href="<?php echo admin_url('themes.php?page=tallythemesetup-demo-importer&amp;tallythemesetup_ignore_notice=yes'); ?>">Dismiss</a>
			</div>
			<?php
			}
		}
	}
	
	function is_all_data_imported(){
		$is = true;
		
		if(($this->demo_data['xml'] !== false) && (get_option($this->options_name['xml']) != 'done')){
			$is = false;
		}
		if(($this->demo_data['widget'] !== false) && (get_option($this->options_name['widget']) != 'done')){
			$is = false;
		}
		if(($this->demo_data['home'] !== false) && (get_option($this->options_name['home']) != 'done')){
			$is = false;
		}
		if(($this->demo_data['blog'] !== false) && (get_option($this->options_name['blog']) != 'done')){
			$is = false;
		}
		if(($this->demo_data['menus'] !== false) && (get_option($this->options_name['menus']) != 'done')){
			$is = false;
		}
		if(($this->demo_data['revolution_sliders'] !== false) && (get_option($this->options_name['revolution_slider']) != 'done')){
			$is = false;
		}
		
		return $is;
	}
	
	
	
	
	function admin_page() {
		add_theme_page('Sample Data', 'Sample Data', 'manage_options', 'tallythemesetup-demo-importer', array($this, 'admin_page_html'));
	}
	function admin_page_html(){
		?>
		<div class="wrap tallythemesetup_page">
			<h1>Import Sample Data</h1>
			<?php if($this->is_all_data_imported()): ?>
				
				<strong style="color:#F00; font-size:16px; line-height:1.5;">Looks like you already import the sample data. So you don't need to do it again. If you import again duplicate content will be generated</strong>
			<?php endif; ?>
			<p style="font-weight:bold; color:#000; font-size:14px; line-height:1.5;">Sample data is not recommended for live site. It is recommended on a fresh wordpress installation. So if your current wordpress installation already have content( Images, Page's, Posts, etc. ) you should not import sample data. </p>
			<div class="tallythemesetup_import_message" style="margin-bottom:20px;"></div>
			<div class="tallythemesetup_import_message1" style="margin-bottom:20px; display:none;">
				<img src="<?php echo TALLYTHEMESETUP__PLUGIN_URL; ?>assets/images/loader.gif" /> Importing Sample Data
			</div>
			<div class="tallythemesetup_import_message2" style="margin-bottom:20px; display:none;">
				<img src="<?php echo TALLYTHEMESETUP__PLUGIN_URL; ?>assets/images/loader.gif" /> Importing Widgets
			</div>
			<div class="tallythemesetup_import_message3" style="margin-bottom:20px; display:none;">
				<img src="<?php echo TALLYTHEMESETUP__PLUGIN_URL; ?>assets/images/loader.gif" />Setting Up Home Page
			</div>
			<div class="tallythemesetup_import_message4" style="margin-bottom:40px; display:none;">
				<img src="<?php echo TALLYTHEMESETUP__PLUGIN_URL; ?>assets/images/loader.gif" />Setting Up Site Menu
			</div>
			<div class="tallythemesetup_import_message5" style="margin-bottom:40px; display:none;">
				<img src="<?php echo TALLYTHEMESETUP__PLUGIN_URL; ?>assets/images/loader.gif" />Importing Builder Content
			</div>
			<div class="tallythemesetup_import_message6" style="margin-bottom:40px; display:none;">
				<img src="<?php echo TALLYTHEMESETUP__PLUGIN_URL; ?>assets/images/loader.gif" />Importing Slider
			</div>
			<a href="#" class="tallythemesetup_bootstrapguru_import button button-primary button-hero">Import Sample Data</a>
		</div>
		<?php
	}

	
}

new tallythemesetup_load_v2;