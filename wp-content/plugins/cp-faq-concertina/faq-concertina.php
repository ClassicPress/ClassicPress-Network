<?php
/* 
Plugin Name: ClassicPress FAQ Concertina
Plugin URI: https://www.classicpress.net/
Description: FAQs displayed as an expandable concertina using shortcode [faq-concertina]. FAQs can be categorised and displayed using shortcode [faq-concertina category='category-slug']. FAQs can also be ordered and the appearance customised.
Version: 999.upstream-1.4.3
Author: Michael Burridge, Zyriab Ltd.
Author URI: http://www.zyriab.co.uk/
Text Domain: faq-concertina
Domain Path: /languages
License: GPLv2

Copyright 2016  Michael Burridge, Zyriab Ltd.  (email : faqconc@zyriab.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA 
*/
defined( 'ABSPATH' ) or die( "Permission denied!" );


function cp_faqconc_version() {
  // Cache buster for this plugin's scripts and stylesheets.
  return '20190105';
}


/*=======================================
  0 - ACTIVATION AND INTERNATIONALISATION
=========================================*/

function faqconc_on_activation() {

}
register_activation_hook( __FILE__, 'faqconc_on_activation' );

function faqconc_internationalisation()
{
    $lang_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages';
    load_plugin_textdomain( 'faq-concertina', false, $lang_dir );
}
add_action( 'init', 'faqconc_internationalisation' );


/*=======================================
  1 - CUSTOM POST TYPE & TAXONOMY
=========================================*/

// Register custom post type 'faqconc'
function faqconc_create_post_type() {

 	// define labels
	$labels = array (
		'name' 				=> __( 'FAQs','post type general name', 'faq-concertina' ),
		'singular_name' 	=> __( 'FAQ', 'post type singular name', 'faq-concertina' ),
		'name_admin_bar'	=> __( 'FAQs', 'faq-concertina' ),
		'add_new' 			=> __( 'Add new FAQ', 'faq-concertina' ),
		'add_new_item' 		=> __( 'Add new FAQ', 'faq-concertina' ),
		'edit_item' 		=> __( 'Edit FAQ', 'faq-concertina' ),
		'new_item' 			=> __( 'New FAQ', 'faq-concertina' ),
		'view_item' 		=> __( 'View FAQ', 'faq-concertina' )
	);

	// define args
	$args = array (
		'labels' 				=> $labels,
    	'description'			=> 'Holds questions and answers for FAQs',
		'public' 				=> true,
		'show_in_nav_menus' 	=> false,
		'menu_icon' 			=> 'dashicons-list-view',
		'supports' 				=> array( 'title', 'editor', 'page-attributes' )
	);

	register_post_type( 'faqconc', $args );

}
add_action( 'init', 'faqconc_create_post_type' );

// Register custom taxonomy 'faqconc_cat'
function faqconc_create_taxonomies() {

	 //define labels
	 $labels = array(
		  'name' 					=> __( 'FAQ Categories', 'taxonomy general name', 'faq-concertina' ),
		  'singular_name' 			=> __( 'Category', 'taxonomy singular name', 'faq-concertina' ),
		  'search_items' 			=> __( 'Search Categories', 'faq-concertina' ),
		  'all_items' 				=> __( 'All Categories', 'faq-concertina' ),
		  'edit_item'  				=> __( 'Edit Category', 'faq-concertina' ), 
		  'update_item' 			=> __( 'Update Category', 'faq-concertina' ),
		  'add_new_item' 			=> __( 'Add New Category', 'faq-concertina' ),
		  'new_item_name' 			=> __( 'New Category', 'faq-concertina' ),
		  'popular_items' 			=> __( 'Popular Categories', 'faq-concertina' ),
		  'menu_name' 				=> __( 'Categories', 'faq-concertina' ),
		  'choose_from_most_used'	=> __( 'Choose from the most used Categories', 'faq-concertina' ),
		  'not_found' 				=> __( 'No Categories found', 'faq-concertina' )
	 );

	 // define args
	 $args = array(
		  'hierarchical' 		=> false,
		  'labels' 				=> $labels,
		  'rewrite' 			=> true,
		  'show_admin_column'	=> true
	);

	register_taxonomy( 'faqconc_cat', 'faqconc', $args );

}
add_action( 'init', 'faqconc_create_taxonomies', 0 );


