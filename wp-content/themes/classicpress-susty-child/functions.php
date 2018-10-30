<?php

/**
 * Stylesheet version (cache buster)
 */
function cp_susty_get_asset_version() {
	return '20181029.2';
}

/**
 * Enqueue parent theme's style.css
 */
function cp_susty_enqueue_parent_theme_styles() {
	wp_enqueue_style(
		'cp-susty-parent-style',
		get_template_directory_uri() . '/style.css',
		[],
		cp_susty_get_asset_version()
	);
}
add_action( 'wp_enqueue_scripts', 'cp_susty_enqueue_parent_theme_styles' );

/**
 * Override the way ClassicPress includes the theme's stylesheet so that we can
 * add our own version string
 */
function cp_susty_override_style_css_version( $html, $handle, $href, $media ) {
	if ( $handle !== 'susty-style' ) {
		return $html;
	}

	$ver = cp_susty_get_asset_version();
	return preg_replace(
		'#\?ver=[^\'"]+([\'"])#',
		'?ver=' . $ver . '$1',
		$html
	);
}
add_filter( 'style_loader_tag', 'cp_susty_override_style_css_version', 10, 4 );
