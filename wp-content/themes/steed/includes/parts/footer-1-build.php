<?php
class steed_footer_1_build{
	
	function __construct(){
		add_action( 'after_setup_theme', array($this, 'after_theme_setup'), 9);
		add_action('steed_footer', array($this, 'html'), 10);
		add_action( 'wp_enqueue_scripts', array($this, 'scripts'), 9 );
	}
	
	function after_theme_setup(){
		add_filter('steed_element_div_style_footer_bar', '__return_true');
		add_filter('steed_element_footer_copy_text', '__return_true');
		add_filter('steed_element_footer_credit', '__return_true');
		add_filter('steed_element_footer_widgets', '__return_true');
	}
	
	function html(){
		?>
        <footer id="colophon" class="site-footer <?php echo apply_filters('steed_footer_warp_color_mood', 'color-light') ?>" role="contentinfo">
            <div class="site-footer-in">
                <?php steed_element_footer_widgets(); ?>
                <div class="footer-bar <?php echo apply_filters('steed_footer_bar_color_mood', 'color-light') ?>">
                    <div class="site-info container-width">
                        <?php steed_element_footer_copy_text(); ?>
                        <?php steed_element_footer_credit(); ?>
                    </div><!-- .site-info -->
                </div>
            </div>
        </footer><!-- #colophon -->
        <?php
	}
	
	function scripts(){
		wp_enqueue_style( 'steed-footer-1', get_template_directory_uri() . '/assets/css/footer-1.css', array(), '1.0');
	}
}



if(steed_theme_mod('get_footer') == 'one'){
	new steed_footer_1_build;
}else{
	new steed_footer_1_build;
}
