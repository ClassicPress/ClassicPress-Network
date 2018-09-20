<?php
if (!defined('ABSPATH')) {exit;}

class WPBakeryShortCode_Dfd_Google_Map extends WPBakeryShortCode {}

$module_images = DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/gmap/tooltip/';
vc_map(
	array (
		'name' => esc_html__('Google Map', 'dfd-native'),
		'base' => 'dfd_google_map',
		'class' => 'dfd_google_map dfd_shortcode',
		'controls' => 'full',
		'show_settings_on_create' => true,
		'icon' => 'dfd_google_map dfd_shortcode',
		'description' => esc_html__('Display Google Maps to indicate your location.', 'dfd-native'),
		'category' => esc_html__('Native', 'dfd-native'),
		'params' => array (
			array (
				'type' => 'radio_image_select',
				'heading' => esc_html__('Map Style', 'dfd-native'),
				'param_name' => 'map_style',
				'admin_label' => true,
				'simple_mode' => false,
				'value'=>'subtle-grayscale',
				'options' => Dfd_Theme_Helpers::dfd_google_map_custom_styles(true, DFD_EXTENSIONS_PLUGIN_URL),
			),
			array (
				'type' => 'param_group',
				'heading' => esc_html__('Locations', 'dfd-native'),
				'param_name' => 'location_list',
				'group' => esc_html__('Locations', 'dfd-native'),
				'params' => array (
					array (
						'heading' => esc_html__('Marker Style', 'dfd-native'),
						'type' => 'radio_image_select',
						'param_name' => 'show_tooltip',
						'simple_mode' => false,
						'options' => array (
							'marker' => array (
								'tooltip' => esc_attr__('Marker thumbnail', 'dfd-native'),
								'src' => $module_images . 'style_01.png'
							),
							'infowindow' => array (
								'tooltip' => esc_attr__('Info window', 'dfd-native'),
								'src' => $module_images . 'style_02.png'
							),
						),
					),
					array (
						'type' => 'dfd_radio_advanced',
						'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose when the tooltip should be visible. Tooltip is a small pop-up box','dfd-native').'</span></span>'.esc_html__('Tooltip visibility', 'dfd-native'),
						'value' => 'hide',
						'options' => array (
							esc_attr__('Hide', 'dfd-native') => 'hide',
							esc_attr__('Show on click', 'dfd-native') => 'show_onclick',
							esc_attr__('Always visible', 'dfd-native') => 'always_show',
						),
						'param_name' => 'tooltip_show_setting',
						'dependency' => array ('element' => 'show_tooltip', 'value_not_equal_to' => array ('infowindow')),
					),
					array (
						'type' => 'textarea',
						'heading' => esc_html__('Location', 'dfd-native'),
						'edit_field_class' => 'vc_column vc_col-sm-12',
						'param_name' => 'marker_location',
						'admin_label' => true,
						'description' => esc_html__('Please, enter the location you need. For example, New York 15 Ford StBrooklyn or latitude and longitude geographic coordinates', 'dfd-native')
					),
					array (
						'type' => 'textarea',
						'heading' => esc_html__('Title', 'dfd-native'),
						'edit_field_class' => 'vc_column vc_col-sm-12',
						'param_name' => 'title_marker_content',
						'admin_label' => true,
					),
					array (
						'type' => 'textarea',
						'heading' => esc_html__('Content', 'dfd-native'),
						'edit_field_class' => 'vc_column vc_col-sm-12',
						'param_name' => 'marker_content',
						'admin_label' => true,
						'description' => esc_html__('Tooltip content (allows HTML tags).', 'dfd-native')
					),
					array (
						'type' => 'param_group',
						'heading' => esc_html__('Additional content', 'dfd-native'),
						'param_name' => 'location_list2',
						'group' => esc_html__('Locations', 'dfd-native'),
						'params' => array (
							array (
								'type' => 'textarea',
								'heading' => esc_html__('Title', 'dfd-native'),
								'edit_field_class' => 'vc_column vc_col-sm-12',
								'param_name' => 'title_marker_content2',
							),
							array (
								'type' => 'textarea',
								'heading' => esc_html__('Content', 'dfd-native'),
								'edit_field_class' => 'vc_column vc_col-sm-12',
								'param_name' => 'marker_content2',
								'description' => esc_html__('Content tooltip (Allow HTML tags).', 'dfd-native')
							),
						),
					),
					array (
						'type' => 'attach_image',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd-native').'</span></span>'.esc_html__('Custom Marker Image:', 'dfd-native'),
						'param_name' => 'marker_image',
						'dependency' => array ('element' => 'show_tooltip', 'value_not_equal_to' => array ('infowindow')),
						'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
					),
					array (
						'type' => 'attach_image',
						'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the custom image from media library','dfd-native').'</span></span>'.esc_html__('Hover Background image:', 'dfd-native'),
						'param_name' => 'hover_marker_image',
						'dependency' => array ('element' => 'show_tooltip', 'value_not_equal_to' => array ('infowindow')),
						'edit_field_class' => 'vc_column vc_col-sm-6',
					),
				),
				"value"=> "%5B%7B%22show_tooltip%22%3A%22infowindow%22%2C%22tooltip_show_setting%22%3A%22hide%22%2C%22marker_location%22%3A%22New%20York%2015%20Ford%20StBrooklyn%22%2C%22title_marker_content%22%3A%22Title%22%2C%22marker_content%22%3A%22Put%20your%20content%20here%22%2C%22location_list2%22%3A%22%255B%257B%257D%255D%22%7D%5D"
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array (
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
				'param_name' => 'module_animation',
				'value' => Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type' => 'textfield',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name' => 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/google-map',
				'video_link'		=> 'https://www.youtube.com/watch?v=NikGhp3iUJk&feature=youtu.be',
			),
			array (
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to show all locations','dfd-native').'</span></span>'.esc_html__('Auto pan', 'dfd-native'),
				'param_name' => 'auto_pan',
				'value' => 'show',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-4',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to navigate the map on touch devices','dfd-native').'</span></span>'.esc_html__('Touch on mobile device', 'dfd-native'),
				'param_name' => 'touch_on_mobile',
				'value' => 'show',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable zoom for the map','dfd-native').'</span></span>'.esc_html__('Zoom In/Out', 'dfd-native'),
				'param_name' => 'enable_zoom',
				'value' => 'true',
				'options' => array (
					'true' => array (
						'on' => 'Yes',
						'off' => 'No',
					),
				),
				'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'dropdown',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the zoom for the map from the dropdown','dfd-native').'</span></span>'. esc_html__('Map Zoom', 'dfd-native'),
				'param_name' => 'zoom',
				'value' => array (
					esc_attr__('14 - Default', 'dfd-native') => 14,
					1,
					2,
					3,
					4,
					5,
					6,
					7,
					8,
					9,
					10,
					11,
					12,
					13,
					15,
					16,
					17,
					18,
					19,
					20
				),
				'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
				'dependency' => array ('element' => 'auto_pan', 'value_not_equal_to' => array ('show')),
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the map\'s height','dfd-native').'</span></span>'.esc_html__('Map height', 'dfd-native'),
				'param_name' => 'size',
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'dfd_heading_param',
				'text' => esc_html__('Offset for the center of the map', 'dfd-native'),
				'param_name' => 'main_headingsds',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the offset','dfd-native').'</span></span>'.esc_html__('From West to East', 'dfd-native'),
				'param_name' => 'x_pan',
				'value' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'number',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the offset','dfd-native').'</span></span>'.esc_html__('From North to South', 'dfd-native'),
				'param_name' => 'y_pan',
				'value' => 0,
				'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap no-border-bottom',
				'group' => esc_html__('Settings', 'dfd-native'),
			),
			array (
				'type' => 'dfd_font_container',
				'heading' => '',
				'param_name' => 'title_font_options',
				'settings' => array (
					'fields' => array (
						'font_size',
						'letter_spacing',
						'line_height',
						'font_style'
					),
				),
				'group' => esc_attr__('Tooltip typography', 'dfd-native'),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'tooltip_text_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the tooltip (info window) text color. The default value is #fff','dfd-native').'</span></span>'.esc_html__('Tooltip text color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_attr__('Tooltip typography', 'dfd-native'),
			),
			array (
				'type' => 'colorpicker',
				'param_name' => 'tooltip_bg_color',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the background color for the tooltip (info window). The default value is inherited from Theme Options > Styling options > Main site color','dfd-native').'</span></span>'.esc_html__('Tooltip background color', 'dfd-native'),
				'edit_field_class' => 'vc_column vc_col-sm-6',
				'group' => esc_attr__('Tooltip typography', 'dfd-native'),
			),
			array (
				'type' => 'dfd_single_checkbox',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name' => 'title_google_fonts',
				'options' => array (
					'show' => array (
						'on' => esc_html__('Yes', 'dfd-native'),
						'off' => esc_html__('No', 'dfd-native'),
					),
				),
				'group' => esc_attr__('Tooltip typography', 'dfd-native'),
			),
			array (
				'type' => 'google_fonts',
				'param_name' => 'title_custom_fonts',
				'settings' => array (
					'fields' => array (
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description' => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency' => array ('element' => 'title_google_fonts', 'value' => 'show'),
				'group' => esc_attr__('Tooltip typography', 'dfd-native'),
			),
		)
	)
);
