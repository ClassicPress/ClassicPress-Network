<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if($dfd_canvas_style == 'style_1') {
	
//	wp_enqueue_script('dfd-tweenlite');
//	wp_enqueue_script('dfd-easepack');
//	wp_enqueue_script('dfd-rAF');
	
	wp_enqueue_script('dfd-canvas-bg-first');
} elseif ($dfd_canvas_style == 'style_2') {
	wp_enqueue_script('dfd-particleground');
} elseif ($dfd_canvas_style == 'style_3') {
	
//	wp_enqueue_script('dfd-three');
//	wp_enqueue_script('dfd-projector');
//	wp_enqueue_script('dfd-canvas-renderer');
	
	wp_enqueue_script('dfd-canvas-bg-third');
} elseif ($dfd_canvas_style == 'style_4') {
	wp_enqueue_script('dfd-particleground-old');
}

$html = $canvas_rules = $data_atts = '';

$uniqid = uniqid('dfd-canvas-');
$data_atts .= ' data-canvas-id="'.esc_attr($uniqid).'"';

if(!isset($dfd_canvas_style) || empty($dfd_canvas_style)) $dfd_canvas_style = 'style_1';
$data_atts .= ' data-canvas-style="'.esc_attr($dfd_canvas_style).'"';

if(!isset($dfd_canvas_size) || empty($dfd_canvas_size)) $dfd_canvas_size = 'parent';
$data_atts .= ' data-canvas-size="'.esc_attr($dfd_canvas_size).'"';

if($dfd_canvas_style == 'style_2' || $dfd_canvas_style == 'style_4') {
	if(!isset($dfd_canvas_color) || empty($dfd_canvas_color)) $dfd_canvas_color = '#ffffff';
	$data_atts .= ' data-canvas-color="'.esc_attr($dfd_canvas_color).'"';
}

if(isset($dfd_bg_color_value) && !empty($dfd_bg_color_value))
	$canvas_rules .= 'background-color:'.esc_attr($dfd_bg_color_value).';';

if(isset($dfd_bg_image_size_canvas) && !empty($dfd_bg_image_size_canvas))
	$canvas_rules .= 'background-size:'.esc_attr($dfd_bg_image_size_canvas).';';

if(isset($dfd_bg_image_repeat_canvas) && !empty($dfd_bg_image_repeat_canvas))
	$canvas_rules .= 'background-repeat:'.esc_attr($dfd_bg_image_repeat_canvas).';';

if(isset($dfd_bg_image_canvas) && !empty($dfd_bg_image_canvas)) {
	$bg_img = wp_get_attachment_image_src($dfd_bg_image_canvas,'full');
	if(isset($bg_img[0]) && !empty($bg_img[0])) {
		$canvas_rules .= 'background-image: url('.esc_url($bg_img[0]).');';
	}
}

$output .= '<div class="dfd-row-bg-wrap dfd-row-bg-canvas" id="'.esc_attr($uniqid).'" '.$data_atts.'></div>';

if($canvas_rules != '' && isset($css_rules)) {
	$css_rules .= '#'.esc_js($uniqid).'{'. $canvas_rules .'}';
}

if(isset($dfd_canvas_bg_image_size_retina) && $dfd_canvas_bg_image_size_retina != '') {
	$css_rules .= '@media (min-width: 1921px) {#'.esc_js($uniqid).'{background-size: '.esc_attr($dfd_canvas_bg_image_size_retina).';}}';
}