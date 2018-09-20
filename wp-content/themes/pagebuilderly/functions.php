<?php
/**
 * pagebuilderly functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pagebuilderly
 */

if ( ! function_exists( 'pagebuilderly_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pagebuilderly_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on pagebuilderly, use a find and replace
	 * to change 'pagebuilderly' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'pagebuilderly', get_template_directory() . '/languages' );

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
	add_image_size( 'pagebuilderly-full-thumb', 768, 0, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'pagebuilderly' ),
	) );

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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pagebuilderly_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'pagebuilderly_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pagebuilderly_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pagebuilderly_content_width', 640 );
}
add_action( 'after_setup_theme', 'pagebuilderly_content_width', 0 );

/**
 *
 * Add Custom editor styles
 *
 */
function pagebuilderly_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'pagebuilderly_add_editor_styles' );

/**
 *
 * Load Google Fonts
 *
 */
function pagebuilderly_google_fonts_url(){

    $fonts_url  = '';
    $Lato = _x( 'on', 'Lato font: on or off', 'pagebuilderly' );
    $Montserrat      = _x( 'on', 'Montserrat font: on or off', 'pagebuilderly' );
 
    if ( 'off' !== $Lato || 'off' !== $Montserrat ){

        $font_families = array();
 
        if ( 'off' !== $Lato ) {

            $font_families[] = 'Lato:300,400,400i,700';

        }
 
        if ( 'off' !== $Montserrat ) {

            $font_families[] = 'Montserrat:400,400i,500,600,700';

        }
        
 
        $query_args = array(

            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    }
 
    return esc_url_raw( $fonts_url );
}

function pagebuilderly_enqueue_googlefonts() {

    wp_enqueue_style( 'pagebuilderly-googlefonts', pagebuilderly_google_fonts_url(), array(), null );
}

add_action( 'wp_enqueue_scripts', 'pagebuilderly_enqueue_googlefonts' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pagebuilderly_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__('Header Widget (Right)', 'pagebuilderly'),
		'id' => 'header_widget_right',
		'before_widget' => '<div class="header-widgets">',
		'description'   => esc_html__( 'Widgets here will appear inside the header image, to the right', 'pagebuilderly' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

	register_sidebar( array(
		'name' => esc_html__('Top Widgets: Full Width', 'pagebuilderly'),
		'id' => 'top_widget_fullwidth',
		'before_widget' => '<div class="top-widgets">',
		'description'   => esc_html__( 'Widgets here will appear under the header image', 'pagebuilderly' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );


	register_sidebar( array(
		'name' => esc_html__('Top Widgets: left', 'pagebuilderly'),
		'id' => 'top_widget_left',
		'before_widget' => '<div class="top-widgets">',
		'description'   => esc_html__( 'Widgets here will appear under the header image', 'pagebuilderly' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Top Widgets: middle', 'pagebuilderly'),
		'id' => 'top_widget_middle',
		'description'   => esc_html__( 'Widgets here will appear under the header image', 'pagebuilderly' ),
		'before_widget' => '<div class="top-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Top Widgets: right', 'pagebuilderly'),
		'id' => 'top_widget_right',
		'before_widget' => '<div class="top-widgets">',
		'after_widget' => '</div>',
		'description'   => esc_html__( 'Widgets here will appear under the header image', 'pagebuilderly' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );


	register_sidebar( array(
		'name' => esc_html__('Footer Widget One', 'pagebuilderly'),
		'id' => 'footer_widget_left',
		'before_widget' => '<div class="footer-widgets">',
		'description'   => esc_html__( 'Widgets here will appear in the footer', 'pagebuilderly' ),
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Footer Widget Two', 'pagebuilderly'),
		'id' => 'footer_widget_middle',
		'description'   => esc_html__( 'Widgets here will appear in the footer', 'pagebuilderly' ),
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );

		register_sidebar( array(
		'name' => esc_html__('Footer Widget Three', 'pagebuilderly'),
		'id' => 'footer_widget_right',
		'before_widget' => '<div class="footer-widgets">',
		'after_widget' => '</div>',
		'description'   => esc_html__( 'Widgets here will appear in the footer', 'pagebuilderly' ),
		'before_title' => '<h3>',
		'after_title' => '</h3>',
		) );


}
add_action( 'widgets_init', 'pagebuilderly_widgets_init' );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function pagebuilderly_custom_excerpt_length( $length ) {
    return 35;
}
add_filter( 'excerpt_length', 'pagebuilderly_custom_excerpt_length', 999 );


/**
 * Enqueue scripts and styles.
 */
function pagebuilderly_scripts() {
	wp_enqueue_style( 'pagebuilderly-style', get_stylesheet_uri() );
	wp_enqueue_style( 'pagebuilderly-font-awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_script( 'pagebuilderly-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'pagebuilderly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'pagebuilderly-script', get_template_directory_uri() . '/js/pagebuilderly.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pagebuilderly_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/*TGA activation*/

require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Free Seo Optimized Responsive Theme for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pagebuilderly_register_required_plugins' );

function pagebuilderly_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'        => 'Beaver Builder',
			'slug'        => 'beaver-builder-lite-version',
			'is_callable' => 'wpseo_init',
			),

		);

	$config = array(
		'id'           => 'pagebuilderly',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


		);

	tgmpa( $plugins, $config );
}




/**
 * Copyright and License for Upsell button by Justin Tadlock - 2016 © Justin Tadlock. customizer button https://github.com/justintadlock/trt-customizer-pro
 */
require_once( trailingslashit( get_template_directory() ) . 'justinadlock-customizer-button/class-customize.php' );


/**
 * Compare page CSS
 */

function pagebuilderly_comparepage_css($hook) {
	if ( 'appearance_page_pagebuilderly-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'pagebuilderly-custom-style', get_template_directory_uri() . '/css/compare.css' );
}
add_action( 'admin_enqueue_scripts', 'pagebuilderly_comparepage_css' );

/**
 * Compare page content
 */

add_action('admin_menu', 'pagebuilderly_themepage');
function pagebuilderly_themepage(){
	$theme_info = add_theme_page( __('PageBuilderly','pagebuilderly'), __('PageBuilderly','pagebuilderly'), 'manage_options', 'pagebuilderly-info.php', 'pagebuilderly_info_page' );
}

function pagebuilderly_info_page() {
	$user = wp_get_current_user();
	?>
	<div class="wrap about-wrap pagebuilderly-add-css">
		<div>
			<h1>
				<?php echo esc_html__('Welcome to PageBuilderly!','pagebuilderly'); ?>
			</h1>

			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo esc_html__("Contact Support", "pagebuilderly"); ?></h3>
						<p><?php echo esc_html__("Getting started with a new theme can be difficult, if you have issues with PageBuilderly then throw us an email.", "pagebuilderly"); ?></p>
						<p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/help-contact/', 'pagebuilderly'); ?>" class="button button-primary">
							<?php echo esc_html__("Contact Support", "pagebuilderly"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo esc_html__("View our other themes", "pagebuilderly"); ?></h3>
						<p><?php echo esc_html__("Do you like our concept but feel like the design doesn't fit your need? Then check out our website for more designs.", "pagebuilderly"); ?></p>
						<p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/wordpress-themes/', 'pagebuilderly'); ?>" class="button button-primary">
							<?php echo esc_html__("View All Themes", "pagebuilderly"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php echo esc_html__("Premium Edition", "pagebuilderly"); ?></h3>
						<p><?php echo esc_html__("If you enjoy PageBuilderly and want to take your website to the next step, then check out our premium edition here.", "pagebuilderly"); ?></p>
						<p><a target="blank" href="<?php echo esc_url('https://superbthemes.com/pagebuilderly/', 'pagebuilderly'); ?>" class="button button-primary">
							<?php echo esc_html__("Read More", "pagebuilderly"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php echo esc_html__("Free Vs Premium","pagebuilderly"); ?></h2>
		<div class="pagebuilderly-button-container">
			<a target="blank" href="<?php echo esc_url('https://superbthemes.com/pagebuilderly/', 'pagebuilderly'); ?>" class="button button-primary">
				<?php echo esc_html__("Read Full Description", "pagebuilderly"); ?>
			</a>
			<a target="blank" href="<?php echo esc_url('https://superbthemes.com/demo/pagebuilderly/', 'pagebuilderly'); ?>" class="button button-primary">
				<?php echo esc_html__("View Theme Demo", "pagebuilderly"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead>
				<tr>
					<th><strong><?php echo esc_html__("Theme Feature", "pagebuilderly"); ?></strong></th>
					<th><strong><?php echo esc_html__("Basic Version", "pagebuilderly"); ?></strong></th>
					<th><strong><?php echo esc_html__("Premium Version", "pagebuilderly"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php echo esc_html__("Background Color/Image", "pagebuilderly"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Header Background Color/Image	", "pagebuilderly"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Header Colors", "pagebuilderly"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Navigation Colors	", "pagebuilderly"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Hide Header Text	", "pagebuilderly"); ?></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Premium Support", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Only Show Header On Front Page", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("1x Header Button", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("14 Navigation Social Media Icons", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Header Text", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom header Height", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Only Show Top Widgets On Front Page", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Header Widgets Colors", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Top Widget Colors", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Footer Copyright Text", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Social Media Icons Color	", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Header Button Colors", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Blog Page Colors", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Posts Colors", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Page Colors", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>
				<tr>
					<td><?php echo esc_html__("Custom Footer Colors	", "pagebuilderly"); ?></td>
					<td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo esc_html__("No", "pagebuilderly"); ?>" /></span></td>
					<td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo esc_html__("Yes", "pagebuilderly"); ?>" /></span></td>
				</tr>

			</tbody>
		</table>

	</div>
	<?php
}


