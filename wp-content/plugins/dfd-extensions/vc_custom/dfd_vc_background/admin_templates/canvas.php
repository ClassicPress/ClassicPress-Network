<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the canvas animation style','dfd-native').'</span></span>'.esc_html__('Background Style', 'dfd-native'),
	'param_name' => 'dfd_canvas_style',
	'value' => array(
		esc_attr__('Style 1','dfd-native') => 'style_1',
		esc_attr__('Style 2','dfd-native') => 'style_2',
		esc_attr__('Style 3','dfd-native') => 'style_3',
	),
	'description' => '',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' =>  '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the size for the animation it can be applied to the row or to the window width','dfd-native').'</span></span>'.__('Animation size', 'dfd-native'),
	'param_name' => 'dfd_canvas_size',
	'value' => 'parent',
	'options' => array(
		__('Row size','dfd-native') => 'parent',
		__('Window size','dfd-native') => 'window',
	),
	'description' => '',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the background color for the row','dfd-native').'</span></span>'.__('Background Color', 'dfd-native'),						
	'param_name' => 'dfd_bg_color_value',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the color for the canvas animation lines','dfd-native').'</span></span>'.__('Animated lines color', 'dfd-native'),						
	'param_name' => 'dfd_canvas_color',
	'dependency' => array('element' => 'dfd_canvas_style','value' => array('style_2', 'style_4')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'attach_image',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image from the media library to be set as the background image for the row','dfd-native').'</span></span>'.__('Background Image', 'dfd-native'),
	'param_name' => 'dfd_bg_image_canvas',
	'value' => '',
	'description' => esc_html__('Upload or select background image from media library.', 'dfd-native'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set as background for the row','dfd-native').'</span></span>'.__('Background Image Repeat', 'dfd-native'),
	'param_name' => 'dfd_bg_image_repeat_canvas',
	'value' => 'repeat',
	'options' => array(
			esc_html__('Repeat', 'dfd-native') => 'repeat',
			esc_html__('Repeat X', 'dfd-native') => 'repeat-x',
			esc_html__('Repeat Y', 'dfd-native') => 'repeat-y',
			esc_html__('No Repeat', 'dfd-native') => 'no-repeat',
		),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image size','dfd-native').'</span></span>'.__('Background Image Size', 'dfd-native'),
	'param_name' => 'dfd_bg_image_size_canvas',
	'value' => 'cover',
	'options' => array(
			esc_html__('Cover', 'dfd-native') => 'cover',
			esc_html__('Contain', 'dfd-native') => 'contain',
			esc_html__('Initial', 'dfd-native') => 'initial',
		),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_heading_param',
	'text' => esc_html__('Large Screen Background settings', 'dfd-native'),
	'param_name' => 'bg_canvas_retina_main',
	'class' => '',
	'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
	'dependency' => Array('element' => 'dfd_bg_image_canvas','not_empty' => true),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background image size on devices witrh large screen resolution (over 1920px).','dfd-native').'</span></span>'.__('Large Screen Background Image Size', 'dfd-native'),
	'param_name' => 'dfd_canvas_bg_image_size_retina',
	'value' =>'',
	'dependency' => Array('element' => 'dfd_bg_image_canvas','not_empty' => true),
	'edit_field_class' => 'vc_column vc_col-sm-12',
	'group' => esc_attr__('Background options', 'dfd-native')
);