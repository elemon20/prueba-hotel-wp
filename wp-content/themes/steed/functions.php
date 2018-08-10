<?php
/**
 * Steed functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Steed
 */
define("STEED_VERSION", "3.4.7");

if(!defined("STEED_THEME_ID")) { define("STEED_THEME_ID", "steed1"); }
$GLOBALS['steed_STD_theme_mod_data'] = array();

if(file_exists(get_stylesheet_directory().'/includes/php/customize-std.php')){
	$GLOBALS['steed_STD_theme_mod_data'] = include(get_stylesheet_directory().'/includes/php/customize-std.php');
}elseif(file_exists(get_template_directory().'/includes/php/customize-std.php')){
	$GLOBALS['steed_STD_theme_mod_data'] = include(get_template_directory().'/includes/php/customize-std.php');
}

function steed_theme_mod($id, $std = NULL){
	$mods = get_theme_mods();
	$array_data = $GLOBALS['steed_STD_theme_mod_data'];
	$std_data_pre = (isset($array_data[$id])) ? $array_data[$id] : NULL;
	
	//check if the data alreay in the database or send STD data to output
	if(isset($mods[$id])){
		$std_data = $std;	
	}else{
		$std_data = ($std_data_pre != '') ? $std_data_pre : $std;	
	}
	
	if(get_theme_mod($id)){
		return get_theme_mod($id, $std_data);
	}else{
		return $std_data;
	}
}

function steed_theme_mod_as_array(){
	$mods = get_theme_mods();
	$std = $GLOBALS['steed_STD_theme_mod_data'];
	
	$result = array_merge($std, $mods);
	
	unset($result[0]);
	unset($result['custom_css_post_id']);
	unset($result['nav_menu_locations']);
	
	var_export($result);
}


function steed_customiz_std($id, $std = NULL){
	$array_data = $GLOBALS['steed_STD_theme_mod_data'];
	$std_data_pre = (isset($array_data[$id])) ? $array_data[$id] : NULL;
	$std_data = ($std_data_pre != '') ? $std_data_pre : $std;
	
	return $std_data;
}


