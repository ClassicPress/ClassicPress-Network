<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Spacer
*/
class WPBakeryShortCode_Dfd_Spacer extends WPBakeryShortCode {}

vc_map(
	array(
		'name'        => esc_html__( 'Spacer', 'dfd-native' ),
		'base'        => 'dfd_spacer',
		'class'		  => 'dfd_spacer dfd_shortcode',
		'icon'		  => 'dfd_spacer dfd_shortcode',
		'category'    => esc_html__( 'Native', 'dfd-native' ),
		'description' => esc_html__( 'Add the space between the elements', 'dfd-native' ),
		'params'      => array(
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Spacer units', 'dfd-native'),
				'param_name'		=> 'sizing',
				'edit_field_class'	=> 'dfd-heading-param-wrapper no-top-margin vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'dfd_radio_advanced',
				'heading'			=> esc_html__('Units', 'dfd-native'),
				'param_name'		=> 'units',
				'value'				=> 'px',
				'options'			=> array(
						esc_html__('Pixel', 'dfd-native')		=> 'px',
						esc_html__('Percent', 'dfd-native')	=> '%',
				),
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6'
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Spacer size', 'dfd-native'),
				'param_name'		=> 'screen_wide_spacer_size',
				'value'				=> 10,
				'admin_label'		=> true,
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6 crum_vc '
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Medium desktop', 'dfd-native'),
				'param_name'		=> 'sizing_normal',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Screen resolution', 'dfd-native'),
				'param_name'		=> 'screen_normal_resolution',
				'value'				=> 1024,
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6 crum_vc dfd-number-wrap'
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Spacer size', 'dfd-native'),
				'admin_label'		=> true,
				'param_name'		=> 'screen_normal_spacer_size',
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6 crum_vc '
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Tablets', 'dfd-native'),
				'param_name'		=> 'sizing_tablet',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Screen resolution', 'dfd-native'),
				'param_name'		=> 'screen_tablet_resolution',
				'value'				=> 800,
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6 crum_vc dfd-number-wrap'
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Spacer size', 'dfd-native'),
				'admin_label'		=> true,
				'param_name'		=> 'screen_tablet_spacer_size',
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6 crum_vc '
			),
			array(
				'type'				=> 'dfd_heading_param',
				'text'				=> esc_html__('Mobile phones', 'dfd-native'),
				'param_name'		=> 'sizing_mobile',
				'edit_field_class'	=> 'dfd-heading-param-wrapper vc_column vc_col-sm-12',
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Screen resolution', 'dfd-native'),
				'param_name'		=> 'screen_mobile_resolution',
				'value'				=> 480,
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6 crum_vc dfd-number-wrap'
			),
			array(
				'type'				=> 'number',
				'heading'			=> esc_html__('Spacer size', 'dfd-native'),
				'admin_label'		=> true,
				'param_name'		=> 'screen_mobile_spacer_size',
				'edit_field_class'	=> 'no-border-bottom vc_column vc_col-sm-6 crum_vc '
			),
			array(
				'type' => 'dfd_video_link_param',
				'heading' => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">' . esc_html__('Video tutorial and theme documentation article', 'dfd-native') . '</span></span>' . esc_html__('Tutorials', 'dfd-native'),
				'param_name' => 'tutorials',
				'doc_link' => '//nativewptheme.net/support/visual-composer/spacer',
				//'video_link' => 'https://www.youtube.com/watch?v=8xlitDkL1j0&feature=youtu.be',
			),
		)
	)
);