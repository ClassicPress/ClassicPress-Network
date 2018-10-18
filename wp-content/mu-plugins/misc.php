<?php

add_filter( 'gettext', function( $translated_text, $text, $domain ) {
	switch ( $text ) {
		case 'Proudly powered by %s': // WordPress
			return __(
				'Proudly powered by ClassicPress',
				'classicpress'
			);

		default:
			return $translated_text;
	}
}, 10, 3 );
