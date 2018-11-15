<?php

function cpnet_maybe_link_to_headings() {
	if ( cpnet_subdomain() !== 'docs' ) {
		return;
	}

	if ( ! is_singular() ) {
		return;
	}

	add_filter( 'the_content', 'cpnet_link_to_headings' );
}
add_action( 'wp', 'cpnet_maybe_link_to_headings' );

function cpnet_link_to_headings( $content ) {
	$sections = [];
	$content = preg_replace_callback(
		'#<(h[1-3])([^>]*)>([^<>]+)(</h*[1-3][^>]*>)#',
		function( $matches ) use ( &$sections ) {
			$tag = $matches[1];
			$open_extra = $matches[2];
			$content = $matches[3];
			$close = $matches[4];
			if ( ! stristr( $matches[0], 'id=' ) ) {
				// The heading doesn't have an ID yet; add one.
				$slug = trim( preg_replace(
					'#[^a-z0-9]+#',
					'-',
					strtolower( $content )
				), '-' );
				$add_id = ' id="' . $slug . '"';
			} else {
				// The heading already has an ID; re-use it.
				$parts = explode( 'id=', $open_extra );
				$parts = explode( substr( $parts[1], 0, 1 ), $parts[1] );
				$slug = $parts[1];
				$add_id = '';
			}
			$sections[] = [
				'level'   => intval( substr( $tag, 1 ) ),
				'slug'    => $slug,
				'content' => wp_strip_all_tags( $content ),
			];
			return (
				'<' . $tag . $add_id . ' ' . trim( $open_extra ) . '>'
					. $content
					. '<a class="cp-heading-link" href="#' . $slug . '">'
						. '<span aria-hidden="true">#</span>'
						. '<span class="screen-reader-text">Link to this section</span>'
					. '</a>'
				. $close
			);
		},
		$content
	);

	if ( count( $sections ) >= 3 ) {
		// Display a small table of contents at the top of the post
		echo '<div class="cpnet-toc">';
		echo 'Contents:';
		$level = 1;
		foreach ( $sections as $section ) {
			while ( $level < $section['level'] ) {
				echo '<ul>';
				$level++;
			}
			while ( $level > $section['level'] ) {
				echo '</ul>';
				$level--;
			}
			echo '<li><a href="#' . $section['slug'] . '">'
				. $section['content']
				. '</a></li>';
		}
		while ( $level > 1 ) {
			echo '</ul>';
			$level--;
		}
		echo '</div>';
	}

	return $content;
}
