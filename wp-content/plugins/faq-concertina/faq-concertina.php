<?php
/* 
Plugin Name: FAQ Concertina
Plugin URI: http://www.zyriab.co.uk/faqconc/
Description: FAQs displayed as an expandable concertina using shortcode [faq-concertina]. FAQs can be categorised and displayed using shortcode [faq-concertina category='category-slug']. FAQs can also be ordered and the appearance customised.
Version: 1.4.3
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
    wp_enqueue_script( 'faqconc-colorpicker-script', plugins_url('js/faq-concertina-colorpicker-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );

}
add_action( 'admin_enqueue_scripts', 'faqconc_enqueue_color_picker' );

// Register sections, fields and settings
function faqconc_register_settings() {

	add_settings_section( 'faqconc_animation_section', 	__( 'Animation',  'faq-concertina' ), 	'faqconc_animation_section', 	'faqconc_settings_page' );
	add_settings_section( 'faqconc_appearance_section', __( 'Appearance', 'faq-concertina' ), 	'faqconc_appearance_section', 	'faqconc_settings_page' );
	add_settings_section( 'faqconc_order_section', 		__( 'Order',      'faq-concertina' ), 	'faqconc_order_section', 		'faqconc_settings_page' );
//	add_settings_section( 'faqconc_pagination_section', __( 'Pagination', 'faq-concertina' ), 	'faqconc_pagination_section', 	'faqconc_settings_page' );

	add_settings_field( 'faqconc_speed', 			__( 'Speed', 				'faq-concertina' ), 'faqconc_speed', 			'faqconc_settings_page', 'faqconc_animation_section', 	array( 'label_for' => 'Speed') );
	add_settings_field( 'faqconc_hide_others', 		__( 'Hide Others', 			'faq-concertina' ), 'faqconc_hide_others', 		'faqconc_settings_page', 'faqconc_animation_section', 	array( 'label_for' => 'Hide Others') );
	add_settings_field( 'faqconc_width', 			__( 'Width',           		'faq-concertina' ), 'faqconc_width', 			'faqconc_settings_page', 'faqconc_appearance_section', 	array( 'label_for' => 'Width') );	
	add_settings_field( 'faqconc_width_override', 	__( 'Override Width',  		'faq-concertina' ), 'faqconc_width_override', 	'faqconc_settings_page', 'faqconc_appearance_section', 	array( 'label_for' => 'Override Width') );	
	add_settings_field( 'faqconc_colours', 			__( 'Colour Scheme',   		'faq-concertina' ), 'faqconc_colours', 			'faqconc_settings_page', 'faqconc_appearance_section', 	array( 'label_for' => 'Colour Scheme') );
	add_settings_field( 'faqconc_invert_colours', 	__( 'Negative',        		'faq-concertina' ), 'faqconc_invert_colours', 	'faqconc_settings_page', 'faqconc_appearance_section', 	array( 'label_for' => 'Negative') );
	add_settings_field( 'faqconc_corners', 			__( 'Corners',				'faq-concertina' ), 'faqconc_corners', 			'faqconc_settings_page', 'faqconc_appearance_section', 	array( 'label_for' => 'Corners') );
	add_settings_field( 'faqconc_indicators', 		__( 'Show/Hide Indicators', 'faq-concertina' ), 'faqconc_indicators', 		'faqconc_settings_page', 'faqconc_appearance_section', 	array( 'label_for' => 'Show/Hide Indicators') );
	add_settings_field( 'faqconc_disable_styles', 	__( 'Disable',         		'faq-concertina' ), 'faqconc_disable_styles', 	'faqconc_settings_page', 'faqconc_appearance_section', 	array( 'label_for' => 'Disable Styles') );
	add_settings_field( 'faqconc_order', 			__( 'Order',         		'faq-concertina' ), 'faqconc_order', 			'faqconc_settings_page', 'faqconc_order_section', 		array( 'label_for' => 'Order') );	
	add_settings_field( 'faqconc_reverse', 			__( 'Reverse',         		'faq-concertina' ), 'faqconc_reverse', 			'faqconc_settings_page', 'faqconc_order_section', 		array( 'label_for' => 'Reverse') );

	register_setting( 'faqconc_settings', 'faqconc_animation_speed' );
	register_setting( 'faqconc_settings', 'faqconc_hide_others' );
	register_setting( 'faqconc_settings', 'faqconc_width', 'faqconc_width_validate' );
	register_setting( 'faqconc_settings', 'faqconc_width_override' );
	register_setting( 'faqconc_settings', 'faqconc_colour_scheme' );	
	register_setting( 'faqconc_settings', 'faqconc_custom_colour1', 'faqconc_custcol1_validate' );	
	register_setting( 'faqconc_settings', 'faqconc_custom_colour2', 'faqconc_custcol2_validate' );
	register_setting( 'faqconc_settings', 'faqconc_negative' );	
	register_setting( 'faqconc_settings', 'faqconc_corners' );	
	register_setting( 'faqconc_settings', 'faqconc_indicators' );	
	register_setting( 'faqconc_settings', 'faqconc_disable_styles' );	
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

// Callback functions for appearance
function faqconc_appearance_section() {

	$html  = '<p>' . __( 'Style the visual appearance of the FAQ Concertina to match your theme.', 'faq-concertina' ) . '</p>';

	echo $html;

}
function faqconc_width() {

	$width = get_option( 'faqconc_width', '75' );

	$html  = '<input type="text" name="faqconc_width" value="' . $width . '" size="3" /> % &nbsp;<span style="font-size:13px;">' . __( '(Min:50% Max:100%)', 'faq-concertina' ) . '</span>';

	echo $html;

}
function faqconc_width_validate( $input ) {

	$width = get_option( 'faqconc_width' );

	if ( $input < '50' || $input > '100' ) { 
		add_settings_error ( 'faqconc_width', 'faqconc_width_msg', __( 'The value entered for <em>Width</em> is not valid. Enter a number between 50 and 100.', 'faq-concertina' ) );
	} else {
		$width = intval( $input );
	}

	return $width; 

}
function faqconc_width_override() {

	$override = get_option( 'faqconc_width_override', '1' );

	$html  = '<input type="checkbox" id="faqconc_width_override" name="faqconc_width_override"  value="1" ' . checked( $override, 1, false ) .' />';
    $html .= '<label for="faqconc_width_override"> ' . __( 'Override the width setting above on small screen devices (e.g. smartphones).', 'faq-concertina' ) . '</label>'; 

    echo $html;

}
function faqconc_colours() {

	$colours = get_option( 'faqconc_colour_scheme', '1' );
	$custcol1 = get_option( 'faqconc_custom_colour1', '#3f6191' );
	$custcol2 = get_option( 'faqconc_custom_colour2', '#fbf6e4' );

	$html  = '<table><tr>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_one" name="faqconc_colour_scheme" value="1" ' . checked( 1, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_one"><img src="'    . plugins_url( 'assets/cs_blackandwhite.jpg', __FILE__ ) . '" align="top" height="20px" />&nbsp; ' . __( 'Black & White', 'faq-concertina' ) . '</label></td>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_two" name="faqconc_colour_scheme" value="2" ' . checked( 2, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_two"><img src="'    . plugins_url( 'assets/cs_shadesofgrey.jpg', __FILE__ )  . '" align="top" height="20px" />&nbsp; ' . __( 'Shades of Grey', 'faq-concertina' ) . '</label></td>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_three" name="faqconc_colour_scheme" value="3" ' . checked( 3, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_three"><img src="'  . plugins_url( 'assets/cs_jet.jpg', __FILE__ )           . '" align="top" height="20px" />&nbsp; ' . __( 'Jet', 'faq-concertina' ) . '</label></td>';
	$html .= '</tr><tr>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_four" name="faqconc_colour_scheme" value="4" ' . checked( 4, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_four"><img src="'   . plugins_url( 'assets/cs_denim.jpg', __FILE__ )         . '" align="top" height="20px" />&nbsp; ' . __( 'Denim', 'faq-concertina' ) . '</label></td>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_five" name="faqconc_colour_scheme" value="5" ' . checked( 5, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_five"><img src="'   . plugins_url( 'assets/cs_strawberry.jpg', __FILE__ )    . '" align="top" height="20px" />&nbsp; ' . __( 'Strawberry', 'faq-concertina' ) . '</label></td>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_six" name="faqconc_colour_scheme" value="6" ' . checked( 6, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_six"><img src="'    . plugins_url( 'assets/cs_seashell.jpg', __FILE__ )      . '" align="top" height="20px" />&nbsp; ' . __( 'Seashell', 'faq-concertina' ) . '</label></td>';
	$html .= '</tr><tr>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_seven" name="faqconc_colour_scheme" value="7" ' . checked( 7, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_seven"><img src="'  . plugins_url( 'assets/cs_iceberg.jpg', __FILE__ )       . '" align="top" height="20px" />&nbsp; ' . __( 'Iceberg', 'faq-concertina' ) . '</label></td>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_eight" name="faqconc_colour_scheme" value="8" ' . checked( 8, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_eight"><img src="'  . plugins_url( 'assets/cs_forest.jpg', __FILE__ )        . '" align="top" height="20px" />&nbsp; ' . __( 'Forest', 'faq-concertina' ) . '</label></td>';
	$html .= '<td style="border:1px solid #ddd;width:160px;"><input type="radio" id="colour_scheme_nine" name="faqconc_colour_scheme" value="9" ' . checked( 9, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_nine"><img src="'   . plugins_url( 'assets/cs_paella.jpg', __FILE__ )        . '" align="top" height="20px" />&nbsp; ' . __( 'Paella', 'faq-concertina' ) . '</label></td>';
	$html .= '</tr><tr>';
	$html .= '<td style="border:1px solid #ddd;width:160px;" colspan="2"><input type="radio" id="colour_scheme_custom" name="faqconc_colour_scheme" value="0" ' . checked( 0, $colours, false ) . '/> ';
	$html .= '<label for="colour_scheme_custom"><img src="' . plugins_url( 'assets/cs_custom.jpg', __FILE__ )        . '" align="top" height="20px" />&nbsp; ' . __( 'Custom', 'faq-concertina' ) . '</label>';
	$html .= '<br /><br /><input name="faqconc_custom_colour1" type="text" value="' . $custcol1 . '" class="faqconc-color-field" /><br /><input name="faqconc_custom_colour2" type="text" value="' . $custcol2 . '" class="faqconc-color-field" /></td>';
	$html .= '</tr></table>';

	echo $html;

}
function faqconc_custcol1_validate( $input ) {

	// check for empty string
	if ( $input == "" ) {
		add_settings_error( 'faqconc_custom_colour1', 'faqconc_custcol1_msg', __( 'Custom colour 1 cannot be empty.', 'faq-concertina' ) );
		$custcol = get_option(  'faqconc_custom_colour1', '#3f6191' );
	} else {
		// check for leading # in string  
		if ( substr_compare( $input, "#", 0, 1 ) ) {
			add_settings_error( 'faqconc_custom_colour1', 'faqconc_custcol1_msg', __( 'Custom colour 1 has no leading #.', 'faq-concertina' ) );
			$custcol = get_option(  'faqconc_custom_colour1', '#3f6191' );
		} else {
			$custcol = ltrim( $input, '#' ); // trim leading #...
			// ...and check for valid hex code and that string is exactly six characters
			if ( !ctype_xdigit( $custcol ) || strlen( $custcol ) != 6 ) { 
				add_settings_error( 'faqconc_custom_colour1', 'faqconc_custcol1_msg', __( 'Invalid entry for custom colour 1. Custom colours must consist of exactly six hexadecimal characters (0-9, a-f).', 'faq-concertina' ) );
				$custcol = get_option(  'faqconc_custom_colour1', '#3f6191' );
			} else {
				// all is good, we have a valid colour
				$custcol = $input;
			}
		}
	}

	return $custcol;

}
function faqconc_custcol2_validate( $input ) {

	// check for empty string
	if ( $input == "" ) {
		add_settings_error( 'faqconc_custom_colour2', 'faqconc_custcol2_msg', __( 'Custom colour 2 cannot be empty.', 'faq-concertina' ) );
		$custcol = get_option(  'faqconc_custom_colour2', '#fbf6e4' );
	} else {
		// check for leading # in string
		if ( substr_compare( $input, "#", 0, 1 ) ) {
			add_settings_error( 'faqconc_custom_colour2', 'faqconc_custcol2_msg', __( 'Custom colour 2 has no leading #.', 'faq-concertina' ) );
			$custcol = get_option(  'faqconc_custom_colour2', '#fbf6e4' );
		} else {
			$custcol = ltrim( $input, '#' ); // trim leading #...
			// ...and check for valid hex code and that string is exactly six characters
			if ( !ctype_xdigit( $custcol ) || strlen( $custcol ) != 6 ) { 
				add_settings_error( 'faqconc_custom_colour2', 'faqconc_custcol2_msg', __( 'Invalid entry for custom colour 2. Custom colours must consist of exactly six hexadecimal characters (0-9, a-f).', 'faq-concertina' ) );
				$custcol = get_option(  'faqconc_custom_colour2', '#fbf6e4' );
			} else {
				// all is good, we have a valid colour
				$custcol = $input;
			}
		}
	}
		
	return $custcol;

}
function faqconc_invert_colours() {

	$invert = get_option( 'faqconc_negative', '0' );

	$html  = '<input type="checkbox" id="faqconc_negative" name="faqconc_negative"  value="1" ' . checked( 1, $invert, false ) .' />';
    $html .= '<label for="faqconc_negative"> ' . __( 'Inverts the colour scheme (useful if your theme has a dark background).', 'faq-concertina' ) . '</label>'; 

    echo $html;

}
function faqconc_corners() {

	$corners = get_option( 'faqconc_corners', '1' );

	$html  = '<table><tr>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="corners_one" name="faqconc_corners" value="1" ' . checked( 1, $corners, false ) . '/>';
	$html .= '<label for="corners_one"> ' . __( 'Square', 'faq-concertina' ) . ' &nbsp;<img src="' . plugins_url( 'assets/corner_square.jpg', __FILE__ ) . '" align="top" /></label></td>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="corners_two" name="faqconc_corners" value="2" ' . checked( 2, $corners, false ) . '/>';
	$html .= '<label for="corners_two"> ' . __( 'Rounded', 'faq-concertina' ) . ' &nbsp;<img src="' . plugins_url( 'assets/corner_round.jpg', __FILE__ ) . '" align="top" /></label></td>';
	$html .= '</tr></table>';

	echo $html;

}
function faqconc_indicators() {

	$indicators = get_option( 'faqconc_indicators', '0' );

	$html  = '<table><tr>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="indicators_none" name="faqconc_indicators" value="0" ' . checked( 0, $indicators, false ) . '/>';
	$html .= '<label for="indicators_none"> ' . __( 'None', 'faq-concertina' ) . ' </label></td>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="indicators_one" name="faqconc_indicators" value="1" ' . checked( 1, $indicators, false ) . '/>';
	$html .= '<label for="corners_one"> +/- ' . __( 'signs', 'faq-concertina' ) . ' &nbsp;<img src="' . plugins_url( 'assets/ind_plusminussign.jpg', __FILE__ ) . '" align="top" height="18px" /></label></td>';
	$html .= '<td style="border:1px solid #ddd;width:126px;"><input type="radio" id="indicators_two" name="faqconc_indicators" value="2" ' . checked( 2, $indicators, false ) . '/>';
	$html .= '<label for="indicators_two"> ' . __( 'Arrows', 'faq-concertina' ) . ' &nbsp;<img src="' . plugins_url( 'assets/ind_arrow.jpg', __FILE__ ) . '" align="top" height="18px"/></label></td>';
	$html .= '</tr></table>';

	echo $html;

}
function faqconc_disable_styles() {

	$disable = get_option( 'faqconc_disable_styles', '0' );

	$html  = '<input type="checkbox" id="faqconc_disable_styles" name="faqconc_disable_styles"  value="1" ' . checked( $disable, 1, false ) . ' />';
    $html .= '<label for="faqconc_disable_styles"> ' . __( 'Disable all appearance settings and only use .css file.', 'faq-concertina' ) . '</label>';

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
 
    if ( $faqconc_shortcode_found ){ // shortcode has been found so let's load the styles!

    	// load external stylesheet
        wp_register_style( 'faqconc-styles', plugins_url( 'css/faq-concertina-styles.css', __FILE__ ) );
		wp_enqueue_style( 'faqconc-styles' );

    	// if inline styles are not disabled....
    	if ( get_option( 'faqconc_disable_styles' ) != 1 ) {
    		// ... create the inline styles.
	    	// get width and sanitise
	    	$faq_width = get_option( 'faqconc_width', '75' );
			// get colour scheme and custom colours
			$faq_colours = get_option( 'faqconc_colour_scheme', '2' ); 
			switch ( $faq_colours ) {
				case "1": $faq_col1 = "#000000"; $faq_col2 = "#ffffff"; break; // Black & White
				case "2": $faq_col1 = "#666666"; $faq_col2 = "#eeeeee"; break; // Shades of Grey
				case "3": $faq_col1 = "#616d7e"; $faq_col2 = "#e5e4e2"; break; // Jet
				case "4": $faq_col1 = "#357ec7"; $faq_col2 = "#c2dfff"; break; // Denim
				case "5": $faq_col1 = "#e42217"; $faq_col2 = "#ffdfdd"; break; // Strawberry
				case "6": $faq_col1 = "#7f5a58"; $faq_col2 = "#fff5ee"; break; // Seashell
				case "7": $faq_col1 = "#3b9c9c"; $faq_col2 = "#ccffff"; break; // Iceberg
				case "8": $faq_col1 = "#347235"; $faq_col2 = "#ccfb5d"; break; // Forest
				case "9": $faq_col1 = "#e42217"; $faq_col2 = "#ffd801"; break; // Paella
				case "0": $faq_col1 = get_option( 'faqconc_custom_colour1', '#3f6191' ); // Custom colours 
						  $faq_col2 = get_option( 'faqconc_custom_colour2', '#fbf6e4' );
						  break;
				default:  $faq_col1 = "#666666"; $faq_col2 = "#eeeeee"; 		// default to Shades of Grey
			}
			// invert colours if 'negative' set
			if ( get_option( 'faqconc_negative' ) == "1" ) { $faq_temp = $faq_col1; $faq_col1 = $faq_col2; $faq_col2 = $faq_temp; }
			// get corner option
			if ( get_option( 'faqconc_corners' ) == "2" ) { $corner = "border-radius: 4px; "; } else { $corner = ""; }
			// get indicators option	
			$faq_indicators = get_option( 'faqconc_indicators', '0' );
			switch ( $faq_indicators ) {
				case "0": $indicators = ''; break; // No indicators
				case "1": $indicators = '.faq_q:before { content: "+"; font-size: 14px; border: 1px solid; border-radius: 1px; padding: 0 4px; margin-left: 6px; float:right; line-height: 16px; } .faq_is_open:before { content: "­−"; } .faq_q { padding-right: 8px; }'; break; // +/- indicators
				case "2": $indicators = '.faq_q:before { content: "\25BD"; font-size: 14px; margin-left: 6px; float:right; } .faq_is_open:before { content: "\25B3"; } .faq_q { padding-right: 8px; }'; break; // Arrow indicators
				default:  $indicators = '';
			}
			// construct inline CSS
	     	$faq_css = "
	    			.faqconc  	 { width: " . $faq_width . "%; } 
	    			.faq_item 	 { background: " . $faq_col2 . "; border-color: " . $faq_col1 . "; " . $corner . "}
	    			.faq_q    	 { background: " . $faq_col1 . "; color: " . $faq_col2 . "; } 
	    			.faq_q:focus { outline: none; box-shadow: 0px 0px 6px 4px " . $faq_col1 . "; }
	    			.faq_a    	 { color: " . $faq_col1 . "; }
	    			" . $indicators;
			// get width override option and add media query
			if ( get_option( 'faqconc_width_override' ) == '1' ) {
				$faq_css .= "
					@media screen and (max-width: 600px) { .faqconc { width: 100%; } }
				"; 
			}
			// put inline styles in <head>
    		wp_add_inline_style( 'faqconc-styles', $faq_css );
		}

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
		wp_register_script( 'faqconc-script', plugins_url( 'js/faq-concertina-script.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'faqconc-script' );
		wp_localize_script( 'faqconc-script', 'faqconcvars', array ( 'speed' => $speed, 'hideothers' => $hide_others, 'category' => $category ) );

		// display the FAQs
		$current_ver = '1_4_3';
		$faq_concertina = $category ? '<div id="faqconc_' . $current_ver . '_' . $category . '" class="faqconc ' . $category . '" role="tablist" aria-multiselectable="true">' :'<div id="faqconc_' . $current_ver . '" class="faqconc" role="tablist" aria-multiselectable="true">'; // Add category as class if it exists
 
 		while ( $faqs->have_posts() ) {
			$faqs->the_post();
			$faqid = get_the_ID();
			$faq_concertina .= '<div class="faq_item" id="faq' . $faqid . $category . '">';
			$faq_concertina .= '<div class="faq_q" id="faq' . $faqid . $category . '_q" aria-selected="false" aria-expanded="false" aria-controls ="faq' . $faqid . $category . '_a" role="tab" tabindex="-1">';
			$faq_concertina .= get_the_title();
			$faq_concertina .= '</div>'; // .faq_q
			$faq_concertina .= '<div class="faq_a" id="faq' . $faqid . $category . '_a" aria-labelledby="faq' . $faqid . $category . '_q" aria-hidden="true" role="tabpanel">';
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