if ( ! function_exists( 'steed_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function steed_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Steed, use a find and replace
	 * to change 'steed' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'steed', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	
	
	/*
	* Enable support for custom logo.
	*
	*/
	/*add_theme_support( 'custom-logo', array(
		'height'      => 90, 
		'width'       => 200, 
		'flex-height' => true, //true, false
	));*/
	
	
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/*
	* Declare WooCommerce support
	*/
	add_theme_support( 'woocommerce' );
	
	add_post_type_support( 'page', 'excerpt' );
	
	
	/**
	 * loeading elements classes
	 */
	require get_template_directory() . '/includes/elements/element.php';
	
	
}
endif;
add_action( 'after_setup_theme', 'steed_setup' );


add_filter('tallythemesetup_load_v2', '__return_true');


/*
	Steed Image size
-----------------------------------------*/
add_image_size('steed_400x300', 400, 300, true);
add_image_size('steed_400x400', 400, 400, true);

add_image_size('steed_500x400', 500, 400, true);
add_image_size('steed_500x500', 500, 500, true);

add_image_size('steed_600x500', 600, 500, true);
add_image_size('steed_600x600', 600, 600, true);

add_image_size('steed_700x600', 700, 600, true);
add_image_size('steed_700x700', 700, 700, true);


/*
	Add Image size to wordpress Media Popup
-----------------------------------------*/
add_filter('image_size_names_choose','steed_image_size_names',10,1);
function steed_image_size_names($sizes){

    $sizes['steed_400x300']= 'Steed 400x300';
	$sizes['steed_400x400']= 'Steed 400x400';
	
	$sizes['steed_500x400']= 'Steed 500x400';
	$sizes['steed_500x500']= 'Steed 500x500';
	
	$sizes['steed_600x500']= 'Steed 600x500';
	$sizes['steed_600x600']= 'Steed 600x600';
	
	$sizes['steed_700x600']= 'Steed 700x600';
	$sizes['steed_700x700']= 'Steed 700x700';

    return $sizes;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function steed_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'steed_content_width', 1200 );
}
add_action( 'after_setup_theme', 'steed_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function steed_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'steed' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'steed' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action( 'widgets_init', 'steed_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function steed_scripts() {
	wp_register_style( 'magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/magnific-popup.css', array(), '1.0.1' );
	wp_enqueue_style( 'magnific-popup');
	wp_register_script( 'magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/jquery.magnific-popup.min.js', array('jquery'),'1.0.1',true );
	wp_enqueue_script( 'magnific-popup');
	
	/*wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/flexslider/flexslider.css', array(), '1.0.1' );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/flexslider/jquery.flexslider-min.js', array('jquery'),'1.0.1',true );
	
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/slick/slick.css', array(), '1.8.0' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css', array(), '1.8.0' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/slick/slick.js', array('jquery'),'1.8.0',true );*/
	
	wp_register_script( 'fitvids', get_template_directory_uri() . '/assets/fitvids/jquery.fitvids.js', array('jquery'), '1.1', true );
	wp_enqueue_script( 'fitvids');
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'steed-fonts', steed_fonts_url(), array(), null );
	
	wp_enqueue_style( 'steed-common', get_template_directory_uri() . '/assets/css/common.css', array(), '1.0');
	wp_enqueue_style( 'steed-elements', get_template_directory_uri() . '/assets/css/elements.css', array(), '1.0');
	wp_enqueue_style( 'steed-pc', get_template_directory_uri() . '/assets/css/pc.css', array(), '1.0');
	
	wp_enqueue_style( 'steed-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'steed-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0', true );
	wp_enqueue_script( 'steed-javascript', get_template_directory_uri() . '/assets/js/custom-scripts.js', array('jquery', 'imagesloaded', 'jquery-masonry', 'magnific-popup'), '2.0', true );
	wp_enqueue_script( 'steed-pc', get_template_directory_uri() . '/assets/js/pc.js', array('jquery', 'imagesloaded', 'jquery-masonry', 'magnific-popup'), '2.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	
}
add_action( 'wp_enqueue_scripts', 'steed_scripts' );


add_action( 'customize_preview_init', 'steed_customize_preview_init' );
function steed_customize_preview_init(){
			wp_enqueue_script( 
				  'steed-customize-preview',			//Give the script an ID
				  get_template_directory_uri().'/assets/js/theme-customizer.js',//Point to file
				  array( 'jquery','customize-preview' ),	//Define dependencies
				  '',						//Define a version (optional) 
				  true						//Put script in footer?
			);
}


add_action( 'customize_controls_enqueue_scripts', 'steed_customize_controls_enqueue_scripts' );
function steed_customize_controls_enqueue_scripts(){
	wp_enqueue_style( 'steed-customize-controls', get_template_directory_uri() . '/assets/css/controls-customizer.css', array(), '1.0');
	wp_enqueue_script( 
				  'steed-customize-controls',			//Give the script an ID
				  get_template_directory_uri().'/assets/js/controls-customizer.js',//Point to file
				  array( 'jquery','customize-preview' ),	//Define dependencies
				  '',						//Define a version (optional) 
				  true						//Put script in footer?
	);
}


/**
 * Enqueue Custom/Dynamic CSS
 */
function steed_custom_scripts(){
	$custom_css = apply_filters('steed_custom_css', steed_custom_css());
	
	wp_add_inline_style( 'steed-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'steed_custom_scripts', 11 );


function steed_admin_enqueue_scripts() {
        wp_enqueue_style( 'steed-admin-css', get_template_directory_uri() . '/assets/css/steed-admin.css', false, '1.' );
}
add_action( 'admin_enqueue_scripts', 'steed_admin_enqueue_scripts' );


function steed_sanitize_rgba( $value ) {
		// If empty or an array return transparent
		if ( empty( $value ) || is_array( $value ) ) {
			return '';
		}
		// If string does not start with 'rgba', then treat as hex
		// sanitize the hex color and finally convert hex to rgba
		if ( false === strpos( $value, 'rgba' ) ) {
			return sanitize_hex_color( $value  );
		}
		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$value = str_replace( ' ', '', $value );
		sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		
		return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}


/**
 * Filter the front page template so it's bypassed entirely if the user selects
 * to display blog posts on their homepage instead of a static page.
 */
function steed_filter_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'steed_filter_front_page_template' );


/**
 * LOad custom customizer control Alpha_Color_Control
 */
if(!class_exists('steed_Customize_Alpha_Color_Control')){
	require get_template_directory() . '/includes/vendors/alpha-color-picker/alpha-color-picker.php';
}


/**
 * Customizer steed_Control_Upsell_Theme_Info .
 */
require get_template_directory() . '/includes/php/customizer-theme-upsell-control/customizer-theme-upsell-control.php';



/**
 * TI About Page Class
 */
require get_template_directory() . '/includes/vendors/ti-about-page/class-steed-about-page.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/php/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/php/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/php/customizer.php';


/**
 * Welcome Page
 */
require get_template_directory() . '/includes/php/theme-info.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/php/jetpack.php';


/**
 * Load TGM plugin installaer 
 */
require get_template_directory() . '/includes/vendors/class-tgm-plugin-activation.php';
require get_template_directory() . '/includes/php/plugins-list.php';


/**
 * Load WooCommerce Functions
 */
require get_template_directory() . '/includes/php/woocommerce.php';


/**
 * Load Header Build
 */
require get_template_directory() . '/includes/parts/header-1-build.php';

/**
 * Load Footer Build
 */
require get_template_directory() . '/includes/parts/footer-1-build.php';



/**
 * Load elementor templates loader
 */
require get_template_directory() . '/includes/php/elementor-templates.php';



/**
 * Load Contents
 */
require get_template_directory() . '/includes/contents/content-index.php';
require get_template_directory() . '/includes/contents/content-post-item.php';
require get_template_directory() . '/includes/contents/content-404.php';
require get_template_directory() . '/includes/contents/content-archive.php';
require get_template_directory() . '/includes/contents/content-author.php';
require get_template_directory() . '/includes/contents/content-page.php';
require get_template_directory() . '/includes/contents/content-search.php';
require get_template_directory() . '/includes/contents/content-single.php';