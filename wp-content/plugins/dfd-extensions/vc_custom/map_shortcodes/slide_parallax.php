<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

class WPBakeryShortCode_Dfd_Slide_Parallax extends WPBakeryShortCode {}

vc_map( array(
	'name' => esc_html__('Slide parallax', 'dfd-native'),
	'base' => 'dfd_slide_parallax',
	'class' => 'dfd_slide_parallax dfd_shortcode',
	'controls' => 'full',
	'show_settings_on_create' => true,
	'icon' => 'dfd_slide_parallax dfd_shortcode',
	'description' => esc_html__('Display two images with draggable divider', 'dfd-native'),
	'category' => esc_html__('Native', 'dfd-native'),
	'params'      => array(
		array(
			'type'             => 'dfd_heading_param',
			'text'             => esc_html__( 'General settings', 'dfd-native' ),
			'param_name'       => 'dir_heading',
			'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
		),
		array(
			'type'       => 'radio_image_select',
			'heading'    => esc_html__( 'Direction', 'dfd-native' ),
			'param_name' => 'direction',
			'admin_label' => true,
			'simple_mode'		=> false,
			'options'      => array(
				'horizontal' => array(
						'tooltip' => esc_attr__('Horizontal','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/slide_parallax/horizontal.png'
					),
				'vertical' => array(
						'tooltip' => esc_attr__('Vertical','dfd-native'),
						'src' => DFD_EXTENSIONS_PLUGIN_URL .'vc_custom/admin/img/slide_parallax/vertical.png'
					),
			),
			"value" => "horizontal"
		),
		array(
				'type'             => 'dfd_heading_param',
				'text'             => esc_html__( 'Extra features', 'dfd-native' ),
				'param_name'       => 'extra_features_elements_heading',
				'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
		array(
			'type'        => 'dropdown',
			'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
			'param_name'  => 'module_animation',
			'value'       => Dfd_Theme_Helpers::dfd_module_animation_styles(),
		),
		array(
			'type'        => 'textfield',
			'heading'	  => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the unique class name for the element which can be used for custom CSS codes','dfd-native').'</span></span>'.esc_html__('Custom CSS Class', 'dfd-native'),
			'param_name'  => 'el_class',
		),
		array(
			'type' => 'dfd_video_link_param',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
			'param_name' => 'tutorials',
			'doc_link' => '//nativewptheme.net/support/visual-composer/slide-parallax',
			'video_link' => 'https://www.youtube.com/watch?v=eKUlcYUf4Ro&feature=youtu.be',
		),
		array(
			'type'             => 'dfd_heading_param',
			'text'             => esc_html__( 'Images', 'dfd-native' ),
			'param_name'       => 'images_heading',
			'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			'group'			   => esc_html('Images','dfd-native')
		),
		array(
			'type' => 'attach_image',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image which will be set to the right/top side','dfd-native').'</span></span>'.esc_html__('First image','dfd-native'),
			'param_name' => 'image_first',
			'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
			'group'			   => esc_html('Images','dfd-native')
		),
		array(
			'type' => 'attach_image',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image which will be set to the left/bottom side','dfd-native').'</span></span>'.esc_html__('Second image','dfd-native'),
			'param_name' => 'image_second',
			'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom',
			'group'			   => esc_html('Images','dfd-native')
		),
		array(
			'type'             => 'dfd_heading_param',
			'text'             => esc_html__( 'Image size', 'dfd-native' ),
			'param_name'       => 'resolutions_heading',
			'edit_field_class' => 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			'group'			   => esc_html('Images','dfd-native')
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the width for the images','dfd-native').'</span></span>'.esc_html__('Image width', 'dfd-native'),
			'param_name' => 'image_width',
			'value' => 1180,
			'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap',
			'group'			   => esc_html('Images','dfd-native')
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Select the height for the images','dfd-native').'</span></span>'.esc_html__('Image height', 'dfd-native'),
			'param_name' => 'image_height',
			'value' => 600,
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc dfd-number-wrap',
			'group'			   => esc_html('Images','dfd-native')
		),
		array(
			'type'             => 'dfd_heading_param',
			'text'             => esc_html__( 'Divider', 'dfd-native' ),
			'param_name'       => 'marker_heading',
			'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			'group'			   => esc_html('Divider','dfd-native')
		),
		array(
			'type' => 'attach_image',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image which will be set as the divider','dfd-native').'</span></span>'. esc_html__('Divider image','dfd-native'),
			'param_name' => 'marker',
			//'edit_field_class' => 'vc_column vc_col-sm-6',
			'group'		=> esc_html('Divider','dfd-native')
		),
		array(
			'type' => 'number',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the width for the delimiter','dfd-native').'</span></span>'.esc_html__('Delimiter width', 'dfd-native'),
			'param_name' => 'delim_width',
			'value' => 1,
			'edit_field_class' => 'vc_column vc_col-sm-6 no-border-bottom crum_vc dfd-number-wrap',
			'group'			   => esc_html('Divider','dfd-native')
		),
		array(
			'type' => 'colorpicker',
			'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the delimiter color','dfd-native').'</span></span>'.esc_html__('Delimiter Color', 'dfd-native'),
			'param_name' => 'delim_bg',
			'value' => '#282828',
			'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
			'group'		=> esc_html('Divider','dfd-native')
		),
	)
));