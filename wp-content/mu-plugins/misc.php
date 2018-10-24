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

/**
 * Redirect URLs.  No need for a plugin for this.
 */
$cpnet_redirects = [
	'www' => [
		'/article/tutorial-resolving-merge-conflicts-on-the-classicpress-github/'
		=> '/2018/09/11/tutorial-resolving-merge-conflicts-on-the-classicpress-github/',

		'/article/committee-meeting-friday-7th-september-2018/'
		=> '/2018/09/08/committee-meeting-a-focus-on-v1-roadblocks/',

		'/article/wordpress-gutenberg-the-500-million-cost-to-business/'
		=> '/2018/08/28/wordpress-gutenberg-the-500-million-cost-to-business/',

		'/article/classicpress-a-hard-fork-of-wordpress-without-gutenberg/'
		=> '/2018/08/20/classicpress-a-fork-of-wordpress-without-gutenberg/',
	],
	'docs' => [
		'/testing-classicpress/get-started/'
		=> '/testing-classicpress/getting-started/',
	],
];
function cpnet_process_redirects() {
	global $cpnet_redirects;
	$redirects = $cpnet_redirects[ cpnet_subdomain() ] ?? [];
	$parts = parse_url( $_SERVER['REQUEST_URI'] );
	$path = trailingslashit( $parts['path'] );
	if ( isset( $redirects[ $path ] ) ) {
		$url = $redirects[ $path ];
		if ( isset( $parts['query'] ) ) {
			$url .= '?' . $parts['query'];
		}
		header( 'HTTP/1.1 301 Moved Permanently' );
		header( 'Location: ' . $url );
		die();
	}
}
cpnet_process_redirects();
