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

/* Add Twitter card tags for social sharing. */
add_action( 'wp_head', 'cp_insert_twittercard_tags', 0 );
function cp_insert_twittercard_tags() {

	// Bring $post object into scope.
	global $post;

	// Set defaults for Twitter shares.
	$url   = get_bloginfo( 'url' );
	$title = get_bloginfo( 'name' );
	$desc  = get_bloginfo( 'description' );
	$image = 'https://docs.classicpress.net/wp-content/classicpress/logos/icon-gradient-600.png';

	// If on a post or page, reset defaults.
	if( is_single() || is_page() ) {

		// Update URL to current post/page.
		$url = get_permalink();

		// Update title only if $post has non-empty title.
		$title = ( get_the_title() ) ? get_the_title() : $title;

		// Update description only if $post has non-empty excerpt.
		if ( ! empty( $post->post_excerpt ) ) {
			$desc = $post->post_excerpt;
		}

		// Update image if post/page has a thumbnail.
		if ( has_post_thumbnail() ) {
			$image_properties = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) , 'medium_large' );
			$image = $image_properties[0];
		}

	}

	// Assemble the meta tag markup.
	$markup  = '<meta name="twitter:card" value="summary_large_image" />' . "\n";
	$markup .= '<meta name="twitter:url" value="' . $url . '" />' . "\n";
	$markup .= '<meta name="twitter:title" value="' . $title . '" />' . "\n";
	$markup .= '<meta name="twitter:description" value="' . $desc . '" />' . "\n";
	$markup .= '<meta name="twitter:image" value="' . $image . '" />' . "\n";
	$markup .= '<meta name="twitter:image:alt" value="' . $title . '" />' . "\n";
	$markup .= '<meta name="twitter:site" value="@getclassicpress" />' . "\n";

	// Add creator tag if author profile has a Twitter username.
	if( get_the_author_meta( 'twitter' ) ) {
		$markup .= '<meta name="twitter:creator" value="@'. str_replace( '@', '', get_the_author_meta( 'twitter' ) ) .'" />' . "\n";
	}

	// Print the tags.
	echo $markup;

}
