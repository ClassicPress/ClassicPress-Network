<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$main_style = $el_class = $output = $content_announcement = $select_icon = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';
$module_animation = $custom_fonts = $use_google_fonts = $font_options = $uniqid = $animation_data = $link_css = $align = $content_html = $background_fild = '';
$icon_html = $main_border = $main_border_css = $border_radius = $icon_size = $icon_color = $icon_bg = $full_width_background = '';

$atts = vc_map_get_attributes( 'dfd_announcement', $atts );
extract( $atts );

$uniqid = uniqid('dfd-announce-') .'-'.rand(1,9999);

if (!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type="'.esc_attr($module_animation).'" ';
}

$el_class .= ' '.$main_style.' '.$align;

if(isset($full_width_background) && strcmp($full_width_background, 'show') === 0) {
	$el_class .= ' full-width-bg';
}

$atts['icon_type'] = 'selector';
$icon_html = dfd_icon_render($atts);

$font_options = _dfd_parse_text_shortcode_params( $font_options, 'module-text', $use_google_fonts, $custom_fonts );
$content_html .= '<div class="' . $font_options['class'] . '" ' . $font_options['style'] . '>'.$icon_html.' '.esc_html($content_announcement).'</div>';

if(isset($background_fild) && !empty($background_fild)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-announce-module:before {background: '.esc_js($background_fild).';}';
}
if($main_border != '') {
	$main_border_css = Dfd_Border_Param::border_css($main_border);
	if(substr_count($main_border_css,'border-radius:') > 0) {
		$border_radius = substr($main_border_css,stripos($main_border_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '#'.esc_js($uniqid).' .dfd-announce-module {' . $border_radius . '}';
		}
	}
	$link_css .= '#'.esc_js($uniqid).' .dfd-announce-module:before {' . $main_border_css . '}';
}
if(isset($icon_size) && !empty($icon_size)) {
	$ic_thumb_size = $icon_size * 2;
	$link_css .= '#'.esc_js($uniqid).' .dfd-announce-module i {width: '.esc_js($ic_thumb_size).'px; height: '.esc_js($ic_thumb_size).'px; line-height: '.esc_js($ic_thumb_size).'px;}';
}
if(isset($icon_color) && !empty($icon_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-announce-module i {color: '.esc_js($icon_color).';}';
}
if(isset($icon_bg) && !empty($icon_bg)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-announce-module i {background: '.esc_js($icon_bg).';}';
}

$output .= '<div id="'.esc_js($uniqid).'" class="dfd-announce-module-wrap '.$el_class.'" '.$animation_data.'>';
	$output .= '<div class="dfd-announce-module">';
		$output .= $content_html;
	$output .= '</div>';
	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
	}
$output .= '</div>';

echo $output;