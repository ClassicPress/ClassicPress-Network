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

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	$prefix = 'crum_page_custom_';
	
	$meta_boxes[] = array(
		'id'         => 'dfd-page_bg_metabox',
		'title'      => esc_html__('Page options', 'dfd-native'),
		'pages'      => array('page','post','portfolio','product','gallery'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => esc_html__('Layout settings','dfd-native'),
				'desc' => '',
				'id' => 'page_layout_heading',
				'type' => 'title',
			),
			array(
				'name' =>  esc_html__('Layout width', 'dfd-native'),
	            'tooltip_text' => esc_html__('Allows you to set your page content width to full width or boxed. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'dfd_layout_width',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/layout-width.png',
				'std' => '',
				'options' => array(
					array('name' => esc_attr__('Theme default', 'dfd-native'),'value' => '',),
					array('name' => esc_attr__('Boxed', 'dfd-native'),'value' => 'boxed',),
					array('name' => esc_attr__('Full width', 'dfd-native'),'value' => 'full-width',),
				),
			),
			array(
				'name'	=> esc_html__('Sidebar configuration', 'dfd-native'),
	            'tooltip_text' => esc_html__('Allows you to choose sidebars and their position. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'id'	=> 'dfd_sidebars_configuration',
				'type'	=> 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/sidebars.png',
				'options' => array(
					array( 'name' => esc_attr__('Theme default', 'dfd-native'), 'value' => '', ),
                    array( 'name' => esc_attr__('No sidebars', 'dfd-native'), 'value' => '1col-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on left', 'dfd-native'), 'value' => '2c-l-fixed', ),
                    array( 'name' => esc_attr__('Sidebar on right', 'dfd-native'), 'value' => '2c-r-fixed', ),
                    array( 'name' => esc_attr__('Both left and right sidebars', 'dfd-native'), 'value' => '3c-fixed', ),
				),
			),
			array(
				'name' => esc_html__('Background settings','dfd-native'),
				'desc' => '',
				'id' => 'page_background_heading',
				'type' => 'title',
			),
			array(
	            'name' => esc_html__('Background color', 'dfd-native'),
	            'tooltip_text' => esc_html__('The color will be seen if the image background is not set for the page or image does not cover the whole page.', 'dfd-native'),
	            'id'   => $prefix . 'bg_color',
	            'type' => 'colorpicker',
				'std'  => ''
	        ),
            array(
                'name' => esc_html__('Fixed background', 'dfd-native'),
                'tooltip_text' => esc_html__('When enabled fixed background, the background image is fixed and content scrolls separately over it. When fixed background is disabled, the background image scrolls with the content.', 'dfd-native'),
                'id'   => $prefix . 'bg_fixed',
                'type' => 'checkbox',
            ),
			array(
				'name' => esc_html__('Background image', 'dfd-native'),
				'tooltip_text' => esc_html__('Upload an image or enter an URL.', 'dfd-native'),
				'id'   => $prefix . 'bg_image',
				'type' => 'file',
			),
            array(
                'name'    => esc_html__('Background image repeat', 'dfd-native'),
				'tooltip_text' => esc_html__('Allows you to repeat or do not repeate the image set on the background.', 'dfd-native'),
                'id'      => $prefix . 'bg_repeat',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => esc_html__('All', 'dfd-native'), 'value' => 'repeat', ),
                    array( 'name' => esc_html__('Horizontally', 'dfd-native'), 'value' => 'repeat-x', ),
                    array( 'name' => esc_html__('Vertically', 'dfd-native'), 'value' => 'repeat-y', ),
                    array( 'name' => esc_html__('No-Repeat', 'dfd-native'), 'value' => 'no-repeat', ),
                ),
            ),
			array(
				'name' => esc_html__('Background size','dfd-native'),
				'tooltip_text' => esc_html__('Adjust the background image displaying.', 'dfd-native'),
				'id' => $prefix . 'bg_size',
				'type' => 'select',
				'options' => Dfd_Theme_Helpers::dfd_get_bgsize('metaboxes'),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Advanced settings','dfd-native'),
				'desc' => '',
				'id' => 'page_advanced_heading',
				'type' => 'title',
			),
			array(
				'name' => esc_html__( 'Layout frame', 'dfd-native' ),
				'tooltip_text' => esc_html__('Layout frame around the page.', 'dfd-native'),
				'id'   => 'dfd_enable_page_spacer',
				'type' => 'checkbox',
			),
			array(
				'name' => esc_attr__( 'Parallax footer', 'dfd-native' ),
				'tooltip_text' => esc_attr__( 'When enabled, the footer is fixed and content scrolls over it.', 'dfd-native' ),
				'id'   => 'crum_page_custom_footer_parallax',
				'type' => 'checkbox',
			),
			array(
				'name' => esc_attr__( 'Start images lazy load outside of viewport', 'dfd-native' ),
				'tooltip_text' => esc_attr__( 'This option allows you to preload images when they are not visible', 'dfd-native' ),
				'id'   => 'reduce_lazy_load_offset',
				'type' => 'checkbox',
			),
		),
	);	

    $meta_boxes[] = array(
		'id' => 'dfd-pagination_type',
		'title' => esc_html__('Pagination type', 'dfd-native'),
		'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array(
			'key' => 'page-template',
			'value' => array(
				'tmp-portfolio.php',
				'tmp-blog.php',
				'tmp-gallery.php',
			),
		),
		'show_names' => true,
		'fields' => array(
			array(
				'name' => esc_html__('Pagination settings','dfd-native'),
				'desc' => '',
				'id' => 'pagination_settings_heading',
				'type' => 'title',
			),
			array(
				'name' => esc_html__('Pagination type', 'dfd-native'),
				'tooltip_text' => esc_attr__( 'Allows you to select the style of the pagination - it\'s the way extra content is loaded.', 'dfd-native' ),
				'id' => 'dfd_pagination_type',
				'type' => 'radio_inline',
				'std' => 'default',
				'options' => array(
					array(
						'name' => esc_html__('Pagination', 'dfd-native'),
						'value' => 'default',
					),
					array(
						'name' => esc_html__('Load more button', 'dfd-native'),
						'value' => '1'
					),
					array(
						'name' => esc_html__('Lazy load on scroll', 'dfd-native'),
						'value' => '2'
					),
				),
			),
			array(
				'name' => esc_html__('Pagination style', 'dfd-native'),
				'tooltip_text' => esc_attr__( 'If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native' ),
				'id' => 'dfd_pagination_style',
				'type' => 'radio_image',
				'image'	=> get_template_directory_uri().'/assets/admin/img/pagination.png',
				'std' => '0',
				'options' => array(
					array(
						'name' => esc_html__('Theme default', 'dfd-native'),
						'value' => '',
					),
					array(
						'name' => esc_html__('Style 1', 'dfd-native'),
						'value' => '1'
					),
					array(
						'name' => esc_html__('Style 2', 'dfd-native'),
						'value' => '2'
					),
					array(
						'name' => esc_html__('Style 3', 'dfd-native'),
						'value' => '3'
					),
					array(
						'name' => esc_html__('Style 4', 'dfd-native'),
						'value' => '4'
					),
					array(
						'name' => esc_html__('Style 5', 'dfd-native'),
						'value' => '5'
					),
				),
				'dep_option'    => 'dfd_pagination_type',
				'dep_values'    => 'default',
			),
		),
	);

	return $meta_boxes;
}
