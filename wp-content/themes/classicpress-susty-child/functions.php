<?php

add_action( 'wp_enqueue_scripts', 'susty_parent_theme_enqueue_styles' );

/**
 * Enqueue Parent style.css
 */
function susty_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
