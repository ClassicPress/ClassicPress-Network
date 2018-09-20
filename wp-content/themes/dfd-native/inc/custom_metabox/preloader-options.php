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

add_filter( 'cmb_meta_boxes', 'dfd_headers_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes Metabox options.
 *
 * @return array
 */
function dfd_headers_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list.
	$prefix = 'preloader_';

	$meta_boxes[] = array(
		'id'         => 'dfd-preloader_settings_box',
		'title'      => esc_html__( 'Preloader options', 'dfd-native' ),
		'pages'      => array('page','post','portfolio','product','gallery'),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left.
		'fields'     => array(
			array(
				'name' => esc_html__('Preloader styling options','dfd-native'),
				'desc' => '',
				'id' => 'preloader_styles_heading',
				'type' => 'title',
			),
			array(
				'name'    => esc_html__( 'Enable preloader', 'dfd-native' ),
				'id'      => 'site_preloader_enabled',
				'tooltip_text' => esc_html__('Allows you to enable site preloader. It appears while the content is loading and prevents visitor from seeing the content restructures while all the images and text are rendered. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'type'    => 'radio_inline_triple',
				'options' => array(
					array( 'name'  => esc_attr__( 'Theme default', 'dfd-native' ), 'value' => '', ),
					array( 'name'  => esc_attr__( 'On', 'dfd-native' ), 'value' => '1', ),
					array( 'name'  => esc_attr__( 'Off', 'dfd-native' ), 'value' => 'off', ),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_html__( 'Preloader style', 'dfd-native' ),
				'id'      => $prefix . 'style',
				'tooltip_text' => esc_html__('Allows you to select the preloader style for your page. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name'  => esc_attr__( 'Theme default', 'dfd-native' ), 'value' => '', ),
					array( 'name'  => esc_attr__( 'None', 'dfd-native' ), 'value' => 'none', ),
					array( 'name'  => esc_attr__( 'CSS Animation', 'dfd-native' ), 'value' => 'css_animation', ),
					array( 'name'  => esc_attr__( 'Image', 'dfd-native' ), 'value' => 'image', ),
					array( 'name'  => esc_attr__( 'Progress bar', 'dfd-native' ), 'value' => 'progress_bar', ),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Animation style', 'dfd-native' ),
				'id'      => $prefix . 'animation_style',
				'tooltip_text' => esc_html__('Allows you to select the preloader CSS Animation styles for your page. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'type'    => 'select',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'css_animation',
				'options' => Dfd_Theme_Helpers::dfd_preloader_animation_style_cmb(),
				'std'     => '1',
			),
			array(
				'name'    => esc_attr__( 'Animation base color', 'dfd-native' ),
				'id'      => $prefix . 'animation_color',
				'tooltip_text' => esc_html__('Allows you to select the color for the selected CSS animation style.', 'dfd-native'),
				'type'    => 'colorpicker',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'css_animation',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Preloader image', 'dfd-native' ),
				'id'      => $prefix . 'img',
				'tooltip_text' => esc_html__('Allows you to select and upload the image for the preloader on your page.', 'dfd-native'),
				'type'    => 'file',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'image',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name' => esc_attr__( 'Preloader bar height in px', 'dfd-native' ),
				'desc' => '',
				'tooltip_text' => esc_html__('Allows you to set the preloader bar.', 'dfd-native'),
				'id'   => $prefix . 'bar_height',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
				'type' => 'text',
			),
			array(
				'name'    => esc_attr__( 'Preloader bar background color', 'dfd-native' ),
				'id'      => $prefix . 'bar_bg',
				'tooltip_text' => esc_html__('Select the color for your preloader bar to be displayed on the page.', 'dfd-native'),
				'type'    => 'colorpicker',
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Preloader bar position', 'dfd-native' ),
				'id'      => $prefix . 'bar_position',
				'tooltip_text' => esc_html__('Allows you to select the preloader bar position. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name'  => esc_attr__( 'Theme default', 'dfd-native' ), 'value' => '', ),
					array( 'name'  => esc_attr__( 'Middle', 'dfd-native' ), 'value' => 'middle', ),
					array( 'name'  => esc_attr__( 'Top', 'dfd-native' ), 'value' => 'top', ),
					array( 'name'  => esc_attr__( 'Bottom', 'dfd-native' ), 'value' => 'bottom', ),
				),
				'dep_option'    => $prefix . 'style',
				'dep_values'    => 'progress_bar',
				'std'     => 'middle',
			),
			array(
				'name' => esc_html__('Preloader background settings','dfd-native'),
				'desc' => '',
				'id' => 'preloader_background_heading',
				'type' => 'title',
			),
			array(
				'name'    => esc_attr__( 'Background image', 'dfd-native' ),
				'id'      => $prefix . 'bg_img',
				'tooltip_text' => esc_html__('The image will be displayed as a background for the preloader.', 'dfd-native'),
				'type'    => 'file',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background position', 'dfd-native' ),
				'id'      => $prefix . 'bg_img_position',
				'tooltip_text' => esc_html__('Allows you to select the image position for preloader.', 'dfd-native'),
				'type'    => 'select',
				'options' => Dfd_Theme_Helpers::dfd_get_bgposition_redux(),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background color', 'dfd-native' ),
				'id'      => $prefix . 'bg_color',
				'tooltip_text' => esc_html__('The color will be displayed as a background for the preloader.', 'dfd-native'),
				'type'    => 'colorpicker',
				'save_id' => false,
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background size', 'dfd-native' ),
				'id'      => $prefix . 'bg_size',
				'tooltip_text' => esc_html__('Allows you to adjust the background image displaying.', 'dfd-native'),
				'type'    => 'select',
				'options' => array(
					array( 'name'  => esc_attr__( 'Cover', 'dfd-native' ), 'value' => 'cover', ),
					array( 'name'  => esc_attr__( 'Contain', 'dfd-native' ), 'value' => 'contain', ),
					array( 'name'  => esc_attr__( 'Inheirt', 'dfd-native' ), 'value' => 'inherit', ),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background repeat', 'dfd-native' ),
				'id'      => $prefix . 'bg_repeat',
				'tooltip_text' => esc_html__('Allows you to repeat or do not repeate the image set on the background.', 'dfd-native'),
				'type'    => 'select',
				'options' => array(
					array( 'name'  => esc_attr__( 'No-repeat', 'dfd-native' ), 'value' => 'no-repeat', ),
					array( 'name'  => esc_attr__( 'Repeat All', 'dfd-native' ), 'value' => 'repeat', ),
					array( 'name'  => esc_attr__( 'Repeat Horizontally', 'dfd-native' ), 'value' => 'repeat-x', ),
					array( 'name'  => esc_attr__( 'Repeat Vertically', 'dfd-native' ), 'value' => 'repeat-y', ),
					array( 'name'  => esc_attr__( 'Inheirt', 'dfd-native' ), 'value' => 'inherit', ),
				),
				'std'     => '',
			),
			array(
				'name'    => esc_attr__( 'Background attachment', 'dfd-native' ),
				'id'      => $prefix . 'bg_attachment',
				'tooltip_text' => esc_html__('When scroll background style is enabled, the background image scrolls with the content. When fixed background style is enabled, the background image is fixed and content scrolls over it. When initial background style is enabled, the background image and content will be fixed.', 'dfd-native'),
				'type'    => 'select',
				'options' => array(
					array( 'name'  => esc_attr__( 'Inherit', 'dfd-native' ), 'value' => 'inherit', ),
					array( 'name'  => esc_attr__( 'Scroll', 'dfd-native' ), 'value' => 'scroll', ),
					array( 'name'  => esc_attr__( 'Fixed', 'dfd-native' ), 'value' => 'fixed', ),
				),
				'std'     => '',
			),
			array(
				'name' => esc_html__('Counter settings','dfd-native'),
				'desc' => '',
				'id' => 'preloader_counter_heading',
				'type' => 'title',
			),
			array(
				'name'    => esc_attr__( 'Counter', 'dfd-native' ),
				'id'      => $prefix . 'enable_counter',
				'tooltip_text' => esc_html__('Allows you to enable per cents counter for the page loading. If you choose theme default the displaying will correspond to the theme options settings.', 'dfd-native'),
				'type'    => 'radio_inline_triple',
				'options' => array(
					array( 'name'  => esc_attr__( 'Theme default', 'dfd-native' ), 'value' => '', ),
					array( 'name'  => esc_attr__( 'On', 'dfd-native' ), 'value' => 'on', ),
					array( 'name'  => esc_attr__( 'Off', 'dfd-native' ), 'value' => 'off', ),
				),
			),
		),
	);

	return $meta_boxes;
}
