<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Ronneby theme
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'cmb_meta_boxes', 'cmb_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dfd_cmb_convert_option($options, $default_text) {
	$return = array();
	if( is_array($options) ){
		array_unshift( $options, $default_text );
		foreach($options as $v => $k) {
			$result = array();
			$result['name'] = $k;
			$result['value'] = $v;
			$return[] = $result;
		}
	}
	return $return;
}

function cmb_headers_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'dfd_headers_';
	
	$the_headers = Dfd_Theme_Helpers::dfd_headers_type();
	$logo_position = Dfd_Theme_Helpers::dfd_logo_position();
	$menu_position = Dfd_Theme_Helpers::dfd_menu_position();
	
   
	$meta_boxes[] = array(
        'id'         => 'dfd-select_header',
        'title'      => esc_html__('Header style', 'dfd-native'),
        'pages'      =>  array('page','post','portfolio','product','gallery'),
        'context'    => 'side',
        'priority'   => 'default',
        'show_names' => true, // Show field names on the left
        'fields'     => array(         
            array(
                'name' => esc_html__('Select Header Style', 'dfd-native'),
                'desc' => '',
                'id' =>  $prefix.'header_style',
                'type' => 'select',
				'options' => dfd_cmb_convert_option($the_headers, esc_html__('Header style is not selected', 'dfd-native')),
                'std'  => ''
            ),
            array(
                'name' => esc_html__('Select Logo position', 'dfd-native'),
                'desc' => '',
                'id' =>  $prefix.'logo_position',
                'type' => 'select',   
				'options' => dfd_cmb_convert_option($logo_position, esc_html__('Logo position is not selected', 'dfd-native')),
                'std'  => ''
            ),
            array(
                'name' => esc_html__('Select Menu position', 'dfd-native'),
                'desc' => '',
                'id' =>  $prefix.'menu_position',
                'type' => 'select',   
				'options' => dfd_cmb_convert_option($menu_position, esc_html__('Menu position is not selected', 'dfd-native')),
                'std'  => ''
            ),
			array(
                'name' => esc_html__('Side Area', 'dfd-native'),
				'desc'	=> '',
                'id' =>  $prefix.'show_side_area',
				'type'	=> 'checkbox',
			),
			array(
                'name' => esc_html__('Top inner page', 'dfd-native'),
				'desc'	=> '',
                'id' =>  $prefix.'show_top_inner_page',
				'type'	=> 'checkbox',
			),
        ),
    );

    // Add other metaboxes as needed

    return $meta_boxes;
}