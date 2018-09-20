<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type'        => 'param_group',
	'heading'     => esc_html__( 'Color values', 'dfd-native' ),
	'param_name'  => 'dfd_bg_colors',
	'params'      => array(
		array(
			'type'             => 'colorpicker',
			'heading'          => esc_html__( 'Color', 'dfd-native' ),
			'param_name'       => 'dfd_bg_single_color',
//			'admin_label'      => true,
		),
	),
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);
$row_params[] = array(
	'type'       => 'number',
	'heading'    => '<span class="dfd-vc-toolip"><i class="dfd-socicon-question-sign"></i><span class="dfd-vc-tooltip-text">'.esc_html__('Allows you to set the animation duration in ms','dfd-native').'</span></span>'.esc_html__( 'Animation duration', 'dfd-native' ),
	'param_name' => 'dfd_anim_bg_duration',
	'value'      => '3000',
	'min'        => '100',
	'max'        => '10000',
	'step'       => '100',
	'suffix'     => 'ms',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);