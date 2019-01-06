<?php
/**
 * Plugin name: ClassicPress GlotPress Sanitize strings
 * Description: Sanitize the strings content to strip specific HTML tags
 * Version:     1.0
 * Author:      ClassicPress.net
 * Author URI:  http://classicpress.net
 * License:     GPLv2 or later
 */

class CP_GP_Sanitize {

	function __construct() {
		add_action( 'gp_translation_prepare_for_save', array( $this, 'apply_sanitize' ) );
	}

	function apply_sanitize( $args, $translation ) {
		foreach( range( 0, $translation->get_static( 'number_of_plural_translations' ) - 1 ) as $i ) {
			if ( isset( $args[ "translation_$i" ] ) ) {
				$args[ "translation_$i" ] = $this->sanitize( $args[ "translation_$i" ] );
			}
		}

		return $args;
	}
	
	function sanitize( $text ) {
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $text);
	}

}

function cp_gp_sanitize() {
	global $cp_gp_sanitize;

	if ( ! isset( $cp_gp_sanitize ) ) {
		$wporg_gp_sanitize = new CP_GP_Sanitize();
	}

	return $wporg_gp_sanitize;
}

add_action( 'plugins_loaded', 'wporg_gp_sanitize' );
