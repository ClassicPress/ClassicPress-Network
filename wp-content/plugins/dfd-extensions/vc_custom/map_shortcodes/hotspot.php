<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Hotspot
*/
class WPBakeryShortCode_Dfd_Hotspot extends WPBakeryShortCode {}

vc_map(
	array(
	   'name' => esc_html__('Hotspot','dfd-native'),
	   'base' => 'dfd_hotspot',
	   'class' => 'dfd_hotspot dfd_shortcode',
	   'icon' => 'dfd_hotspot dfd_shortcode',
	   'category' => esc_html__('Native','dfd-native'),
	   'description' => esc_html__('Display single images with external links and hover effects','dfd-native'),
	   'params' => array(
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'General settings', 'dfd-native' ),
				'param_name'       => 'general_options_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12 no-top-margin',
			),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image from the media library','dfd-native').'</span></span>'.esc_html__('Image','dfd-native'),
				'param_name'		=> 'image',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
			),
			array(
				'type'				=> 'dfd_hotspot_param',
				'heading'			=> '',
				'param_name'		=> 'hotspot_data',
				'edit_field_class'	=> 'vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the action the hotspot tooltip will be displayed on. If None action is selected the tooltips will be displayed by default','dfd-native').'</span></span>'.esc_html__('Tooltip action', 'dfd-native'),
				'param_name'		=> 'hotspot_action',
				'edit_field_class'	=> 'vc_column vc_col-sm-12',
				'value'				=> 'hover',
				'options'			=> array(
					esc_html__('None','dfd-native')		=> 'none',
					esc_html__('Hover','dfd-native')	=> 'hover',
					esc_html__('Click','dfd-native')	=> 'click',
				),
			),
			array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
			   'type'				=> 'dropdown',
			   'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
			   'param_name'			=> 'module_animation',
			   'value'				=> Dfd_Theme_Helpers::dfd_module_animation_styles(),
			),
			array(
				'type'				=> 'textfield',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
				'param_name'		=> 'el_class',
			),
			array(
				'type'				=> 'dfd_video_link_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Video tutorial and theme documentation article','dfd-native').'</span></span>'.esc_html__('Tutorials','dfd-native'),
				'param_name'		=> 'tutorials',
				'doc_link'			=> '',
				'video_link'		=> 'https://youtu.be/5IWEH1tuS6Q',
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Marker settings', 'dfd-native'),
				'param_name'		=> 'tooltip_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column no-top-margin vc_col-sm-12',
				'group'				=> esc_html__('Marker', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the marker style for the tooltips. You can leave default style or upload your own image','dfd-native').'</span></span>'.esc_html__('Marker style','dfd-native'),
				'param_name'		=> 'marker_style',
				'value'				=> 'default',
				'options'			=> array(
					esc_html__('Default', 'dfd-native')			=> 'default',
					esc_html__('Image', 'dfd-native')			=> 'custom_image',
				),
				'group'				=> esc_html__('Marker', 'dfd-native'),
			),
			array(
				'type'				=> 'attach_image',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the image from the media library','dfd-native').'</span></span>'.esc_html__('Image','dfd-native'),
				'param_name'		=> 'marker_image',
				'dependency'		=> array('element' => 'marker_style', 'value' => 'custom_image'),
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom',
				'group'				=> esc_html__('Marker', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'marker_background',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the background of hotspot markers','dfd-native').'</span></span>'.esc_html__('Marker Background', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'value'				=> '#3b55e6',
				'dependency'		=> array('element' => 'marker_style', 'value_not_equal_to' => 'custom_image'),
				'group'				=> esc_html__('Marker', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'marker_deco_background',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to change the background of the hotspot marker decoration','dfd-native').'</span></span>'.esc_html__('Marker decoration Background', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-border-bottom no-bottom-padding',
				'value'				=> '#ffffff',
				'dependency'		=> array('element' => 'marker_style', 'value_not_equal_to' => 'custom_image'),
				'group'				=> esc_html__('Marker', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Tooltip settings', 'dfd-native'),
				'param_name'		=> 'tooltip_heading',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column no-top-margin vc_col-sm-12',
				'group'				=> esc_html__('Tooltip', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the tooltip position from the hotspot marker','dfd-native').'</span></span>'.esc_html__('Tooltip position','dfd-native'),
				'param_name'		=> 'tooltip_position',
				'css_rules'			=> 'padding: 0 12px;',
				'value'				=> 'dfd-button-tooltip-top',
				'options'			=> array(
					esc_html__('Top', 'dfd-native')				=> 'dfd-button-tooltip-top',
					esc_html__('Bottom', 'dfd-native')			=> 'dfd-button-tooltip-bottom',
					esc_html__('Left', 'dfd-native')			=> 'dfd-button-tooltip-left',
					esc_html__('Right', 'dfd-native')			=> 'dfd-button-tooltip-right',
					esc_html__('Top Left', 'dfd-native')		=> 'dfd-button-tooltip-top-left',
					esc_html__('Top Right', 'dfd-native')		=> 'dfd-button-tooltip-top-right',
					esc_html__('Bottom Left', 'dfd-native')		=> 'dfd-button-tooltip-bottom-left',
					esc_html__('Bottom Right', 'dfd-native')	=> 'dfd-button-tooltip-bottom-right',
				),
				'group'				=> esc_html__('Tooltip', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the tooltip text alignment','dfd-native').'</span></span>'.esc_html__('Tooltip content alignment','dfd-native'),
				'param_name'		=> 'tooltip_content_align',
				'value'				=> 'text-left',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')			=> 'text-left',
					esc_html__('Right', 'dfd-native')			=> 'text-right',
					esc_html__('Center', 'dfd-native')			=> 'text-center',
				),
				'group'				=> esc_html__('Tooltip', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-5 no-border-bottom no-bottom-padding',
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to define the minimal width for hotspot item tooltip','dfd-native').'</span></span>'.esc_html__('Tooltip min width', 'dfd-native'),
				'param_name'		=> 'tooltip_width',
				'value'				=> 300,
				'edit_field_class'	=> 'vc_column vc_col-sm-3 dfd-number-wrap crum_vc no-border-bottom no-bottom-padding',
				'group'				=> esc_html__('Tooltip', 'dfd-native'),
			),
			array(
				'type'				=> 'colorpicker',
				'param_name'		=> 'tooltip_background',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the color for the tooltip\'s background. The default value is #fff','dfd-native').'</span></span>'.esc_html__('Tooltip Background', 'dfd-native'),
				'edit_field_class'	=> 'vc_column vc_col-sm-4 no-border-bottom no-bottom-padding',
				'group'				=> esc_html__('Tooltip', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_param_border',
				'heading'			=> '',
				'param_name'		=> 'border',
				'simple'			=> false,
				'enable_radius'		=> true,
				'edit_field_class'	=> 'dfd-vc-border-param-styles vc_column vc_col-sm-12',
				'value'				=> 'border_style:default',
				'group'				=> esc_html__('Tooltip', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_box_shadow_param',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the shadow for the hotspot tooltip','dfd-native').'</span></span>'.esc_html__('Box Shadow', 'dfd-native'),
				'param_name'		=> 'box_shadow',
				'edit_field_class'	=> 'vc_column vc_col-sm-12 no-border-bottom no-bottom-padding',
				'group'				=> esc_html__('Tooltip', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Title typography', 'dfd-native'),
				'param_name'		=> 'title_typography_heading',
				'group'				=> esc_html__('Typography', 'dfd-native'),
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'title_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'line_height',
						'letter_spacing',
						'font_style',
						'color',
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'title_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'title_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'title_google_fonts', 'value' => 'yes'),
				'edit_field_class'	=> 'no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Content typography', 'dfd-native'),
				'param_name'		=> 'content_typography_heading',
				'group'				=> esc_html__('Typography', 'dfd-native'),
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dfd_font_container',
				'param_name'		=> 'content_font_options',
				'settings'			=> array(
					'fields'			=> array(
						'font_size',
						'line_height',
						'letter_spacing',
						'font_style',
						'color',
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'dfd_single_checkbox',
				'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to use custom Google font','dfd-native').'</span></span>'.esc_html__('Custom font family', 'dfd-native'),
				'param_name'		=> 'content_google_fonts',
				'options'			=> array(
					'yes'				=> array(
						'yes'				=> esc_attr__('Yes', 'dfd-native'),
						'no'				=> esc_attr__('No', 'dfd-native'),
					),
				),
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
			array(
				'type'				=> 'google_fonts',
				'param_name'		=> 'content_custom_fonts',
				'settings'			=> array(
					'fields'			=> array(
						'font_family_description' => esc_html__('Select font family.', 'dfd-native'),
						'font_style_description'  => esc_html__('Select font style.', 'dfd-native'),
					),
				),
				'dependency'		=> array('element' => 'content_google_fonts', 'value' => 'yes'),
				'edit_field_class'	=> 'no-top-margin vc_column vc_col-sm-12',
				'group'				=> esc_html__('Typography', 'dfd-native'),
			),
		),
	)
);