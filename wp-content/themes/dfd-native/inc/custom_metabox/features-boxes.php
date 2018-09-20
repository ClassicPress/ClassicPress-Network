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

add_filter( 'cmb_meta_boxes', 'crum_feat_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function crum_feat_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'crum_features_';

	$meta_boxes[] = array(
		'id'         => 'dfd-features_metabox',
		'title'      => esc_html__('Feature box options', 'dfd-native'),
		'pages'      => array( 'features', ), // Post type
		'context'    => 'side',
		'priority'   => 'default',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
                    array(
	            'name' => 'Icon name',
	            'desc' => esc_html__('Icon for features box', 'dfd-native'),
	            'id'   => $prefix . 'feat_icon',
	            'type' => 'icon',
                    'std'  => ''
                    ),
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}
