<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'dfd_product_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function dfd_product_metaboxes( array $meta_boxes ) {

	$meta_boxes[] = array(
		'id'         => 'dfd-product_subtitle_metabox',
		'title'      => esc_html__('Additional options', 'dfd-native'),
		'pages'      => array( 'product' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
	            'name' => esc_html__('Product subtitle', 'dfd-native'),
	            'desc' => '',
	            'id'   => 'dfd_product_product_subtitle',
                'type' => 'text',
                'save_id' => false, // save ID using true
				'std'  => ''
	        ),
		),
	);

	return $meta_boxes;
}
