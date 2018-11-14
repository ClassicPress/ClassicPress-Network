<?php
/**
 * Plugin name: ClassicPress GlotPress WP-CLI commands
 * Description: Provides new commands for WP-CLI for GlotPress.
 * Version:     1.0
 * Author:      ClassicPress.net based on WordPress.org
 * Author URI:  http://classicpress.net
 * License:     GPLv2 or later
 */

 if ( defined( 'WP_CLI' ) && WP_CLI ) {
    include_once( __DIR__ . '/inc/class-language-pack.php' );
}
