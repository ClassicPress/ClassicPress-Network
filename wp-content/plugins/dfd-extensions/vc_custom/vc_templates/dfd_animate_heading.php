<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $uniqid = $line_appearance = $el_class = $title = $subtitle = $title_background = $title_font_options = $use_google_fonts = $custom_fonts = '';
$subtitle_font_options = $subtitle_google_fonts = $subtitle_custom_fonts = $heading_alignment = $title_html = $subtitle_html = $link_css = $subtitle_background = '';
$top_bottom_offset = $left_right_offset = $title_border_radius = $subtitle_border_radius = $full_width = $title_responsive = '';

$atts = vc_map_get_attributes('dfd_animate_heading', $atts);
extract($atts);

$uniqid = uniqid('dfd-animate-heading-').'-'.rand(1,9999);

if(isset($heading_alignment) && !empty($heading_alignment)) {
	$el_class .= ' '.$heading_alignment;
}
if(isset($line_appearance) && !empty($line_appearance)) {
	$el_class .= ' '.$line_appearance;
}
if(isset($full_width) && strcmp($full_width, 'full') == 0) {
	$el_class .= ' full-width-bg';
}

if(isset($title_background) && !empty($title_background)) {
	$link_css .= '#'.esc_js($uniqid).' .title-container.animate-container {background: '.esc_js($title_background).';}';
}
if(isset($subtitle_background) && !empty($subtitle_background)) {
	$link_css .= '#'.esc_js($uniqid).' .subtitle-container.animate-container {background: '.esc_js($subtitle_background).';}';
}
if(isset($top_bottom_offset) && strcmp($top_bottom_offset, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .animate-element {padding-top: '.esc_js($top_bottom_offset).'px; padding-bottom: '.esc_js($top_bottom_offset).'px;}';
}
if(isset($left_right_offset) && strcmp($left_right_offset, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .animate-element {padding-left: '.esc_js($left_right_offset).'px; padding-right: '.esc_js($left_right_offset).'px;}';
}
if(isset($title_border_radius) && strcmp($title_border_radius, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .title-container.animate-container {border-radius: '.esc_js($title_border_radius).'px;}';
}
if(isset($subtitle_border_radius) && strcmp($subtitle_border_radius, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .subtitle-container.animate-container {border-radius: '.esc_js($subtitle_border_radius).'px;}';
}
if(isset($title_responsive) && $title_responsive != '') {
	$link_css .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#'.esc_js($uniqid).' .title-container');
}

if(isset($title) && !empty($title)) {
	$title_font_options = _dfd_parse_text_shortcode_params( $title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts );
	$title_html = '<'.$title_font_options['tag'].' class="'.$title_font_options['class'].'" '.$title_font_options['style'].'><span class="title-container animate-container"><span class="title-text animate-element">'.  strip_tags($title,'<br><br/>').'</span></span></'.$title_font_options['tag'].'>';
}
if(isset($subtitle) && !empty($subtitle)) {
	$subtitle_font_options = _dfd_parse_text_shortcode_params( $subtitle_font_options, 'dfd-content-subtitle', $subtitle_google_fonts, $subtitle_custom_fonts );
	$subtitle_html = '<'.$subtitle_font_options['tag'].' class="'.$subtitle_font_options['class'].'" '.$subtitle_font_options['style'].'><span class="subtitle-container animate-container"><span class="subtitle-text animate-element">'.esc_html($subtitle).'</span></span></'.$subtitle_font_options['tag'].'>';
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-animate-heading-wrap call-on-waypoint '.esc_attr($el_class).'">';
	$output .= '<div class="content-wrap">';
		if($link_css != '') {
			$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
		}
		$output .= '<div class="title-wrap wrap-container">';
			$output .= $title_html;
		$output .= '</div>';
		$output .= '<div class="subtitle-wrap wrap-container">';
			$output .= $subtitle_html;
		$output .= '</div>';
	$output .= '</div>';
$output .= '</div>';

echo $output;