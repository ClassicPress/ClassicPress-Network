<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the paxalax style you would like to have for the background image','dfd-native').'</span></span>'.__('Parallax Style','dfd-native'),
	'param_name' => 'dfd_parallax_style',
	'value' => array(
		esc_html__('Simple Background Image','dfd-native') => 'dfd_simple_image',
		esc_html__('Auto Moving Background','dfd-native') => 'dfd_animated_bg',
		esc_html__('Vertical Parallax On Scroll','dfd-native') => 'dfd_vertical_parallax',
		esc_html__('Horizontal Parallax On Scroll','dfd-native') => 'dfd_horizontal_parallax',
		esc_html__('Interactive Parallax On Mouse Move','dfd-native') => 'dfd_mousemove_parallax',
		esc_html__('Multilayer Vertical Parallax','dfd-native') => 'dfd_multi_parallax',
	), 
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'attach_image',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image from the media library to be set as background image for the row','dfd-native').'</span></span>'.__('Background Image', 'dfd-native'),
	'param_name' => 'dfd_bg_image_new',
	'value' => '',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'attach_images',
	'class' => '',
	'heading' => esc_html__('Layer Images', 'dfd-native'),
	'param_name' => 'dfd_layer_image',
	'value' => '',
	'description' => esc_html__('Upload or select background images from media gallery.', 'dfd-native'),
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_mousemove_parallax','dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => esc_html__('Parallax Direction', 'dfd-native'),
	'param_name' => 'dfd_multi_parallax_direction',
	'value' => 'vertical',
	'options' => array(
			esc_html__('Vertical', 'dfd-native') => 'vertical',
			esc_html__('Horizontal', 'dfd-native') => 'horizontal',

		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to enable or disable the repeating of the image you\'ve set as background for the row','dfd-native').'</span></span>'.__('Background Image Repeat', 'dfd-native'),
	'param_name' => 'dfd_bg_image_repeat',
	'value' => 'repeat',
	'options' => array(
			esc_html__('Repeat', 'dfd-native') => 'repeat',
			esc_html__('Repeat X', 'dfd-native') => 'repeat-x',
			esc_html__('Repeat Y', 'dfd-native') => 'repeat-y',
			esc_html__('No Repeat', 'dfd-native') => 'no-repeat',
		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image size','dfd-native').'</span></span>'.__('Background Image Size', 'dfd-native'),
	'param_name' => 'dfd_bg_image_size',
	'value' => 'cover',
	'options' => array(
			esc_html__('Cover', 'dfd-native') => 'cover',
			esc_html__('Contain', 'dfd-native') => 'contain',
			esc_html__('Initial', 'dfd-native') => 'initial',
		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'heading' =>'<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose background color for the row','dfd-native').'</span></span>'. esc_html__('Background color', 'dfd-native'),
	'param_name' => 'dfd_image_bg_color',
	'value' => '',
	'group' => esc_attr__('Background options', 'dfd-native'),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose scroll effect for the image. It can be fixed or scroll with the content','dfd-native').'</span></span>'.__('Scroll Effect', 'dfd-native'),
	'param_name' => 'dfd_bg_img_attach',
	'value' => 'scroll',
	'options' => array(
			esc_html__('Scroll', 'dfd-native') => 'scroll',
			esc_html__('Fixed', 'dfd-native') => 'fixed',								
		),
//	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_horizontal_parallax','dfd_vertical_parallax')),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'number',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Control the speed of parallax. Values from 1 to 100 are acceptable','dfd-native').'</span></span>'.__('Parallax Speed', 'dfd-native'),
	'param_name' => 'dfd_parallax_sense',
	'value' =>'30',
	'min'=>'1',
	'max'=>'100',
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg', 'dfd_vertical_parallax','dfd_horizontal_parallax','dfd_mousemove_parallax','dfd_multi_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'number',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to specify the paxalax start ofset value. Enter value between -500 to 500','dfd-native').'</span></span>'.__('Parallax Offset', 'dfd-native'),
	'param_name' => 'dfd_parallax_offset',
	'value' =>'',
	'min'=>'-500',
	'max'=>'500',
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_vertical_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background image position. You can use pixels, percents or words like left bottom. Please check ','dfd-native').'<a href="https://www.w3schools.com/cssref/pr_background-position.asp">'.esc_html__('this link','dfd-native').'</a>'.esc_html__('for more details on this property.','dfd-native').'</span></span>'.__('Background Image Position', 'dfd-native'),
	'param_name' => 'dfd_bg_image_position',
	'value' =>'',
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image', 'dfd_vertical_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Choose the animation direction for your moving parallax','dfd-native').'</span></span>'.__('Animation Direction', 'dfd-native'),
	'param_name' => 'dfd_animation_direction',
	'value' => 'right',
	'options' => array(
			esc_html__('None', 'dfd-native') => '',
			esc_html__('To Right', 'dfd-native') => 'right',
			esc_html__('To Left', 'dfd-native') => 'left',
			esc_html__('To Bottom', 'dfd-native') => 'bottom',
			esc_html__('To Top', 'dfd-native') => 'top',

		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_heading_param',
	'text' => esc_html__('Mobile Background settings', 'dfd-native'),
	'param_name' => 'bg_mobile_main',
	'class' => '',
	'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_single_checkbox',
	'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Enable or disable the parallax on mobile devices','dfd-native').'</span></span>'.__('Parallax on Mobile devices', 'dfd-native'),
	'param_name' => 'dfd_mobile_enable',
	'value' => 'yes',
	'options' => array(
		'yes' => array(
				'label' => '',
				'on' => 'Yes',
				'off' => 'No',
			),
		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_animated_bg','dfd_horizontal_parallax','dfd_vertical_parallax')),
//	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native'),
);
$row_params[] = array(
	'type' => 'attach_image',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Upload the image from the media library to be set as background image for the row on mobile devices','dfd-native').'</span></span>'.__('Mobile Background Image', 'dfd-native'),
	'param_name' => 'dfd_bg_image_new_responsive',
	'value' => '',
	'dependency' => array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg','dfd_vertical_parallax','dfd_horizontal_parallax',)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'number',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip tooltip-bottom"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to specify screen resolution to apply settings from','dfd-native').'</span></span>'.__('Mobile Background Screen Resolution', 'dfd-native'),
	'param_name' => 'dfd_bg_resolution',
	'value' =>'',
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_animated_bg')),
	'edit_field_class' => 'vc_column vc_col-sm-6 dfd-number-wrap crum_vc',
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background image position on mobile devices','dfd-native').'</span></span>'.__('Mobile Background Image Position', 'dfd-native'),
	'param_name' => 'dfd_bg_image_position_mobile',
	'value' =>'',
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image')),
	'edit_field_class' => 'vc_column vc_col-sm-6',
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to choose the image size on mobile devices','dfd-native').'</span></span>'.__('Mobile Background Image Size', 'dfd-native'),
	'param_name' => 'dfd_bg_image_size_mobile',
	'value' => '',
	'options' => array(
			esc_html__('Inherit from large', 'dfd-native') => '',
			esc_html__('Cover', 'dfd-native') => 'cover',
			esc_html__('Contain', 'dfd-native') => 'contain',
			esc_html__('Initial', 'dfd-native') => 'initial',
		),
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_heading_param',
	'text' => esc_html__('Large Screen Background settings', 'dfd-native'),
	'param_name' => 'bg_retina_main',
	'class' => '',
	'edit_field_class' => 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to set the background image size on devices witrh large screen resolution (over 1920px).','dfd-native').'</span></span>'.__('Large Screen Background Image Size', 'dfd-native'),
	'param_name' => 'dfd_bg_image_size_retina',
	'value' =>'',
	'dependency' => Array('element' => 'dfd_parallax_style','value' => array('dfd_simple_image','dfd_vertical_parallax','dfd_horizontal_parallax')),
	'edit_field_class' => 'vc_column vc_col-sm-12',
	'group' => esc_attr__('Background options', 'dfd-native')
);