<?php
class steed_header_1_build{
	
	function __construct(){
		add_action( 'after_setup_theme', array($this, 'after_theme_setup'), 9);
		add_action('steed_header', array($this, 'html'), 10);
		add_action( 'wp_enqueue_scripts', array($this, 'scripts'), 9 );
	}
	
	function after_theme_setup(){
		add_filter('steed_element_div_style_header', '__return_true');
		add_filter('steed_element_div_style_main_menu', '__return_true');
		add_filter('steed_element_header_menu', '__return_true');
		add_filter('steed_element_header_ads', '__return_true');
		add_filter('steed_element_header_logo', '__return_true');
		add_filter('steed_element_header_social_icons', '__return_true');
	}
	
	function html(){
		?>
        <header id="masthead" class="site-header">
        	<div class="site-header-in">
            	<div class="braning-and-widgets <?php echo apply_filters('steed_header_color_mood', 'color-dark') ?>">
                	<div class="container-width">
                    	<div class="row">
                        	<div class="site-branding col-sm-4 text_lg_left text_xs_center">
                            	<?php steed_element_header_logo(); ?>
                          	</div>
                            <div class="header-widgets col-sm-8 text_sm_right">
                            	<?php steed_element_header_ads(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mavigation-holder" id="mavigation-holder">
                	<div class="mavigation-holder-in container-width">
                    	<a href="#header_menu" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>
                    	<div class="row">
                        	<nav class="main-navigation col-sm-8" id="site-navigation">
                            	<?php steed_element_header_menu() ?>
                            </nav>
                            <div class="social-widgets col-sm-4 text_sm_right float_xs_right">
                            	<?php steed_element_header_social_icons(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="responsive-menu"><a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a></div>
        <?php
	}
	
	
	function scripts(){
		wp_enqueue_style( 'steed-header-1', get_template_directory_uri() . '/assets/css/header-1.css', array(), '1.0');
	}
}



class steed_header_2_build{
	
	function __construct(){
		add_action( 'after_setup_theme', array($this, 'after_theme_setup'), 9);
		add_action('steed_header', array($this, 'html'), 10);
		add_action( 'wp_enqueue_scripts', array($this, 'scripts'), 9 );
	}
	
	function after_theme_setup(){
		add_filter('steed_element_div_style_header', '__return_true');
		add_filter('steed_element_div_style_main_menu', '__return_true');
		add_filter('steed_element_header_menu', '__return_true');
		add_filter('steed_element_header_email', '__return_true');
		add_filter('steed_element_header_logo', '__return_true');
		add_filter('steed_element_header_social_icons', '__return_true');
		add_filter('steed_element_header_phone', '__return_true');
	}
	
	function html(){
		?>
        <header id="masthead" class="site-header">
        	<div class="site-header-in">
            	<div class="braning-and-widgets <?php echo apply_filters('steed_header_color_mood', 'color-dark') ?>">
                	<div class="container-width">
                        	<div class="site-branding">
                            	<?php steed_element_header_logo(); ?>
                          	</div>
                            <div class="header-widgets">
                            	<?php steed_element_header_email(array('class'=>'eSkin_1')); ?>
                                <?php steed_element_header_phone(array('class'=>'eSkin_1')); ?>
                            </div>
                    </div>
                </div>
                <div class="mavigation-holder" id="mavigation-holder">
                	<div class="mavigation-holder-in container-width">
                    	<a href="#header_menu" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>
                        	<nav class="main-navigation" id="site-navigation">
                            	<?php steed_element_header_menu() ?>
                            </nav>
                            <div class="social-widgets">
                            	<?php steed_element_header_social_icons(); ?>
                            </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="responsive-menu"><a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a></div>
        <?php
	}
	
	function scripts(){
		wp_enqueue_style( 'steed-header-2', get_template_directory_uri() . '/assets/css/header-2.css', array(), '1.0');
	}
}


class steed_header_3_build{
	
	function __construct(){
		add_action( 'after_setup_theme', array($this, 'after_theme_setup'), 9);
		add_action('steed_header', array($this, 'html'), 10);
		add_action( 'wp_enqueue_scripts', array($this, 'scripts'), 9 );
	}
	
	function after_theme_setup(){
		add_filter('steed_element_div_style_header', '__return_true');
		add_filter('steed_element_div_style_topbar', '__return_true');
		add_filter('steed_element_header_menu', '__return_true');
		add_filter('steed_element_header_email', '__return_true');
		add_filter('steed_element_header_logo', '__return_true');
		add_filter('steed_element_header_social_icons', '__return_true');
		add_filter('steed_element_header_phone', '__return_true');
	}
	
	function html(){
		?>
        <header id="masthead" class="site-header">
        	<div class="site-header-in">
            	<?php if( ((steed_theme_mod('header_phone_active') == true) || (steed_theme_mod('header_email_active') == true) || is_customize_preview()) && !steed_theme_mod('topbar_style_disable')): ?>
            	<div class="topbar <?php echo apply_filters('steed_topbar_color_mood', 'color-light') ?>">
                	<div class="topbar-in container-width">
                    	<div class="topbar-left">
                        	<?php steed_element_header_email(array('class'=>'eSkin_2')); ?>
                        </div>
                        <div class="topbar-right">
                        	<?php steed_element_header_phone(array('class'=>'eSkin_2')); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            	<div class="braning-and-widgets <?php echo apply_filters('steed_header_color_mood', 'color-dark') ?>">
                	<div class="container-width">
						<div class="site-branding"><?php steed_element_header_logo(); ?></div>
						<nav class="main-navigation" id="site-navigation"><?php steed_element_header_menu() ?></nav>
                        <a href="#header_menu" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>
                        <div class="social-widgets">
							<?php steed_element_header_social_icons(); ?>
						</div>
                    </div>
                </div>
            </div>
        </header>
        <div class="responsive-menu"><a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a></div>
        <?php
	}
	
	function scripts(){
		wp_enqueue_style( 'steed-header-3', get_template_directory_uri() . '/assets/css/header-3.css', array('steed-common','steed-elements'), '1.0');
	}
}



class steed_header_4_build{
	
	function __construct(){
		add_action( 'after_setup_theme', array($this, 'after_theme_setup'), 9);
		add_action('steed_header', array($this, 'html'), 10);
		add_action( 'wp_enqueue_scripts', array($this, 'scripts'), 9 );
	}
	
	function after_theme_setup(){
		add_filter('steed_element_div_style_header', '__return_true');
		add_filter('steed_element_header_menu', '__return_true');
		add_filter('steed_element_header_logo', '__return_true');
		add_filter('steed_element_header_social_icons', '__return_true');
		add_filter('steed_element_header_woo_cart', '__return_true');
	}
	
	function html(){
		?>
        <header id="masthead" class="site-header <?php echo apply_filters('steed_header_color_mood', 'color-dark') ?>">
        	<div class="site-header-in">
                <div class="container-width">
					<div class="header-left"><?php steed_element_header_logo(); ?></div>
                    <div class="header-right">
						<nav class="main-navigation" id="site-navigation"><?php steed_element_header_menu() ?></nav>
						<a href="#header_menu" class="responsive-menu-hand"><i class="fa fa-align-justify"></i></a>
                        <?php  steed_element_header_woo_cart(); ?>
						<?php steed_element_header_social_icons(); ?>
                        
                    </div>
				</div>
            </div>
        </header>
        <div class="responsive-menu"><a href="#" class="responsive-menu-close"><i class="fa fa-close"></i></a></div>
        <?php
	}
	
	function scripts(){
		wp_enqueue_style( 'steed-header-4', get_template_directory_uri() . '/assets/css/header-4.css', array('steed-common','steed-elements'), '1.0');
	}
}


if(steed_theme_mod('get_header') == 'one'){
	new steed_header_1_build;
}elseif(steed_theme_mod('get_header') == 'two'){
	new steed_header_2_build;
}elseif(steed_theme_mod('get_header') == 'three'){
	new steed_header_3_build;
}elseif(steed_theme_mod('get_header') == 'four'){
	new steed_header_4_build;
}else{
	new steed_header_1_build;
}