/*==========================================
  2 - DASHBOARD PAGES 
============================================*/

/*-----------------------------------------
  2.1 - THE ADD NEW AND EDIT PAGE
-------------------------------------------*/

// Change prompt in title field 
function faqconc_change_default_title( $title ){

     $screen = get_current_screen();
 
     if  ( $screen->post_type == 'faqconc' ) {
          return __( 'Enter question here', 'faq-concertina' );
     }

}
add_filter( 'enter_title_here', 'faqconc_change_default_title' ); 

// Add meta boxes: Category, Order and Help
function faqconc_meta_boxes(){

	add_meta_box( 'tagsdiv-faqconc_cat', __( 'Category', 'faq-concertina' ), 	 'post_tags_meta_box', 		 'faqconc',	'normal', 	'high', array( 'taxonomy' => 'faqconc_cat' ) ); // meta box for category
	add_meta_box( 'pageparentdiv', 		 __( 'Order', 	 'faq-concertina' ), 	 'page_attributes_meta_box', 'faqconc',	'normal', 	'low' ); // meta box for order
	add_meta_box( 'faq_help', 			 __( 'Help', 	 'faq-concertina' ), 	 'faqconc_help', 			 'faqconc',	'side', 	'high' ); // meta box for help (calls faqconc_help below)

}
add_action( 'add_meta_boxes_faqconc', 'faqconc_meta_boxes' ); 

// Callback function for the help metabox
function faqconc_help() {

	$helptext  = '<p>' . __( 'FAQ Concertina provides an easy way for you to add FAQs to your page or blog post using the shortcode <em>[faq-concertina]</em>.', 'faq-concertina' ) . '</p>';
	$helptext .= '<p>' . __( 'Enter the question in the top box.', 'faq-concertina' ) . '</p>';
	$helptext .= '<p>' . __( 'Enter the answer in the editor pane. Here you can format your text, and even include links, images and lists just like in a regular post.', 'faq-concertina' ) . '</p>';
	$helptext .= '<p>' . __( 'If you wish you can assign an order number to your FAQ. This will determine the order that the FAQs appear in if "Order" is set to "Numerical" in Settings.', 'faq-concertina' ) . '</p>';
	$helptext .= '<p>' . __( 'To enable you to change the order it is recommended that spaces be left in the numeric sequence thus: <em>10, 20, 30, etc...</em>. In this way the order of the FAQs can be easily changed. So to make 30 the second in the sequence rather than the third simply change the order number from 30 to 15 so that it now lies between 10 and 20, thus moving 20 from being the second to being the third item in the sequence.', 'faq-concertina' ) . '</p>';
	$helptext .= '<p>' . __( 'If you want to categorise your FAQs add one or more categories for the FAQ. <em>(Note that this is entirely optional and unnecessary if all you want is a single list of FAQs)</em>. You can manage your categories by selecting \'Categories\' from the \'FAQs\' menu. If you are using categories then your shortcode will look like this:<br /><em>[faq-concertina category="category-slug"]</em>.', 'faq-concertina' ) . '</p>';
	$helptext .= '<p>' . __( 'Oh, and don\'t forget to click "Publish" below when you\'re done!', 'faq-concertina' ) . '</p>';

	echo $helptext;

}

/*-----------------------------------------
  2.2 - THE POST LISTING PAGE
-------------------------------------------*/

// Add Order column to listing page
function faqconc_add_order_column( $columns ) {

	$new = array();

	foreach( $columns as $key => $title ) {
		if ( $key=='title' ) { 	// put Order before Title column
    		$new['order']  = __( 'Order',  'faq-concertina' );
    	}
    	$new[$key] = $title;
    }

    return $new; 

}
add_filter( 'manage_faqconc_posts_columns', 'faqconc_add_order_column' );

// Make Order column sortable
function faqconc_order_column_sortable( $columns ) {
	
	$columns['order'] = 'menu_order';
 
    return $columns;

}
add_filter( 'manage_edit-faqconc_sortable_columns', 'faqconc_order_column_sortable' );

// Order column content
function faqconc_order_column_content( $column_name, $post_id ) {

    if ( $column_name == 'order' ) {
    	echo get_post_field( 'menu_order', $post_id );
    }

}
add_action( 'manage_faqconc_posts_custom_column', 'faqconc_order_column_content', 10, 2 );

