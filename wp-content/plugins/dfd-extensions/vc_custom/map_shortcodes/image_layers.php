<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: DFD Image Layers for Visual Composer
*/

class WPBakeryShortCode_Dfd_Image_Layers extends WPBakeryShortCode {}

vc_map(
	array(
		'name'					=> esc_html__('Image Layers', 'dfd-native'),
		'base'					=> 'dfd_image_layers',
		'class'					=> 'dfd_image_layers dfd_shortcode',
		'icon'					=> 'dfd_image_layers dfd_shortcode',
		'category'				=> esc_html__('Native', 'dfd-native'),
		'params'				=> array(
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to align the module horizontally','dfd-native').'</span></span>'.esc_html__('Alignment', 'dfd-native'),
				'param_name'		=> 'alignment',
				'value'				=> 'layers-center',
				'options'			=> array(
					esc_html__('Left', 'dfd-native')	=> 'layers-left',
					esc_html__('Center', 'dfd-native')	=> 'layers-center',
					esc_html__('Right', 'dfd-native')	=> 'layers-right',
				),
				'edit_field_class'	=> 'vc_column vc_col-sm-6',
			),
			array(
				'type'				=> 'number',
				'heading'			=> '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Set the periodicity for image appearing in seconds','dfd-native').'</span></span>'.esc_html__('Interval', 'dfd-native'),
				'param_name'		=> 'periodicity',
				'value'				=> 0.3,
				'edit_field_class'	=> 'vc_column vc_col-sm-6 no-top-padding crum_vc dfd-number-second',
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
				'doc_link'			=> '//nativewptheme.net/support/visual-composer/image-layers',
				'video_link'		=> 'https://www.youtube.com/watch?v=cIDdfCqO2bE&feature=youtu.be',
			),
			array(
				'type'				=> 'param_group',
				'heading'			=> esc_html__('List of layers', 'dfd-native'),
				'param_name'		=> 'list_fields',
				'params'			=> array(
					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__('Upload Image:', 'dfd-native'),
						'param_name'	=> 'image_id',
					),
					array(
						'type'				=> 'number',
						'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the layer offset in %, for example -100% or 100%','dfd-native').'</span></span>'.esc_html__('Horizontal offset', 'dfd-native'),
						'param_name'		=> 'offcet_x',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-percent',
					),
					array(
						'type'				=> 'number',
						'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the layer offset in %, for example -100% or 100%','dfd-native').'</span></span>'.esc_html__('Vertical offset', 'dfd-native'),
						'param_name'		=> 'offcet_y',
						'edit_field_class'	=> 'vc_column vc_col-sm-6 crum_vc dfd-number-percent',
					),
					array(
						'type'				=> 'dropdown',
						'heading'			=> '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the appear effect for the element','dfd-native').'</span></span>'.esc_html__('Animation', 'dfd-native'),
						'param_name'		=> 'layer_animation',
						'value'				=> array(
							esc_html__('Fade In', 'dfd-native')			=> 'fadeIn',
							esc_html__('Flip Horizontally', 'dfd-native')	=> 'flipXIn',
							esc_html__('Flip Vertically', 'dfd-native')	=> 'flipYIn',
							esc_html__('Shrink', 'dfd-native')				=> 'shrinkIn',
							esc_html__('Expand', 'dfd-native')				=> 'expandIn',
							esc_html__('Grow', 'dfd-native')				=> 'grow',
							esc_html__('Slide Up', 'dfd-native')			=> 'slideUpBigIn',
							esc_html__('Slide Down', 'dfd-native')			=> 'slideDownBigIn',
							esc_html__('Slide Right', 'dfd-native')		=> 'slideLeftBigIn',
							esc_html__('Slide Left', 'dfd-native')			=> 'slideRightBigIn',
							esc_html__('Perspective Up', 'dfd-native')		=> 'perspectiveUpIn',
							esc_html__('Perspective Down', 'dfd-native')	=> 'perspectiveDownIn',
							esc_html__('Perspective Right', 'dfd-native')	=> 'perspectiveLeftIn',
							esc_html__('Perspective Left', 'dfd-native')	=> 'perspectiveRightIn',
						),
					),
				),
				'group'				=> esc_html__('Layers', 'dfd-native'),
			),
		),
	)
);