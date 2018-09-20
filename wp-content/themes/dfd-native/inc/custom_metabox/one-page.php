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

add_filter( 'cmb_meta_boxes', 'dfd_one_page_metaboxes' );


function dfd_one_page_metaboxes( array $meta_boxes ) {
	$meta_boxes[] = array(
        'id'         => 'dfd-adaptive-header-options',
        'title'      => esc_html__('One page scroll settings', 'dfd-native'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'default',
        'show_on' => array(
			'key' => 'page-template',
			'value' => array(
				'tmp-one-page-scroll.php',
			),
		),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
			array(
				'name' => esc_html__('One page scroll page settings','dfd-native'),
				'desc' => '',
				'id' => 'one_page_layout_heading',
				'type' => 'title',
			),
			array(
				'id'   => 'dfd_animation_style',
				'tooltip_text'	=> esc_html__('Allows to choose one of the preset scrolling animation styles', 'dfd-native'),
				'name' => esc_html__('Animation style', 'dfd-native'),
				'desc' => '',
				'type' => 'radio_inline_triple',
				'options' => array(
					array('name' => esc_html__('Simple','dfd-native'),'value' => 'none',),
					array('name' => esc_html__('Slide','dfd-native'),'value' => 'dfd-3d-style-1',),
					array('name' => esc_html__('Scale','dfd-native'),'value' => 'dfd-3d-style-2',),
					array('name' => esc_html__('Rotate','dfd-native'),'value' => 'dfd-3d-style-3',),
				),
				'std'  => 'none',
			),
			array(
				'id'   => 'dfd_enable_pagination_dots',
				'tooltip_text'	=> esc_html__('Allows to show or hide dots navigation on the right side of the page', 'dfd-native'),
				'name' => esc_html__('Enable dots navigation', 'dfd-native'),
				'desc' => '',
				'std' => 'on',
				'options' => array(
					array('name' => esc_html__('On','dfd-native'),'value' => 'on',),
					array('name' => esc_html__('Off','dfd-native'),'value' => 'off',),
				),
				'type' => 'radio_inline_triple',
			),
            array(
                'id'   => 'dfd_auto_header_colors',
				'tooltip_text'	=> esc_html__('This option allows you to change the header elements\' color according to the color scheme set in row settings. It makes the elements always visible', 'dfd-native'),
                'name' => esc_html__('Smart header', 'dfd-native'),
                'desc' => '',
				'type'	=> 'radio_inline_triple',
				'options' => array(
					array(
						'name' => esc_html__('Enable', 'dfd-native'),
						'value' => 'on',
					),
					array(
						'name' => esc_html__('Disable', 'dfd-native'),
						'value' => 'off',
					),
				),
            ),
			array(
	            'name' => esc_html__('Light logo','dfd-native'),
	            'tooltip_text' => esc_html__('This logo will be displayed of slides with dark background', 'dfd-native'),
	            'id'   => 'dfd_smart_header_light_logo',
                'type' => 'file',
                'save_id' => false, // save ID using true
				'std'  => '',
				'dep_option'    => 'dfd_auto_header_colors',
				'dep_values'    => 'on',
	        ),
			array(
	            'name' => esc_html__('Dark logo','dfd-native'),
	            'tooltip_text' => esc_html__('This logo will be displayed of slides with light background', 'dfd-native'),
	            'id'   => 'dfd_smart_header_dark_logo',
                'type' => 'file',
                'save_id' => false, // save ID using true
				'std'  => '',
				'dep_option'    => 'dfd_auto_header_colors',
				'dep_values'    => 'on',
	        ),
		),
	);
	
    // Add other metaboxes as needed

    return $meta_boxes;
}