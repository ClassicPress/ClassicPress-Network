<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*$css_rules =*/ $animation_css = '';
$uniqid = uniqid('dfd-grad-bg-');
if(isset($dfd_bg_grad) && !empty($dfd_bg_grad)) {
	$dfd_bg_grad = Dfd_Gradient_Param::gradient_css($dfd_bg_grad);
	$dfd_bg_grad = str_replace('\n','',esc_js($dfd_bg_grad));
	
	$css_rules = 'background: '.$dfd_bg_grad.';';
			
	$css_rules = '#'.esc_js($uniqid).'{'.$css_rules.'}';
			
	$output .=	'<div class="dfd-row-bg-wrap dfd-row-bg-gradient" id="'.esc_attr($uniqid).'"></div>';
}