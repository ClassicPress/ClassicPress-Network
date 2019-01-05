<?php
 
	// If uninstall not called from WordPress, then exit
     if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
        exit;
     }

    // Delete all posts of Custom Post Type 'faqconc'
    global $post;
	$args = array(
		'numberposts' => -1,
		'post_type'   => 'faqconc',
		'post_status' => 'any'
	);
	$posts_to_delete = get_posts( $args );
	if($posts_to_delete) {
		foreach ($posts_to_delete as $post_to_delete) {
			wp_delete_post( $post_to_delete->ID, true );
		}
	}

	// Delete options    
	delete_option('faqconc_animation_speed');
	delete_option('faqconc_hide_others');
	delete_option('faqconc_width');
	delete_option('faqconc_width_override');
	delete_option('faqconc_colour_scheme');
	delete_option('faqconc_custom_colour1');
	delete_option('faqconc_custom_colour2');
	delete_option('faqconc_negative');
	delete_option('faqconc_corners');
	delete_option('faqconc_indicators');
	delete_option('faqconc_disable_styles');
	delete_option('faqconc_order');
	delete_option('faqconc_reverse');

	// Call function to delete all terms for custom taxonomy 'faqconc_cat'
	delete_custom_terms('faqconc_cat');

	// Function to delete all terms for custom taxonomy
	function delete_custom_terms($taxonomy){
	    global $wpdb;

	    $query = 'SELECT t.name, t.term_id
	            FROM ' . $wpdb->terms . ' AS t
	            INNER JOIN ' . $wpdb->term_taxonomy . ' AS tt
	            ON t.term_id = tt.term_id
	            WHERE tt.taxonomy = "' . $taxonomy . '"';

	    $terms_to_delete = $wpdb->get_results($query);

	    if($terms_to_delete) {
	    	foreach ($terms_to_delete as $term_to_delete) {
		        wp_delete_term( $term_to_delete->term_id, $taxonomy );
		    }
		}
	}

?>