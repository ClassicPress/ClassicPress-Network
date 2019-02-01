<?php

function cpnet_allow_lowercase_p_sometimes() {
	if ( is_page( 'brand-guidelines' ) ) {
		remove_filter( 'the_content', 'capital_P_dangit', 11 );
	}
}
add_action( 'wp', 'cpnet_allow_lowercase_p_sometimes' );
