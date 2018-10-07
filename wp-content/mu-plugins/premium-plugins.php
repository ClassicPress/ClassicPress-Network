<?php

add_action( 'init', function() {
	if ( file_exists( ABSPATH . '/wp-content/plugins/elementor-pro' ) && ! class_exists( 'ElementorPro\Plugin' ) ) {
		wp_die( 'The Elementor Pro plugin is required for this site.  Please contact a site administrator for more information.' );
	}
} );
