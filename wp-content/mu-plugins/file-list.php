<?php

add_shortcode( 'cp_file_list', function( $atts ) {
	$dir = trim( $atts['dir'] ?? '', '/' );
	if ( empty( $dir ) || ! is_dir( ABSPATH . $dir ) ) {
		return '';
	}
	$dir = trailingslashit( $dir );
	$dir_full = ABSPATH . $dir;
	$dir_url = site_url( "/$dir" );

	$html = '';
	$entries = [];

	if ( $handle = opendir( $dir_full ) ) {
		while ( ( $entry = readdir( $handle ) ) !== false ) {
			if ( $entry !== '.' && $entry !== '..' ) {
				$entries[] = $entry;
			}
		}
		closedir( $handle );
	}
	sort( $entries );

	$html .= "<table class=\"cp-file-list\">\n";
	foreach ( $entries as $entry ) {
		$html .= "<tr><td class=\"cp-file-preview\">\n";
		if ( preg_match( '#\.(png|gif|jpg|svg)#i', $entry ) ) {
			$url = esc_url( $dir_url . $entry );
			$html .= "<a href=\"$url\"><div class=\"cp-file-wrapper\">";
			$html .= "<div class=\"cp-file-thumbnail\" style=\"
				width: 120px;
				height: 120px;
				background-image: url( '$url' );
				background-repeat: no-repeat;
				background-size: contain;
				background-position: center;
			\"></div></div></a>\n";
		} else {
			$html .= '(no preview)';
		}
		$html .= "</td><td class=\"cp-file-name\">\n";
		$html .= "<a href=\"$url\">" . esc_html( $entry ) . "</a>\n";
		$html .= "</td><td class=\"cp-file-size\" style=\"text-align: right;\">\n";
		$html .= size_format( filesize( $dir_full . $entry ) );
		$html .= "</td></tr>\n";
	}
	$html .= "</table>\n";

	return $html;
} );
