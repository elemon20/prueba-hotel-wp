<?php
/*
* Create the about page
*/
$config = array(
	// Menu name under Appearance.
	'menu_name'           => __( 'About Steed', 'steed' ),
	// Page title.
	'page_name'           => __( 'About Steed', 'steed' ),
	// Main welcome title
	/* translators: s - theme name */
	'welcome_title'       => sprintf( __( 'Welcome to %s! - Version ', 'steed' ), 'Steed' ),
	// Main welcome content
	'welcome_content'     => esc_html__( 'Steed is a modern WordPress theme for Happy Bloging. It fits creative Blogs, businesses Blog, startups blog, corporate businesses blog, online agencies blog and firms blog, food blog, widgetized footer, is compatible with: The theme is responsive, WPML, Retina ready, SEO friendly', 'steed' ),
	/**
	 * Tabs array.
	 *
	 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
	 * the will be the name of the function which will be used to render the tab content.
	 */
	'tabs'                => array(
		'getting_started'     => __( 'Getting Started', 'steed' ),
		'recommended_actions' => __( 'Recommended Actions', 'steed' ),
		'recommended_plugins' => __( 'Useful Plugins', 'steed' ),
		'support'             => __( 'Support', 'steed' ),
		'changelog'           => __( 'Changelog', 'steed' ),
		'free_pro'            => __( 'Free vs PRO', 'steed' ),
	),
	// Support content tab.
	'support_content'     => array(
		'first'  => array(
			'title'        => esc_html__( 'Contact Support', 'steed' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'We want to make sure you have the best experience using Hestia, and that is why we have gathered all the necessary information here for you. We hope you will enjoy using Hestia as much as we enjoy creating great products.', 'steed' ),
			'button_label' => esc_html__( 'Contact Support', 'steed' ),
			'button_link'  => esc_url( 'http://tallythemes.com/support/' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Documentation', 'steed' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Steed.', 'steed' ),
			'button_label' => esc_html__( 'Read full documentation', 'steed' ),
			'button_link'  => esc_url('http://tallythemes.com/doc-item/steed-theme-documentation/'),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'third'  => array(
			'title'        => esc_html__( 'Changelog', 'steed' ),
			'icon'         => 'dashicons dashicons-portfolio',
			'text'         => esc_html__( 'Want to get the gist on the latest theme changes? Just consult our changelog below to get a taste of the recent fixes and features implemented.', 'steed' ),
			'button_label' => esc_html__( 'Changelog', 'steed' ),
			'button_link'  => esc_url( admin_url( 'themes.php?page=steed-welcome&tab=changelog&show=yes' ) ),
			'is_button'    => false,
			'is_new_tab'   => false,
		),
		'fourth' => array(
			'title'        => esc_html__( 'Download Free child theme', 'steed' ),
			'icon'         => 'dashicons dashicons-admin-customizer',
			'text'         => esc_html__( "Download and install interactive and creative free Child theme of steed.", 'steed' ),
			'button_label' => esc_html__( 'Download Free Child theme now.', 'steed' ),
			'button_link'  => esc_url('http://tallythemes.com/product-category/free-wordpress-themes/'),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'fifth'  => array(
			'title'        => esc_html__( 'How to install a Theme', 'steed' ),
			'icon'         => 'dashicons dashicons-controls-skipforward',
			'text'         => esc_html__( 'If you find yourself in a situation where you are having problem to install the theme and child theme please follow the link below.', 'steed' ),
			'button_label' => esc_html__( 'View how to do this', 'steed' ),
			'button_link'  => esc_url('http://tallythemes.com/doc-item/steed-theme-documentation/'),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'sixth'  => array(
			'title'        => esc_html__( 'Get the site like the Demo of the theme', 'steed' ),
			'icon'         => 'dashicons dashicons-images-alt2',
			'text'         => esc_html__( 'Having problem to make the site just like the theme demo. We have creatd a easy documentation to show you how to do it..', 'steed' ),
			'button_label' => esc_html__( 'View how to do this', 'steed' ),
			'button_link'  => esc_url('http://tallythemes.com/doc-item/steed-theme-documentation/'),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
	),
	// Getting started tab
	'getting_started'     => array(
		'first'  => array(
			'title'               => esc_html__( 'Recommended actions', 'steed' ),
			'text'                => esc_html__( 'We have compiled a list of steps for you to take so we can ensure that the experience you have using one of our products is very easy to follow.', 'steed' ),
			'button_label'        => esc_html__( 'Recommended actions', 'steed' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=steed-welcome&tab=recommended_actions' ) ),
			'is_button'           => false,
			'recommended_actions' => true,
			'is_new_tab'          => false,
		),
		'second' => array(
			'title'               => esc_html__( 'Read full documentation', 'steed' ),
			'text'                => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Steed.', 'steed' ),
			'button_label'        => esc_html__( 'Documentation', 'steed' ),
			'button_link'         => esc_url('http://tallythemes.com/doc-item/steed-theme-documentation/'),
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		'third'  => array(
			'title'               => esc_html__( 'Go to the Customizer', 'steed' ),
			'text'                => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'steed' ),
			'button_label'        => esc_html__( 'Go to the Customizer', 'steed' ),
			'button_link'         => esc_url( admin_url( 'customize.php' ) ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
	),
	// Free vs PRO array.
	'free_pro'            => array(
		'free_theme_name'     => 'Steed',
		'pro_theme_name'      => 'Steed Pro',
		'pro_theme_link'      => esc_url('http://tallythemes.com/product/steed-pro/'),
		/* translators: s - theme name */
		'get_pro_theme_label' => sprintf( __( 'Get %s now!', 'steed' ), 'Steed Pro' ),
		'features'            => array(
			'mobile_ready'  => array(
				'title'       => __( 'Mobile friendly', 'steed' ),
				'description' => __( 'Responsive layout. Works on every device.', 'steed' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			'woocommerce'  => array(
				'title'       => __( 'WooCommerce Compatible', 'steed' ),
				'description' => __( 'Ready for e-commerce. You can build an online store here.', 'steed' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			/*'frontpage'  => array(
				'title'       => __( 'Frontpage Sections', 'steed' ),
				'description' => __( 'Big title, Features, About, Team, Testimonials, Subscribe, Blog, Contact', 'steed' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),*/
			'bg_image'  => array(
				'title'       => __( 'Background image', 'steed' ),
				'description' => __( 'You can use any background image you want.', 'steed' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			/*'section_reordering'  => array(
				'title'       => __( 'Section Reordering', 'steed' ),
				'description' => __( 'The ability to reorganize your Frontpage Sections more easily and quickly.', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),*/
			/*'section_shortcode'  => array(
				'title'       => __( 'Shortcodes for each section', 'steed' ),
				'description' => __( 'Display a frontpage section wherever you like by adding its shortcode in page or post content.', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),*/
			'demo_data'  => array(
				'title'       => __( '1 Click Demo Data', 'steed' ),
				'description' => __( 'In Steed PRO we have included automatic 1 chick demo data import functionality. SO you can make your site just like the theme demo in a moment.', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			'color'  => array(
				'title'       => __( 'Fully Customizable Colors', 'steed' ),
				'description' => __( 'Change colors for the header overlay, header text and navbar.', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			'header_options'  => array(
				'title'       => __( 'Advance Header Options', 'steed' ),
				'description' => __( 'Change header elements color, background, padding, enable or disable elements easily from theme customize.', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			'footer_options'  => array(
				'title'       => __( 'Advance Footer Options', 'steed' ),
				'description' => __( 'Change Footer elements color, background, padding, enable or disable elements easily from theme customize.', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			'google_font'  => array(
				'title'       => __( 'Use any Google font', 'steed' ),
				'description' => __( 'Add google fonts for Headting, Menu and body copy.', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			'remove_credit'  => array(
				'title'       => __( 'Remove Footer Credit', 'steed' ),
				'description' => __( 'Remove Footer Credit easily from theme Customize', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			'support'  => array(
				'title'       => __( 'Quality Support', 'steed' ),
				'description' => __( 'Hand to Hand Professional Support by Developers', 'steed' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			
		),
	),
	// Plugins array.
	'recommended_plugins' => array(
		'already_activated_message' => esc_html__( 'Already activated', 'steed' ),
		'version_label'             => esc_html__( 'Version: ', 'steed' ),
		'install_label'             => esc_html__( 'Install and Activate', 'steed' ),
		'activate_label'            => esc_html__( 'Activate', 'steed' ),
		'deactivate_label'          => esc_html__( 'Deactivate', 'steed' ),
		'content'                   => array(
				array('slug' => 'contact-form-7',),
				array('slug' => 'tally-theme-setup',),
				array('slug' => 'instagram-slider-widget',),
				array('slug' => 'meks-easy-ads-widget',),
				array('slug' => 'recent-posts-widget-with-thumbnails',),
				array('slug' => 'wc-responsive-video',),
				array('slug' => 'wp-tab-widget',),
		),
	),
	// Required actions array.
	'recommended_actions' => array(
		'install_label'    => esc_html__( 'Install and Activate', 'steed' ),
		'activate_label'   => esc_html__( 'Activate', 'steed' ),
		'deactivate_label' => esc_html__( 'Deactivate', 'steed' ),
		'content'          => array(
			'tally-theme-setup'        => array(
				'title'       => 'Tally Theme Setup',
				'description' => __( 'Import Demo Data to make your new site just like the theme demo.', 'steed' ),
				'check'       => defined( 'TALLYTHEMESETUP__PLUGIN_URL' ),
				'plugin_slug' => 'tally-theme-setup',
				'id'          => 'tally-theme-setup',
			),

		),
	),
);
steed_About_Page::init( apply_filters( 'steed_about_page_array', $config ) );






function steed_theme_info_customize_register( $wp_customize ) {

	if ( ! class_exists( 'steed_Control_Upsell_Theme_Info' ) ) {
		return;
	}

	$wp_customize->add_section(
		'steed_theme_info_main_section', array(
			'title'    => esc_html__( 'View PRO Features', 'steed' ),
			'priority' => 0,
		)
	);

	$wp_customize->add_setting(
		'steed_theme_info_main_section', array(
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		new steed_Control_Upsell_Theme_Info(
			$wp_customize, 'steed_theme_info_main_section', array(
				'section'            => 'steed_theme_info_main_section',
				'priority'           => 100,
				'options'            => array(
					esc_html__( 'Use any Google font', 'steed' ),
					esc_html__( 'Fully Customizable Colors', 'steed' ),
					esc_html__( 'Remove Footer Credit', 'steed' ),
					esc_html__( 'Quality Support', 'steed' ),
				),
				'explained_features' => array(
					esc_html__( 'Add google fonts for Headting, Menu and body copy.', 'steed' ),
					esc_html__( 'Change colors for the header overlay, header text and navbar.', 'steed' ),
					esc_html__( 'Remove Footer Credit easily from theme Customize', 'steed' ),
					esc_html__( 'Hand to Hand Professional Support by Developers', 'steed' ),
				),
				'button_url'         => esc_url( 'http://tallythemes.com/product/steed-pro/' ),
				'button_text'        => esc_html__( 'Get the PRO version!', 'steed' ),
			)
		)
	);

}

add_action( 'customize_register', 'steed_theme_info_customize_register', 10 );