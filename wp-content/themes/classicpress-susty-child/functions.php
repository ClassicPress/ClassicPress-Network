<?php

/**
 * Stylesheet version (cache buster)
 */
function cp_susty_get_asset_version() {
	return '20181112';
}

/**
 * Enqueue scripts and styles
 */
function cp_susty_enqueue_parent_theme_styles() {
	wp_enqueue_style(
		'cp-susty-parent-style',
		get_template_directory_uri() . '/style.css',
		[],
		cp_susty_get_asset_version()
	);
	wp_enqueue_script(
		'cp-susty-menu',
		get_stylesheet_directory_uri() . '/js/scripts.js',
		[ 'jquery' ],
		array( 'jquery' ),
		cp_susty_get_asset_version()
	);

	# Add menu to first submenu or as last menu item on mobile
	$searchform = '<li class="menu-item">'
		. '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '">'
		. '<label>'
		. '<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>'
		. '<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search …', 'placeholder' ) . '" value="' . get_search_query() . '" id="s" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />'
		. '</label>'
		. '</form>'
		. '</li>';
	wp_localize_script( 'cp-susty-menu', 'MENU_ITEM', array(
		'searchform' => $searchform,
	) );

	# Live search
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'search-complete', get_stylesheet_directory_uri() . '/js/search.js', array( 'jquery', 'jquery-ui-autocomplete' ), null, true );
	wp_localize_script( 'search-complete', 'SEARCHCOMPLETE', array(
		'rest_url' => esc_url_raw( rest_url() ),
		'search_nonce' => wp_create_nonce( 'wp_rest' ),
	) );
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


/* REGISTER CUSTOM SEARCH REST API ROUTE */
function cp_register_search_route() {
    register_rest_route( 'cp/v1', '/search', array(
        'methods'  => 'GET',
        'callback' => 'cp_ajax_search',
    ) );
}
add_action( 'rest_api_init', 'cp_register_search_route' );

/* PREPARE SEARCH RESULTS FOR REST API */
# https://benrobertson.io/wordpress/wordpress-custom-search-endpoint
function cp_ajax_search( $request ) {
	$posts = [];
	$results = [];
	// check for a search term
	if ( isset( $request['query'] ) ) {
		// get posts
		$posts = get_posts( [
			'posts_per_page' => 20,
			'post_type' => ['page', 'post'],
			's' => $request['query'],
		] );
		// set up the data to return
		foreach( $posts as $post ) {
			$results[] = [
				'title' => $post->post_title,
				'link' => get_permalink( $post->ID )
			];
		}
	}
	if ( empty( $results ) ) {
		return new WP_Error( 'front_end_ajax_search', 'No results' );
	}
	return rest_ensure_response( $results );
}
