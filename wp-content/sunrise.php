<?php

add_filter( 'wp_redirect', function( $location, $status ) {
	error_log( json_encode( array(
		'src' => 'wp_redirect',
		'location' => $location,
		'status' => $status,
		'trace' => debug_backtrace()
	) ) );
	return $location;
}, 10, 2 );

add_filter( 'pre_get_site_by_path', function( $site, $domain, $path, $segments, $paths ) {
	$src = 'pre_get_site_by_path';
	error_log( json_encode( compact( 'src', 'site', 'domain', 'path', 'segments', 'paths' ) ) );
	return $site;
}, 10, 5 );

/**
 * Override default multisite "get site" logic, especially for local development.
 *
 * Look at the requested domain only, and find the matching site (stored in the
 * database as `www.classicpress.net` for example).
 *
 * We require every site on this network, including www., to be a subdomain of
 * the same domain.  This code takes advantage of this structure, and also
 * verifies that the default site is set correctly so that redirecting to it
 * will work (it must include a protocol and the `www.` prefix).
 */
function cpnet_override_get_site( $site, $domain, $path, $segments, $paths ) {
	if ( ! preg_match( '#^https?://www\.#', PRIMARY_SITE_URL ) ) {
		wp_die(
			'The PRIMARY_SITE_URL config variable must include a protocol'
			. " ('http:' or 'https:') and the hostname must begin with 'www.'"
		);
	}

	$domain = cpnet_normalize_hostname( $domain );

	$installation_domain = preg_replace( '#^www\.#', '', DOMAIN_CURRENT_SITE );
	$installation_domain_match = preg_quote( $installation_domain );

	// Extract the subdomain, or trigger a redirect to the default site.
	if ( ! preg_match(
		'#^([a-z0-9-]+)\.' . $installation_domain_match . '$#',
		$domain,
		$matches
	) ) {
		// `return false` is code for "redirect to the default site" here.  See
		// `ms_load_current_site_and_network` and `get_site_by_path`.
		return false;
	}

	$subdomain = $matches[1];
	// Sites are stored in the database as `subdomain.classicpress.net`.
	$sites = get_sites( array(
		'domain' => $subdomain . '.classicpress.net',
		'path'   => '/',
		'number' => 1,
	) );
	return $sites[0] ?? false;
}
add_filter( 'pre_get_site_by_path', 'cpnet_override_get_site', 10, 5 );
