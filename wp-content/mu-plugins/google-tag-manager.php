<?php

/**
 * Add Google Tag Manager, including on Elementor Canvas pages, for certain
 * sites.
 */
function cpnet_add_google_tag_manager() {
	switch ( cpnet_subdomain() ) {
		case 'www':
		case 'docs':
			add_action(
				'wp_head',
				'cpnet_print_google_tag_manager_head',
				0
			);
			add_action(
				'body_class',
				'cpnet_setup_google_tag_manager_body',
				999
			);
			break;
	}
}
add_action( 'init', 'cpnet_add_google_tag_manager' );

/**
 * Set up actions to print the Google Tag Manager snippet for the site body.
 *
 * This is kind of terrible, but the cleanest alternative is to copy the
 * theme's full header.php file into the child theme and modify it there...
 */
function cpnet_setup_google_tag_manager_body( $body_classes ) {
	flush();
	ob_start();
	// Clean up and finish on the very next WP hook call.
	add_filter( 'all', 'cpnet_end_setup_google_tag_manager_body' );
	return $body_classes;
}

/**
 * Print the Google Tag Manager snippet for the site body.
 */
function cpnet_end_setup_google_tag_manager_body( $hook, $arg = null ) {
	$content = ob_get_clean();
	error_log( "$hook: $content" );
	$content = explode( '">', $content, 2 );
	echo $content[0] . '">';
	cpnet_print_google_tag_manager_body();
	if ( isset( $content[1] ) ) {
		echo $content[1];
	}
	remove_filter( 'all', 'cpnet_end_setup_google_tag_manager_body' );
	return $arg;
}

/**
 * Print the Google Tag Manager snippet for the site head.
 */
function cpnet_print_google_tag_manager_head() {
	echo "\n";
?>
    <!-- Google Tag Manager (head) -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-T88732G');</script>
    <!-- End Google Tag Manager (head) -->
<?php
}

/**
 * Print the Google Tag Manager snippet for the site body.
 */
function cpnet_print_google_tag_manager_body() {
	echo "\n";
?>
    <!-- Google Tag Manager (body) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T88732G"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (body) -->
<?php
}
