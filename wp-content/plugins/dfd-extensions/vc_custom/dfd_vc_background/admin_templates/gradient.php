<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$file = basename(__FILE__, '.php');

$row_params[] = array(
	'type' => 'dfd_gradient',
	'class' => '',
	'heading' => esc_html__('Gradient settings', 'dfd-native'),						
	'param_name' => 'dfd_bg_grad',
	'dependency' => array('element' => 'dfd_bg_style','value' => array($file)),
	'group' => esc_attr__('Background options', 'dfd-native')
);