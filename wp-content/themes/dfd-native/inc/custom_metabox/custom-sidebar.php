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

add_filter( 'cmb_meta_boxes', 'cmb_sidebar_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sidebar_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'crum_sidebars_';
	
    $meta_boxes[] = array(
        'id'         => 'dfd-sidebar_select_metabox',
        'title'      => esc_html__('Sidebar', 'dfd-native'),
        'pages'      => array('page','post','portfolio','product','gallery'),
        'context'    => 'side',
        'priority'   => 'default',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => esc_html__('Select Left sidebar', 'dfd-native'),
                'desc' => '',
                'id'   => $prefix . 'sidebar_1',
                'type' => 'select',
				'options' => Dfd_Theme_Helpers::sidebars_option(__('Left sidebar is not selected', 'dfd-native')),
                'std'  => ''
            ),
            array(
                'name' => esc_html__('Select Right sidebar', 'dfd-native'),
                'desc' => '',
                'id'   => $prefix . 'sidebar_2',
                'type' => 'select',
				'options' => Dfd_Theme_Helpers::sidebars_option(__('Right sidebar is not selected', 'dfd-native')),
                'std'  => ''
            ),
         ),
    );
    
   
    // Add other metaboxes as needed

    return $meta_boxes;
}