<?php

/**
 * During local dev, avoid infinite loops in the network admin redirect.
 *
 * We've already overridden `network_admin_url()` (via `site_url`), but the
 * default behavior will check this URL against the URL defined in the
 * database, which leads to an infinite redirect.
 */
function cpnet_redirect_network_admin_request( $redirect ) {
	if ( ! WP_DEBUG || ! $redirect ) {
		// Nothing to do.
		return $redirect;
	}

	$network_admin_url = trailingslashit( network_admin_url() );

	$request_url = trailingslashit(
		( is_ssl() ? 'https://' : 'http://' )
		. $_SERVER['HTTP_HOST']
		. $_SERVER['REQUEST_URI']
	);

	if ( substr( $request_url, 0, strlen( $network_admin_url ) ) !== $network_admin_url ) {
		// This is a valid redirect, for example, trying to access network
		// admin from a secondary site.
		return true;
	}

	// This is not a valid redirect.
	return false;
}
add_filter( 'redirect_network_admin_request', 'cpnet_redirect_network_admin_request' );
