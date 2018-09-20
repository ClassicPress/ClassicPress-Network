<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

class WPBakeryShortCode_Dfd_Side_By_Side_Slider  extends WPBakeryShortCodesContainer {}
vc_map(array(
	'name'						=>  esc_html__( 'Side by Side slider', 'dfd' ),
	'base'						=> 'dfd_side_by_side_slider',
	'icon'						=> 'dfd_side_by_side_slider dfd_shortcode',
	'class'						=> 'dfd_side_by_side_slider dfd_shortcode',
	'as_parent'					=> array('only' => 'dfd_side_by_side_left, dfd_side_by_side_right'),
	'content_element'			=> true,
	'category'					=> esc_attr__('Native','dfd'),
	'show_settings_on_create'	=> false,
	'js_view'					=> 'VcColumnView',
	'params'					=> array(
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Extra class name', 'js_composer'),
			'param_name'	=> 'el_class',
			'description'	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
		),
	)
));

class WPBakeryShortCode_Dfd_Side_By_Side_Left  extends WPBakeryShortCodesContainer {}
vc_map(array(
	'name'						=>  esc_html__( 'Side by Side Left Container', 'dfd' ),
	'base'						=> 'dfd_side_by_side_left',
	'icon'						=> 'dfd_side_by_side_left dfd_shortcode',
	'class'						=> 'dfd_side_by_side_left dfd_shortcode',
	'as_parent'					=> array('only' => 'dfd_side_by_side_slide'),
	'as_child'					=> array('only' => 'dfd_side_by_side_slider'),
	'content_element'			=> true,
	'show_settings_on_create'	=> false,
	'js_view'					=> 'VcColumnView',
	'category'					=> esc_attr__('Native','dfd'),
	'params'					=> array(
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Extra class name', 'js_composer'),
			'param_name'	=> 'el_class',
			'description'	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
		),
	)
));

class WPBakeryShortCode_Dfd_Side_By_Side_Right  extends WPBakeryShortCodesContainer {}
vc_map(array(
	'name'						=>  esc_html__( 'Side by Side Right Container', 'dfd' ),
	'base'						=> 'dfd_side_by_side_right',
	'icon'						=> 'dfd_side_by_side_right dfd_shortcode',
	'class'						=> 'dfd_side_by_side_right dfd_shortcode',
	'as_parent'					=> array('only' => 'dfd_side_by_side_slide'),
	'as_child'					=> array('only' => 'dfd_side_by_side_slider'),
	'content_element'			=> true,
	'show_settings_on_create'	=> false,
	'js_view'					=> 'VcColumnView',
	'category'					=> esc_attr__('Native','dfd'),
	'params'					=> array(
		array(
			'type'			=> 'textfield',
			'heading'		=> esc_html__('Extra class name', 'js_composer'),
			'param_name'	=> 'el_class',
			'description'	=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
		),
	)
));

class WPBakeryShortCode_Dfd_Side_By_Side_Slide  extends WPBakeryShortCodesContainer {}
vc_map(array(
	'name'						=>  esc_html__( 'Side by Side Slider Item', 'dfd' ),
	'base'						=> 'dfd_side_by_side_slide',
	'icon'						=> 'dfd_side_by_side_slide dfd_shortcode',
	'class'						=> 'dfd_side_by_side_slide dfd_shortcode',
	'as_parent'					=> array('except' => 'dfd_side_by_side_slider, dfd_side_by_side_left, dfd_side_by_side_right, dfd_side_by_side_slide'),
	'as_child'					=> array('only' => 'dfd_side_by_side_left, dfd_side_by_side_right'),
	'category'					=> esc_attr__('Native','dfd'),
	'content_element'			=> true,
	'show_settings_on_create'	=> true,
	'js_view'					=> 'VcColumnView',
	'params'					=> array(
		array(
			'type'				=> 'css_editor',
			'edit_field_class'	=> 'vc_col-xs-12 vc_column dfd_side_by_side_item_custom_class',
			'heading'			=> esc_html__( 'CSS box', 'js_composer' ),
			'param_name'		=> 'css',
			'group'				=> esc_html__( 'Design Options', 'js_composer' )
		),
		array(
			'type'				=> 'dropdown',
			'heading'			=> esc_html__('Select Slide Background Style', 'dfd'),
			'param_name'		=> 'slide_bg_check',
			'value'				=> array(
				esc_html__('Light background', 'dfd')	=> '',
				esc_html__('Dark background', 'dfd')	=> 'column-background-dark'
			),
		),
		array(
			'type'				=> 'textfield',
			'heading'			=> esc_html__('Extra class name', 'js_composer'),
			'param_name'		=> 'el_class',
			'description'		=> esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
		),
	)
));