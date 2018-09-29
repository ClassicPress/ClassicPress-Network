<?php

add_action( 'init', function() {
	if ( ! class_exists( 'ElementorPro\Plugin' ) ) {
		wp_die( 'The Elementor Pro plugin is required for this site.  Please contact a site administrator for more information.' );
	}
} );