// Make FAQ Categories column sortable
function faqconc_category_column_sortable( $columns ) {

    $columns['taxonomy-faqconc_cat'] = 'taxonomy-faqconc_cat';
 
    return $columns;

}
add_filter( 'manage_edit-faqconc_sortable_columns', 'faqconc_category_column_sortable' );

// Sort by FAQ Categories column
function faqconc_sortby_category( $orderby, $wp_query ) {
	global $wpdb;

	if ( isset( $wp_query->query['orderby'] ) && 'taxonomy-faqconc_cat' == $wp_query->query['orderby'] ) {
		$orderby = "(
			SELECT GROUP_CONCAT(name ORDER BY name ASC)
			FROM $wpdb->term_relationships
			INNER JOIN $wpdb->term_taxonomy USING (term_taxonomy_id)
			INNER JOIN $wpdb->terms USING (term_id)
			WHERE $wpdb->posts.ID = object_id
			AND taxonomy = 'faqconc_cat'
			GROUP BY object_id
		) ";
		$orderby .= ( 'ASC' == strtoupper( $wp_query->get('order') ) ) ? 'ASC' : 'DESC';
	}

	return $orderby;

}
add_filter( 'posts_orderby', 'faqconc_sortby_category', 10, 2 );


// Set listing page column widths
function faqconc_faq_table_column_widths() {

    echo '<style type="text/css">
        .column-order { text-align: left; width:10% !important; overflow:hidden }
        .column-title { text-align: left; width:50% !important; overflow:hidden }
        .column-date { width:15% !important; overflow:hidden }
    </style>';

}
add_action( 'manage_faqconc_posts_custom_column', 'faqconc_faq_table_column_widths' );

/*-----------------------------------------
  2.3 - THE SETTINGS PAGE
-------------------------------------------*/

// Add the settings page  
function faqconc_settings_page() {

    add_submenu_page( 'edit.php?post_type=faqconc', __( 'FAQ Concertina Settings', 'faq-concertina' ), __( 'Settings', 'faq-concertina' ), 'edit_posts', 'faqconc_settings_page', 'faqconc_settings' );

}
add_action( 'admin_menu' , 'faqconc_settings_page' );

// Enqueue color picker
function faqconc_enqueue_color_picker( $hook ) {

    // first check that we're on the faqconc admin page
    $screen = get_current_screen();
    if ( $hook == 'post.php' && $screen->post_type != 'faqconc' ) {
        return;
    }

    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'faqconc-colorpicker-script', plugins_url('js/faq-concertina-colorpicker-script.js', __FILE__ ), array( 'wp-color-picker' ), cp_faqconc_version(), true );

}
add_action( 'admin_enqueue_scripts', 'faqconc_enqueue_color_picker' );

// Register sections, fields and settings
function faqconc_register_settings() {

	add_settings_section( 'faqconc_animation_section', 	__( 'Animation',  'faq-concertina' ), 	'faqconc_animation_section', 	'faqconc_settings_page' );
	add_settings_section( 'faqconc_order_section', 		__( 'Order',      'faq-concertina' ), 	'faqconc_order_section', 		'faqconc_settings_page' );

	add_settings_field( 'faqconc_speed', 			__( 'Speed', 				'faq-concertina' ), 'faqconc_speed', 			'faqconc_settings_page', 'faqconc_animation_section', 	array( 'label_for' => 'Speed') );
	add_settings_field( 'faqconc_hide_others', 		__( 'Hide Others', 			'faq-concertina' ), 'faqconc_hide_others', 		'faqconc_settings_page', 'faqconc_animation_section', 	array( 'label_for' => 'Hide Others') );
	add_settings_field( 'faqconc_order', 			__( 'Order',         		'faq-concertina' ), 'faqconc_order', 			'faqconc_settings_page', 'faqconc_order_section', 		array( 'label_for' => 'Order') );	
	add_settings_field( 'faqconc_reverse', 			__( 'Reverse',         		'faq-concertina' ), 'faqconc_reverse', 			'faqconc_settings_page', 'faqconc_order_section', 		array( 'label_for' => 'Reverse') );

	register_setting( 'faqconc_settings', 'faqconc_animation_speed' );
	register_setting( 'faqconc_settings', 'faqconc_hide_others' );
	register_setting( 'faqconc_settings', 'faqconc_order' );	
	register_setting( 'faqconc_settings', 'faqconc_reverse' );

}
add_action( 'admin_init', 'faqconc_register_settings' );

