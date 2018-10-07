<?php

/**
 * During local development, cancel the canonical redirect from a URL with a
 * port to the same hostname without a port (WordPress being unhelpful).
 */
function cpnet_override_redirect_canonical( $redirect_url, $requested_url ) {
	if ( ! WP_DEBUG || empty( parse_url( $requested_url, PHP_URL_PORT ) ) ) {
		return $redirect_url;
	}

	$requested_host = cpnet_normalize_hostname( $requested_url );
	$redirect_host = cpnet_normalize_hostname( $redirect_url );

	if ( preg_match(
		'#^' . preg_quote( $redirect_host, '#' ) . ':\d+$#',
		$requested_host
	) ) {
		// Unhelpful redirect; skip it.
		return false;
	}

	// This is not the redirect we're looking for.
	return $redirect_url;
}
add_filter( 'redirect_canonical', 'cpnet_override_redirect_canonical', 10, 2 );

/**
 * Override default multisite "get site" logic for local development.
 *
 * Look at the requested domain only, and find the matching site (stored in the
 * database as `www.classicpress.net` for example).
 *
 * We require every site on this network, including www., to be a subdomain of
 * the same domain.  This code takes advantage of this structure, and also
 * verifies that the primary site is set correctly so that redirecting to it
 * will work (it must include a protocol and the `www.` prefix).
 */
function cpnet_override_get_site( $site, $domain, $path, $segments, $paths ) {
	if ( ! preg_match( '#^https?://www\.#', PRIMARY_SITE_URL ) ) {
		wp_die(
			'The PRIMARY_SITE_URL config variable must include a protocol'
			. " ('http:' or 'https:') and the hostname must begin with 'www.'"
		);
	}

	if ( ! WP_DEBUG ) {
		return $site;
	}

	$domain = cpnet_normalize_hostname( $domain );

	// Extract the subdomain, or trigger a redirect to the primary site.
	if ( ! preg_match(
		'#^([a-z0-9-]+)\.' . preg_quote( INSTALLATION_ROOT_DOMAIN ) . '$#',
		$domain,
		$matches
	) ) {
		// `return false` is code for "redirect to the primary site" here.  See
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

/**
 * Overrides `site_url()` and `get_site_url()` for local development.
 *
 * Necessary for logging in locally, for example.
 */
function cpnet_override_site_url( $url, $path, $scheme, $blog_id ) {
	if ( ! WP_DEBUG ) {
		return $url;
	}

	$url = set_url_scheme( $url, parse_url( PRIMARY_SITE_URL, PHP_URL_SCHEME ) );
	$url = preg_replace(
		'#/([a-z0-9-]+)\.classicpress\.net(/|$)#',
		'/\1.' . INSTALLATION_ROOT_DOMAIN . '\2',
		$url
	);

	return $url;
}
add_filter( 'site_url', 'cpnet_override_site_url', 10, 4 );
