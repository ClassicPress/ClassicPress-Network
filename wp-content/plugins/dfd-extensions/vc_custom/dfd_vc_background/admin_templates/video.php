<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dfd_radio_advanced',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to choose the video source','dfd-native').'</span></span>'.__('Video source', 'dfd-native'),
	'param_name' => 'dfd_video_variant',
	'value' => 'self-hosted',
	'options' => array(
		esc_html__('Self hosted','dfd-native') => 'self-hosted',
		esc_html__('Youtube','dfd-native') => 'youtube',
		esc_html__('Vimeo','dfd-native') => 'vimeo',
	),
	'dependency' => Array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the link to your video in mp4 format','dfd-native').'</span></span>'.__('Video in MP4 Format', 'dfd-native'),
	'param_name' => 'dfd_video_url_mp4',
	'value' => '',
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the link to your video in WebM / Ogg format','dfd-native').'</span></span>'.__('Video in WebM / Ogg Format', 'dfd-native'),
	'param_name' => 'dfd_video_url_webm',
	'value' => '',
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
/*youtube*/
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the video ID. Look at the URL of that page, and at the end of it, you should see a combination of numbers and letters after an equal sign (=)','dfd-native').'</span></span>'.__('YouTube video ID', 'dfd-native'),
	'param_name' => 'dfd_youtube_video_id',
	'value' => '',
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('youtube')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'textfield',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Add the video ID. Copy the numeric code that appears at the end of its URL at the top of your browser window','dfd-native').'</span></span>'.__('Vimeo video ID', 'dfd-native'),
	'param_name' => 'dfd_vimeo_video_id',
	'value' => '',
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('vimeo')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'checkbox',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('These options allow you to loop and mute the video set as the background','dfd-native').'</span></span>'. esc_html__('Extra Options', 'dfd-native'),
	'param_name' => 'dfd_video_opts',
	'value' => array(
			__('Loop','dfd-native') => 'loop',
			__('Muted','dfd-native') => 'muted',
		),
	//'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'dependency' => Array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
/*youtube*/
$row_params[] = array(
	'type' => 'attach_image',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Placeholder image is displayed in case background video is restricted. (For example, on mobiles)','dfd-native').'</span></span>'.__('Placeholder Image', 'dfd-native'),
	'param_name' => 'dfd_video_poster',
	'value' => '',
	'dependency' => Array('element' => 'dfd_bg_style','value' => array($file)),
	//'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'dfd_single_checkbox',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('This option allows you to show or hide video control buttons','dfd-native').'</span></span>'.__('Display Controls', 'dfd-native'),
	'param_name' => 'dfd_enable_controls',
	'value' => 'yes',
	'options' => array(
		'yes' => array(
				'label' => '',
				'on' => 'Yes',
				'off' => 'No',
			),
		),
	'description' => esc_html__('Display play / pause controls for the video on bottom right position.', 'dfd-native'),
	'dependency' => Array('element' => 'dfd_video_variant','value' => array('self-hosted')),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type' => 'colorpicker',
	'class' => '',
	'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Specify the color for the video control buttons','dfd-native').'</span></span>'.__('Color of Controls', 'dfd-native'),
	'param_name' => 'dfd_controls_color',
	//'admin_label' => true,
	//'description' => esc_html__('Display play / pause controls for the video on bottom right position.', 'dfd-native'),
	'dependency' => Array('element' => 'dfd_enable_controls','value' => array('display_control')),
	'group' => esc_attr__('Background options', 'dfd-native')
);