// Callback functions for speed
function faqconc_animation_section() {

	$html  = '<p>' . __( 'Sets the animation effects when Answer panel is opened or closed.', 'faq-concertina' ) . '</p>';

	echo $html;

}
function faqconc_speed() {

	$speed = get_option( 'faqconc_animation_speed', '500' );

	$html  = '<select name="faqconc_animation_speed" id="faqconc_animation_speed">
		<option value="0" '    . selected( $speed, '0', false )    . '>0 - ' . __( 'Instant', 'faq-concertina' )   . '</option>
		<option value="125" '  . selected( $speed, '125', false )  . '>1 - ' . __( 'Very fast', 'faq-concertina' ) . '</option>
		<option value="250" '  . selected( $speed, '250', false )  . '>2 - ' . __( 'Fast', 'faq-concertina' ) 	   . '</option>
		<option value="500" '  . selected( $speed, '500', false )  . '>3 - ' . __( 'Medium', 'faq-concertina' )    . '</option>
		<option value="750" '  . selected( $speed, '750', false )  . '>4 - ' . __( 'Slow', 'faq-concertina' )      . '</option>
		<option value="1000" ' . selected( $speed, '1000', false ) . '>5 - ' . __( 'Very slow', 'faq-concertina' ) . '</option>
	</select>';

	echo $html;

}
function faqconc_hide_others() {

	$hide_others = get_option( 'faqconc_hide_others', '0');

	$html  = '<input type="checkbox" id="faqconc_hide_others" name="faqconc_hide_others"  value="1" ' . checked( $hide_others, 1, false ) .' />';
    $html .= '<label for="faqconc_hide_others"> ' . __( 'Hide previously opened answer when new answer is opened (i.e. only one answer visible at a time).', 'faq-concertina' ) . '</label>';

	echo $html;

}

// Callback functions for order
function faqconc_order_section() {

	$html  = '<p>' . __( 'Sets the order in which the FAQs are displayed.', 'faq-concertina' ) . '</p>';
	$html .= '<p><strong>' . __( 'Alphabetical', 'faq-concertina' ) . '</strong> ' . __( 'orders the FAQs alphabetically by question.', 'faq-concertina' ) . '<br />';
	$html .= '<strong>' . __( 'Chronological', 'faq-concertina' ) . '</strong> ' . __( 'orders the FAQs according to the order in which you created them.', 'faq-concertina' ) . '<br />';
	$html .= '<strong>' . __( 'Numerical', 'faq-concertina' ) . '</strong> ' . __( 'orders the FAQs according to the Order attribute (optionally defined when you add/edit an FAQ).', 'faq-concertina' ) . '</p>';
	$html .= '<p><em>' . __( 'If you want drag and drop sorting of FAQs then install the', 'faq-concertina' ) . ' <a href="https://wordpress.org/plugins/post-types-order/" target="_blank">Post Types Order plugin</a> ' . __( 'and set the Order below to Numerical.', 'faq-concertina' ) . '</em></p>';

	echo $html;

}
function faqconc_order() {

	$order = get_option( 'faqconc_order', '2' );

	$html  = '<table><tr>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="order_alphabetical" name="faqconc_order" value="0" ' . checked( 0, $order, false ) . '/>';
	$html .= '<label for="order_alphabetical"> ' . __( 'Alphabetical', 'faq-concertina' ) . ' </label></td>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="order_chronological" name="faqconc_order" value="1" ' . checked( 1, $order, false ) . '/>';
	$html .= '<label for="order_chronological"> ' . __( 'Chronological', 'faq-concertina' ) . ' </label></td>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="order_numerical" name="faqconc_order" value="2" ' . checked( 2, $order, false ) . '/>';
	$html .= '<label for="order_numerical"> ' . __( 'Numerical', 'faq-concertina' ) . ' </label></td>';
	$html .= '</tr></table>';

	echo $html;

}
function faqconc_reverse() {

	$reverse = get_option( 'faqconc_reverse', '0' );

	$html  = '<input type="checkbox" id="faqconc_reverse" name="faqconc_reverse"  value="1" ' . checked( $reverse, 1, false ) . ' />';
    $html .= '<label for="faqconc_reverse"> ' . __( 'List FAQs in reverse order.', 'faq-concertina' ) . '</label>';

    echo $html;

}

