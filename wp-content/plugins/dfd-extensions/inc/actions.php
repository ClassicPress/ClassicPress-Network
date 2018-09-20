<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter('widget_text', 'do_shortcode');

add_filter('user_contactmethods','dfd_add_remove_contactmethods',10,1);

if(!function_exists('dfd_add_remove_contactmethods')) {
	/**
	 * Contact methods filter
	 */
	function dfd_add_remove_contactmethods( $contactmethods ) {
		if(method_exists('Dfd_Theme_Helpers','author_contact_methods')) {
			$contacts = Dfd_Theme_Helpers::author_contact_methods();

			foreach($contacts as $k=>$v) {
				$contactmethods[$k] = $v;
			}

			// Remove Contact Methods
			unset($contactmethods['aim']);
			unset($contactmethods['yim']);
			unset($contactmethods['jabber']);

			return $contactmethods;
		}
	}
}

add_action( 'get_header', 'dfd_remove_admin_bar_offset');

if(!function_exists('dfd_remove_admin_bar_offset')) {
	/*
	 * Remove the admin bar offset
	 */
	function dfd_remove_admin_bar_offset() {
		if( !is_admin() && is_admin_bar_showing() ) {
			remove_action( 'wp_head', '_admin_bar_bump_cb' );
		}
	}
}

add_action('wp_head', 'dfd_head_facebook_metatags');

if(!function_exists('dfd_head_facebook_metatags')) {
	/*
	 * Add og: meta tags for facebook share
	 */
	function dfd_head_facebook_metatags() {
		if(has_post_thumbnail()) {
			$thumb_id = get_post_thumbnail_id();
			$img_src = wp_get_attachment_image_src($thumb_id, 'full');
			if(isset($img_src[0]) && !empty($img_src[0])) {
				echo '<meta property="og:image" content="'.esc_url($img_src[0]).'" />';
			}
			if(isset($img_src[1]) && !empty($img_src[1])) {
				echo '<meta property="og:image:width" content="'.esc_attr($img_src[1]).'" />';
			}
			if(isset($img_src[2]) && !empty($img_src[2])) {
				echo '<meta property="og:image:height" content="'.esc_attr($img_src[2]).'" />';
			}
			echo '<meta property="og:url" content="'.esc_attr(get_permalink()).'" />';
			echo '<meta property="og:title" content="'.esc_attr(get_the_title()).'" />';
		}
	}
	
}

add_action('after_setup_theme', 'dfd_extensions_after_setup_theme');

if(!function_exists('dfd_extensions_after_setup_theme')) {
	/*
	 * Load assets
	 */
	function dfd_extensions_after_setup_theme() {
		add_action('wp_enqueue_scripts', 'dfd_extensions_enqueue_assets');
	}
}

if(!function_exists('dfd_extensions_enqueue_assets')) {
	function dfd_extensions_enqueue_assets() {
		if(class_exists('woocommerce_wpml')) {
			wp_deregister_style('woocommerce_admin_styles');
		}
		wp_deregister_style('prettyphoto');
		wp_deregister_style('woocommerce_prettyPhoto_css');
		wp_deregister_script('isotope');
		wp_deregister_script('prettyphoto');
		wp_deregister_script('prettyPhoto');
		wp_deregister_script('ult-slick');
	}
}

add_action('login_head', 'dfd_custom_login_logo');

if(!function_exists('dfd_custom_login_logo')) {
	/**
	 * Login page cstom styles
	 */
	function dfd_custom_login_logo() {
		include_once(DFD_EXTENSIONS_PLUGIN_PATH.'templates/admin/login-page.php');
	}
}

add_action('wp_footer', 'dfd_head_montserrat_css', 100);

if(!function_exists('dfd_head_montserrat_css') && defined('DFD_EXTENSIONS_PLUGIN_URL')) {
	function dfd_head_montserrat_css() {
		echo '<link rel="stylesheet" href="'.DFD_EXTENSIONS_PLUGIN_URL.'assets/fonts/fonts.css" />';
	}
}

//$this_file = __FILE__;
//$update_check = 'http://dfd.name/plugins/dfd-extensions/dfd-extensions.chk';
//require_once('gill-updates.php');