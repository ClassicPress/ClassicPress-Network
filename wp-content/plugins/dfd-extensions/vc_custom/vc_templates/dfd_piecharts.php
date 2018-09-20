<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;
$module_animation = $el_class = $main_style = $percent = $size = $animation_off = /*$number = */$unit = $title = $subtitle = $echo_number = $clock_wise = '';
$content_options = $font_options = $content_html = $title_options = $title_font_options = $subtitle_font_options = $title_html = $subtitle_options = '';
$subtitle_html = $uniqid = $output = $icon_html = $data_attr = $link_css = $select_icon = $ic_dfd_icons = $ic_fontawesome = $ic_openiconic = $ic_typicons = '';
$ic_entypo = $ic_linecons = $use_google_fonts = $custom_fonts = $bg_border_color = $bg_width = $value = $fill_width = $fill_color_start = $fill_color_end = '';

$atts = vc_map_get_attributes('dfd_piecharts', $atts);
extract($atts);

$uniqid = uniqid('dfd-piecharts-') .'-'.rand(1,9999);

$el_class .= ' '.esc_attr($main_style);

if (!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$data_attr .= ' data-animate-type = "'.esc_attr($module_animation).'" ';
}

if(isset($percent) && !empty($percent)) {
	$echo_number = '0';
	if(isset($animation_off) && strcmp($animation_off, 'disable_animation') !== 0) {
		$el_class .= ' circle-off-animation';
		$echo_number = esc_attr($percent).'<span>'.esc_attr($unit).'</span>';
	}
}else{
	$percent = 0;
}
if(isset($clock_wise) && strcmp($clock_wise, 'counterclock') == 0) {
	$el_class .= ' counterclock-wise-animation';
}
$value = $percent / 100;

$content_options = _dfd_parse_text_shortcode_params($font_options, 'dfd-content-title-big');
$content_html = '<'.$content_options['tag'].' class="piecharts-number '.$content_options['class'].'" data-max="'.esc_attr($percent).'" data-units="'.esc_attr($unit).'" '.$content_options['style'].'>'.$echo_number.'</'.$content_options['tag'].'>';

if(isset($title) && !empty($title)) {
	$title_options = _dfd_parse_text_shortcode_params( $title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
	$title_html = '<'.$title_options['tag'].' class="pichart-title '.$title_options['class'].'" '.$title_options['style'].'>'.esc_html($title).'</'.$title_options['tag'].'>';
}

if(isset($subtitle) && !empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
	$subtitle_html = '<'.$subtitle_options['tag'].' class="pichart-subtitle '.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($subtitle).'</'.$subtitle_options['tag'].'>';
}

$icon_html = dfd_icon_render($atts);

if(isset($size) && !empty($size)) {
	$link_css .= '#'.esc_js($uniqid).' .inner-circle {width: '.esc_attr($size).'px; height: '.esc_attr($size).'px; line-height: '.esc_attr($size).'px;}';
}else{
	$size = 160;
}
if(isset($bg_border_color) && !empty($bg_border_color)) {
	$link_css .= '#'.esc_js($uniqid).' .inner-circle:before {border-color: '.esc_attr($bg_border_color).';}';
}
if(isset($bg_width) && !empty($bg_width)) {
	$link_css .= '#'.esc_js($uniqid).' .inner-circle:before {border-width: '.esc_attr($bg_width).'px;}';
}

if(isset($fill_width) && !empty($fill_width)) {
	$data_attr .= ' data-thickness="'.esc_attr($fill_width).'"';
}else{
	$data_attr .= ' data-thickness="7"';
}
if($fill_color_start == '') {
	global $dfd_native;
	if(isset($dfd_native['main_site_color']) && !empty($dfd_native['main_site_color'])) {
		$fill_color_start = $dfd_native['main_site_color'];
	} else {
		$fill_color_start = '#3498db';
	}
}

if(!empty($fill_color_end) && !empty($fill_color_start)){
	$data_attr .= ' data-fill="{&quot;gradient&quot;: [&quot;' . esc_attr($fill_color_start) . '&quot;,&quot;' . esc_attr($fill_color_end) . '&quot;]}" ';
} elseif(!empty($fill_color_end)){
	$data_attr .= ' data-fill="{&quot;color&quot;: &quot;' . esc_attr($fill_color_end) . '&quot;}" ';
} else {
	$data_attr .= ' data-fill="{&quot;color&quot;: &quot;' . esc_attr($fill_color_start) . '&quot;}" ';
}
$data_attr .= ' data-emptyfill = "transparent"';
$data_attr .= ' data-value="'.esc_attr($value).'"';
$data_attr .= ' data-size="'.esc_attr($size).'"';
$data_attr .= ' data-animation-start-value="0"';
$data_attr .= ' data-reverse="true"';

$output .= '<div id="'.esc_js($uniqid).'" class="dfd-piecharts call-on-waypoint '.esc_attr($el_class).'" '.$data_attr.'>';
	if(isset($main_style) && strcmp($main_style, 'style-1') == 0) {
		$output .= '<div class="inner-circle">';
			$output .= $content_html;
		$output .= '</div>';
		$output .= $title_html;
		$output .= $subtitle_html;
	}elseif(strcmp($main_style, 'style-2') == 0) {
		$output .= '<div class="inner-circle">';
			$output .= $icon_html;
			$output .= $content_html;
		$output .= '</div>';
		$output .= $title_html;
		$output .= $subtitle_html;
	}elseif(strcmp($main_style, 'style-3') == 0) {
		$output .= '<div class="inner-circle">';
			$output .= $content_html;
		$output .= '</div>';
		$output .= '<div class="wrap">';
			$output .= '<div class="decor-wrap">';
				$output .= $icon_html;
			$output .= '</div>';
			$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
			$output .= '</div>';
		$output .= '</div>';
	}elseif(strcmp($main_style, 'style-4') == 0) {
		$output .= '<div class="inner-circle">';
			$output .= $icon_html;
		$output .= '</div>';
		$output .= '<div class="wrap">';
			$output .= '<div class="decor-wrap">';
				$output .= $content_html;
			$output .= '</div>';
			$output .= '<div class="title-wrap">';
				$output .= $title_html;
				$output .= $subtitle_html;
			$output .= '</div>';
		$output .= '</div>';
	}

	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
	}
	
$output .= '</div>';

echo $output;