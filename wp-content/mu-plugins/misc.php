<?php

/**
 * Return the subdomain associated with a given blog ID.
 *
 * @param int|null $blog_id The blog ID (defaults to the current blog ID).
 * @return string  The blog subdomain (e.g. 'www', 'docs', etc).
 */
function cpnet_subdomain( $blog_id = null ) {
	if ( ! $blog_id ) {
		$blog_id = get_current_blog_id();
	}

	$domain = get_blog_details( $blog_id )->domain;
	return preg_replace( '#\..*$#', '', $domain );
}
