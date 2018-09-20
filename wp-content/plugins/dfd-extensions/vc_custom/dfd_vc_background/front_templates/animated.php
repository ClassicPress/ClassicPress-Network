<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*$css_rules =*/ $anim_value = $keframe_css = '';

$uniqid = uniqid('DfdAnimatedBG');

$keyframe_pref = array('@-webkit-keyframes','@-moz-keyframes','@-ms-keyframes','@-o-keyframes','@keyframes');

if(isset($dfd_bg_colors) && !empty($dfd_bg_colors) && function_exists('vc_param_group_parse_atts')) {
	$dfd_bg_colors = (array) vc_param_group_parse_atts( $dfd_bg_colors );
		
	$count = count($dfd_bg_colors);
	
	if($count) {
		$count = 100/$count;

		$i = 0;
		foreach($dfd_bg_colors as $item) {
			if(isset($item['dfd_bg_single_color']) && $item['dfd_bg_single_color'] != '') {
				if($i == 0)
					$css_rules .= 'background: '.esc_js($item['dfd_bg_single_color']).';';
				$anim_value .= esc_js($count * $i).'% { background: '.esc_js($item['dfd_bg_single_color']).'}';
			}

			$i++;
		}
		foreach($keyframe_pref as $v) {
			$keframe_css .= esc_js($v) .' '.esc_js($uniqid).' {'.$anim_value.'}';
		}
	}
	
	$dfd_anim_bg_duration = (isset($dfd_anim_bg_duration) && $dfd_anim_bg_duration != '') ? $dfd_anim_bg_duration : 3000;
	
	$css_rules .= '-webkit-animation: '. esc_js($uniqid) .' '. esc_js($dfd_anim_bg_duration)/1000 .'s linear infinite;';
	$css_rules .= '-moz-animation: '. esc_js($uniqid) .' '. esc_js($dfd_anim_bg_duration)/1000 .'s linear infinite;';
	$css_rules .= '-ms-animation: '. esc_js($uniqid) .' '. esc_js($dfd_anim_bg_duration)/1000 .'s linear infinite;';
	$css_rules .= '-o-animation: '. esc_js($uniqid) .' '. esc_js($dfd_anim_bg_duration)/1000 .'s linear infinite;';
	$css_rules .= 'animation: '. esc_js($uniqid) .' '. esc_js($dfd_anim_bg_duration)/1000 .'s linear infinite;';
	
	$css_rules = '#'.esc_js($uniqid).'{'.$css_rules.'}';
	
	$css_rules .= $keframe_css;
	
	$output .=	'<div class="dfd-row-bg-wrap dfd-row-bg-anim-colors" id="'.esc_attr($uniqid).'"></div>';
}