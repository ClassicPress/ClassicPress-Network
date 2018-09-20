<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$uniqid = $module_animation = $animation_data = $progress_background_gradient = $animate_progress = $font_options = $number_font_options = $content_html = $output = '';
$back_line_background = $main_layout = $percent = $title = $text_position = $el_class = $link_css = $title_html = $back_line_border = $progress_anim_data = '';
$title_percents_left = $height_progress_line = $progress_background_color = $animate_lines = $slanting_lines_decoration = $title_percent_position = $percent_position = '';
$enable_icon = $select_icon = $ic_dfd_icons = $ic_fontawesome = $ic_openiconic = $ic_typicons = $ic_entypo = $ic_linecons = $icon_size = $icon_color = $icon_html = '';
$height_progress_line_style_1 = $height_progress_line_style_2 = $progress_style = $use_google_fonts = $custom_fonts = $use_number_google_fonts = $number_custom_fonts = '';

$atts = vc_map_get_attributes( 'dfd_progressbar', $atts );
extract( $atts );

$uniqid = uniqid('dfd-progress-') .'-'.rand(1,9999);

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
}
if (isset($animate_progress) && strcmp($animate_progress, 'anim_progress') !== 0) {
	$el_class .= ' no-animation';
	$progress_style = 'style="width: '.esc_attr(intval($percent)).'%;"';
}
if ('0' !== $percent) {
	$progress_anim_data = ' data-percentage-value="'.esc_attr(intval($percent)).'"';
	$percent_position = 100 - esc_attr(intval($percent));
}
if(isset($title_percents_left) && strcmp($title_percents_left, 'percents_left') === 0) {
	$el_class .= ' title-percents-left';
}
if(isset($slanting_lines_decoration) && strcmp($slanting_lines_decoration, 'lines_decoration') === 0) {
	$el_class .= ' lines-decoration';
}
if(isset($animate_lines) && strcmp($animate_lines, 'anim_lines') === 0) {
	$el_class .= ' move-lines';
}
if(isset($main_layout) && strcmp($main_layout, 'layout-3') === 0) {
	$el_class .= ' '.esc_attr($title_percent_position);
	if(isset($title_percent_position) && strcmp($title_percent_position, 'percents-center') === 0) {
		if(is_rtl() ) {
			$link_css .= '#'.esc_js($uniqid).' .title-wrap .progressbar-number {left: '.esc_attr($percent_position).'%;}';
		}else {
			$link_css .= '#'.esc_js($uniqid).' .title-wrap .progressbar-number {right: '.esc_attr($percent_position).'%;}';
		}
	}
}
if(isset($height_progress_line_style_1) && !empty($height_progress_line_style_1)) {
	$link_css .= '#'.esc_js($uniqid).'.layout-1 .progress-bar-line {height: '.esc_attr($height_progress_line_style_1).'px;}';
}
if(isset($height_progress_line_style_2) && !empty($height_progress_line_style_2)) {
	$link_css .= '#'.esc_js($uniqid).'.layout-2 .progress-bar-line {height: '.esc_attr($height_progress_line_style_2).'px;}';
}
if(isset($height_progress_line) && !empty($height_progress_line)) {
	$link_css .= '#'.esc_js($uniqid).'.layout-3 {height: '.esc_attr($height_progress_line).'px; line-height: '.esc_attr($height_progress_line).'px;}';
}
if(isset($back_line_background) && !empty($back_line_background)) {
	$link_css .= '#'.esc_js($uniqid).'.layout-1 .progress-bar-line .meter-decoration, #'.esc_js($uniqid).'.layout-3 .progress-bar-line .meter-decoration, #'.esc_js($uniqid).'.layout-2 .progress-bar-line .meter-decoration:before {background: '.esc_attr($back_line_background).';}';
}
if($back_line_border != '') {
	$back_line_border_css = Dfd_Border_Param::border_css($back_line_border);
	if(substr_count($back_line_border_css,'border-radius:') > 0) {
		$border_radius = substr($back_line_border_css,stripos($back_line_border_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '#'.esc_js($uniqid).'.layout-1 .progress-bar-line, #'.esc_js($uniqid).'.layout-3 .progress-bar-line {' . $border_radius . '}';
		}
	}
	$link_css .= '#'.esc_js($uniqid).'.layout-1 .progress-bar-line .meter-decoration, #'.esc_js($uniqid).'.layout-3 .progress-bar-line .meter-decoration {' . $back_line_border_css . '}';
}
if(isset($progress_background_color) && !empty($progress_background_color)) {
	$link_css .= '#'.esc_js($uniqid).' .progress-bar-line .meter {background: '.esc_attr($progress_background_color).';}';
}
if(isset($progress_background_gradient) && !empty($progress_background_gradient)) {
	$progress_background_gradient = Dfd_Gradient_Param::gradient_css($progress_background_gradient);
	$link_css .= '#'.esc_js($uniqid).' .progress-bar-line .meter {'.esc_attr($progress_background_gradient).'}';
}
if(isset($enable_icon) && strcmp($enable_icon, 'icon') == 0) {
	$el_class .= ' enable-icon';
	$atts['icon_type'] = 'selector';
	$icon_html = dfd_icon_render($atts);
}

$title_html .= '<div class="title-wrap">';
	$number_font_options = _dfd_parse_text_shortcode_params($number_font_options, '', $use_number_google_fonts, $number_custom_fonts);
	if (isset($title) && !empty($title)) {
		$font_options = _dfd_parse_text_shortcode_params($font_options, '', $use_google_fonts, $custom_fonts);
		$title_html .= '<'.$font_options['tag'].' class="progressbar-title" '.$font_options['style'].'>'.$icon_html.''.esc_html($title).'</'.$font_options['tag'].'>';
	}
	$title_html .= '<'.$number_font_options['tag'].' class="progressbar-number" '.$number_font_options['style'].'>'.$percent.'<span>%</span></'.$number_font_options['tag'].'>';
$title_html .= '</div>';

$content_html .= '<div class="progress-bar-line">';
	$content_html .= '<div class="meter-decoration"></div>';
	$content_html .= '<div class="meter" '.$progress_anim_data.' '.$progress_style.'></div>';
$content_html .= '</div>';

$output .= '<div id="'.esc_js($uniqid).'" class="dfd-progressbar '.esc_attr($main_layout).' text-'.esc_attr($text_position).' '.esc_attr( $el_class ).'" '.$animation_data.'>';
	if ( 'top' === $text_position ) {
		$output .= $title_html;
		$output .= $content_html;
	} else {
		$output .= $content_html;
		$output .= $title_html;
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