// Callback functions for pagination
/*
function faqconc_pagination_section() { 

	$html  = '<p>' . __( 'Pagination for long lists of FAQs coming soon in a future update.', 'faq-concertina' ) . '</p>';

	echo $html;

}
*/

// The settings form
function faqconc_settings() {

	// Does current user have permission to access page (i.e. page not accessed directly via permalink)
	if ( !current_user_can( 'edit_posts' ) ) {
		wp_die( 'You do not have sufficient permissions to access this page!' );
	}

	echo  '<div class="wrap">';
		echo '<h2>' . __( 'FAQ Concertina Settings', 'faq-concertina' ) . '</h2>';	 

		// Make a call to the WordPress function for rendering errors when settings are saved.
	    settings_errors();

		echo '<form action="options.php" method="post" name="options">';
			do_settings_sections( 'faqconc_settings_page' );
			settings_fields( 'faqconc_settings' );
			submit_button( __( 'Update Settings', 'faq-concertina' ) );
		echo '</form>';
	echo '</div>';

}

/*-----------------------------------------
  2.4 - MESSAGES
-------------------------------------------*/

function faqconc_messages( $messages ) {

  global $post, $post_ID;

  $messages['faqconc'] = array(
     0 => '', 
     1 => __( 'FAQ updated', 'faq-concertina' ) . sprintf( ' - <a target="_blank" href="%s">', esc_url( get_permalink( $post_ID ) ) ) .  __( 'View FAQ', 'faq-concertina' ) . '</a>',
     2 => __( 'Custom field updated', 'faq-concertina' ),
     3 => __( 'Custom field deleted', 'faq-concertina' ),
     4 => __( 'FAQ updated', 'faq-concertina' ),
     5 => isset( $_GET['revision'] ) ? sprintf( __( 'FAQ restored to revision from %s', 'faq-concertina' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false, // translators: %s: date and time of the revision
     6 => __( 'FAQ published', 'faq-concertina' ) . sprintf( ' - <a target="_blank" href="%s">', esc_url( get_permalink( $post_ID ) ) ) .  __( 'View FAQ', 'faq-concertina' ) . '</a>',
     7 => __( 'FAQ saved', 'faq-concertina' ),
     8 => __( 'FAQ submitted', 'faq-concertina' ) . sprintf( ' - <a target="_blank" href="%s">', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ) . __( 'Preview FAQ', 'faq-concertina' ) . '</a>',
     9 => __( 'FAQ scheduled for:', 'faq-concertina' ) . sprintf( ' <strong>%1$s</strong> - <a target="_blank" href="%2$s">', date_i18n( __( 'j M Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ) ) . __( 'Preview FAQ', 'faq-concertina' ) . '</a>',
	10 => __( 'Draft FAQ updated', 'faq-concertina' ) . sprintf( ' - <a target="_blank" href="%s">', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ) . __( 'Preview FAQ', 'faq-concertina' ) . '</a>'
  );

  return $messages;

}
add_filter( 'post_updated_messages', 'faqconc_messages' );


/*=======================================
  3 - DISPLAY FAQ ITEMS
=========================================*/

// Check for [faq-concertina] shortcode and load styles if found (we don't want to load the styles if the shortcode doesn't exist on the page)
// Perform the check when the_posts() function is called so styles get loaded in <head>
function faqconc_check_for_shortcode( $posts ) {

    if ( empty( $posts ) )
        return $posts;
 
    // false because we have to search through the posts first
    $faqconc_shortcode_found = false;
 
    // search through each post
    foreach ( $posts as $post ) {
        // check the post content for the shortcode
        if ( has_shortcode( $post->post_content, 'faq-concertina' ) )
            // we have found a post with the shortcode
            $faqconc_shortcode_found = true;
            // stop the search
            break;
    } // end foreach
 
	if ( $faqconc_shortcode_found ) {
		// shortcode has been found so let's load the styles!

    	// load external stylesheet
        wp_register_style( 'faqconc-styles', plugins_url( 'css/faq-concertina-styles.css', __FILE__ ), array(), cp_faqconc_version() );
		wp_enqueue_style( 'faqconc-styles' );
    }

    return $posts;

} 
add_action( 'the_posts', 'faqconc_check_for_shortcode' );

// Create shortcode [faq-concertina] and display FAQs on page
function faqconc_show_faqs( $atts ) {

	// extract 'category' attribute or default to empty string
	$atts = shortcode_atts( array( 'category' => '' ), $atts, 'faq-concertina' );
	$category = $atts['category'];

	// create the query arguments array ($args) to pass to WP_Query
	$args = array(
		'post_type' 		=> 'faqconc',
		'posts_per_page'	=> '-1'
	);
	// check for category and add to query arguments ($args)
	if ( $category ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'faqconc_cat',
				'field'    => 'slug',
				'terms'    => $category
			)
		);
	}
	// check for FAQ order and add relevant ordering to query arguments ($args) 
	$order = get_option( ' faqconc_order', '2' );
	if ( $order == '0' ) { $args['orderby'] = 'title'; } // alphabetical order
	// if order == 1 then chronological order (WordPress default so we do nothing here)
	if ( $order == '2' ) { $args['orderby'] = 'menu_order'; } // numerical order as defined by Order attribute
	// check whether order should be reversed and add to query arguments ($args)
	$reverse = get_option( 'faqconc_reverse', '0' );
	if ( $reverse == '1' ) { $args['order'] = 'DESC'; } else { $args['order'] = 'ASC'; }

	// get the posts and store array of records in $faqs
	$faqs = new WP_Query( $args );
	
	if ( $faqs->have_posts() ) {

		// get the animation speed
		$speed = ( get_option( 'faqconc_animation_speed' ) != '' ) ? get_option( 'faqconc_animation_speed' ) : '500';
		$hide_others = ( get_option( 'faqconc_hide_others' ) != '' ) ? get_option( 'faqconc_hide_others' ) : '0';
		
		// enqueue script and pass animation speed to javascript file
		wp_register_script( 'faqconc-script', plugins_url( 'js/faq-concertina-script.js', __FILE__ ), array( 'jquery' ), cp_faqconc_version() );
		wp_enqueue_script( 'faqconc-script' );
		wp_localize_script( 'faqconc-script', 'faqconcvars', array ( 'speed' => $speed, 'hideothers' => $hide_others, 'category' => $category ) );

		// display the FAQs
		$current_ver = '1_4_3';
		$faq_concertina = $category ? '<div id="faqconc_' . $current_ver . '_' . $category . '" class="faqconc ' . $category . '" role="tablist" aria-multiselectable="true">' :'<div id="faqconc_' . $current_ver . '" class="faqconc" role="tablist" aria-multiselectable="true">'; // Add category as class if it exists
 
 		while ( $faqs->have_posts() ) {
			$faqs->the_post();
			$faqid = get_post()->post_name;
			$faq_concertina .= '<div class="faq_item" id="' . $faqid . '">';
			$faq_concertina .= '<div class="faq_q" id="' . $faqid . '_q" aria-selected="false" aria-expanded="false" aria-controls="' . $faqid . '_a" role="tab" tabindex="0">';
			$faq_concertina .= '<span class="faq_q_title">' . get_the_title() . '</span>';
			$faq_concertina .= '<a class="faq_link" href="#' . $faqid . '" tabindex="-1">#</a></div>'; // .faq_q
			$faq_concertina .= '<div class="faq_a" id="' . $faqid . '_a" aria-labelledby="faq' . $faqid . '_q" aria-hidden="true" role="tabpanel">';
			$faq_concertina .=  wpautop( get_the_content() ); // ensure that the content is output with paragraph tags ( <p>...</p> )
			$faq_concertina .= '</div>'; // .faq_a
			$faq_concertina .= '</div>'; // .faq_item

//			$faq_concertina .= '<div class="nav-previous alignleft">' . next_posts_link( 'Next page' ) . '</div>';
//			$faq_concertina .= '<div class="nav-next alignright">' . previous_posts_link( 'Previous page' ) . '</div>'; 
		}
		$faq_concertina .= '</div>'; // .faqconc
	} else {
		$faq_concertina = '<div id="faqconc_' . $current_ver . '" class="faqconc"><p><strong>' . __( 'Sorry, no FAQs can be found!', 'faq-concertina' ) . '</strong></p></div>';
	} 
	
	wp_reset_postdata();

	// run shortcode parser recursively
    $faq_concertina = do_shortcode( $faq_concertina );

	return $faq_concertina;	
	
}
add_shortcode( 'faq-concertina', 'faqconc_show_faqs' );
?>
