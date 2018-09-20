<?php
/**
 * DFD themes functions
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define('DFD_THEME_SETTINGS_NAME', 'native');

if (!isset($content_width)) {
	$content_width = 1200;
}

// Make theme available for translation
load_theme_textdomain('dfd-native', get_template_directory() . '/lang');

# Including theme components
require_once get_template_directory().'/inc/includes.php';

add_action('after_setup_theme', 'dfd_themes_setup_theme');

if (!function_exists('dfd_themes_setup_theme')) {
	/**
	 * Enqueues core theme functionality
	 *
	 * @return true
	 */
	function dfd_themes_setup_theme() {

		// Enqueue theme scripts and styles
		add_action('wp_enqueue_scripts', 'dfd_themes_scripts', 100);
		
		// Enqueue admin scripts and styles
		add_action('admin_enqueue_scripts', 'dfd_themes_admin_scripts');

		add_filter('wp_get_attachment_link', 'dfd_kadabra_prettyadd');
		
		add_filter('excerpt_length', 'dfd_kadabra_excerpt_length', 999 );
		add_filter('next_posts_link_attributes', 'dfd_kadabra_posts_link_attributes_1');
		add_filter('previous_posts_link_attributes', 'dfd_kadabra_posts_link_attributes_2');
		
		// Disable default gallery style
		add_filter( 'use_default_gallery_style' , 'dfd_kadabra_use_default_gallery_style_filter' );
		
		// Register wp_nav_menu() menus
		register_nav_menus(array(
			'primary_navigation' => esc_html__('Primary Navigation', 'dfd-native'),
			'top_left_navigation' => esc_html__('Top Left Navigation (for header style 3 and 4)', 'dfd-native'),
			'top_right_navigation' => esc_html__('Top Right Navigation (for header style 3 and 4)', 'dfd-native'),
			'second_builder_navigation' => esc_html__('Second Navigation (for header builder)', 'dfd-native'),
			'third_builder_navigation' => esc_html__('Third Navigation (for header builder)', 'dfd-native'),
			'additional_header_menu' => esc_html__('Additional header navigation', 'dfd-native'),
			'footer_menu' => esc_html__('Footer navigation', 'dfd-native'),
		));

		// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
		add_theme_support('post-thumbnails');

		// Add post formats (http://codex.wordpress.org/Post_Formats)
		add_theme_support('post-formats', array('gallery','video','quote','audio','link'));
		
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );

		add_post_type_support('page', 'excerpt');
		
		// Set default values for the upload media box
		add_action('switch_theme','dfd_theme_setup');
		
		if(class_exists('WooCommerce')) {
			dfd_themes_woocommerce_support();
		}
		
		/*
		Visual Composer theme integration
		*/
		if ( class_exists( 'Vc_Manager', false ) ) {

			if ( function_exists( 'vc_set_as_theme' ) ) {
				add_action( 'vc_before_init', 'dfd_vc_set_as_theme' );
				function dfd_vc_set_as_theme() {
					vc_set_as_theme();
				}
			}

			if ( function_exists( 'vc_set_default_editor_post_types' ) ) {
				vc_set_default_editor_post_types( array( 'page', 'post', 'portfolio' ) );
			}
		}
	}
}

if (!function_exists('dfd_theme_setup')) {
	/**
	 * Defines image sizes and Wishlist plugin shortcode position
	 *
	 * @return true
	 */
	function dfd_theme_setup() {
		// Set default values for the upload media box
		update_option( 'image_default_link_type', 'none' );
		update_option( 'image_default_size', 'large' );
		update_option( 'yith_wcwl_button_position', 'shortcode' );
		$custom_row_class = get_option('ultimate_custom_vc_row');
		if(!$custom_row_class) {
			update_option('ultimate_custom_vc_row', 'vc-row-wrapper');
		}
	}
}

if (!function_exists('dfd_themes_woocommerce_support')) {
	/**
	 * WooCommerce support
	 *
	 * @return true
	 */
	function dfd_themes_woocommerce_support() {
		add_theme_support( 'woocommerce' );

		# star rating for proucts in loop
		add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
		if (function_exists('dfd_woocommerce_disable_styles')) {
			dfd_woocommerce_disable_styles();
		}
		
		# Hook in on activation
		global $pagenow;
		if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
			add_action( 'init', 'dfd_kadabra_woocommerce_image_dimensions', 1 );
		}
	}
}