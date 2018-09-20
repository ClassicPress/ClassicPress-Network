<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $dfd_native;
$output = $main_style = $number = $title = $subtitle = $transition = $el_class = $font_options = $title_font_options = $use_google_fonts = $custom_fonts = '';
$subtitle_font_options = $animation_data = $module_animation = $title_options = $title_html = $subtitle_options = $subtitle_html = $link_css = $icon_type = '';
$select_icon = $ic_fontawesome = $ic_openiconic = $ic_typicons = $ic_entypo = $ic_linecons = $icon_size = $icon_color = $icon_image_id = $icon_text = $data_max = '';
$facts_number_html = $disable_animation_class = $animation = $title_wrap = $number_letter_spacing = $uniqid = $letter_spacing = $icon_html = $content_html = '';
$content_alignment2 = $subtitle_google_fonts = $subtitle_custom_fonts = '';

$atts = vc_map_get_attributes('dfd_facts', $atts);
extract($atts);

$uniqid = uniqid('dfd-facts-') .'-'.rand(1,9999);

if(!($module_animation == '')) {
	$el_class       .= ' cr-animate-gen ';
	$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'" ';
}

if(isset($main_style) && $main_style == 'style-6') {
	$el_class .= ' '.$content_alignment2;
}else{
	$el_class .= ' '.$content_alignment;
}

if(isset($transition) && strcmp($transition, 'counter') === 0) {
	$animation = 'count';
}elseif(strcmp($transition, 'disable-animation') === 0) {
	$disable_animation_class = 'disable-animation';
}

if(isset($number_letter_spacing) && strcmp($number_letter_spacing, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .odometer-digit {margin: 0 '.esc_attr($number_letter_spacing) / 2 .'px;}';
	$link_css .= '#'.esc_js($uniqid).' .odometer-digit:first-child {margin-left: 0;}';
	$link_css .= '#'.esc_js($uniqid).' .odometer-digit:last-child {margin-right: 0;}';
}

if(isset($number_responsive) && $number_responsive != '') {
	$link_css .= Dfd_Resposive_Text_Param::responsive_css($number_responsive, '#'.esc_js($uniqid).'.dfd-facts-counter .facts-number');
}

if(isset($show_icon) && strcmp($show_icon, 'enable_icon') === 0) {
	$icon_html = '<div class="module-icon">'.dfd_icon_render($atts).'</div>';
}else{
	$el_class .= ' disable-icon';
}

if(!empty($title)) {
	$title_options = _dfd_parse_text_shortcode_params( $title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
	$title_html = '<'.$title_options['tag'].' class="facts-title ' .$title_options['class'].'" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
}

if(!empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle', $subtitle_google_fonts, $subtitle_custom_fonts);
	$subtitle_html = '<'.$subtitle_options['tag'].' class="facts-subtitle '.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($subtitle).'</'.$subtitle_options['tag'].'>';
}

$title_wrap .= '<div class="title-wrap">';
	$title_wrap .= $title_html;
	$title_wrap .= $subtitle_html;
$title_wrap .= '</div>';

$font_options = _dfd_parse_text_shortcode_params($font_options,'');

$data_max = 'data-max="'.esc_attr($number).'"';
$facts_number_html .= '<div class="facts-number dfd-content-title-big call-on-waypoint '.$disable_animation_class.'" data-animation="'.esc_attr($animation).'" '.$data_max.' '.$font_options['style'].'>';
if (isset($transition) && strcmp($transition, 'disable-animation') === 0) {
	$facts_number_html .= esc_attr($number);
}else{
	$facts_number_html .= '0';
}
$facts_number_html .= '</div>';

$content_html .= '<div class="number-wrap">';
	$content_html .= '<div class="stat-count">'.$facts_number_html.'</div>';
$content_html .= '</div>';

$output .= '<div id="'.$uniqid.'" class="dfd-facts-counter '.$main_style.' '.$el_class.'" '.$animation_data.'>';
	if(isset($main_style) && strcmp($main_style, 'style-3') === 0) {
		$output .= $content_html;
		$output .= '<div class="title-wrap">';
			$output .= '<div class="title-container">';
				$output .= $title_html;
				$output .= $subtitle_html;
			$output .= '</div>';
			$output .= $icon_html;
		$output .= '</div>';
	}elseif(strcmp($main_style, 'style-4') === 0) {
		$output .= $content_html;
		$output .= '<div class="title-wrap">';
			$output .= $icon_html;
			$output .= '<div class="title-container">';
				$output .= $title_html;
				$output .= $subtitle_html;
			$output .= '</div>';
		$output .= '</div>';
	}elseif(strcmp($main_style, 'style-5') === 0) {
		$output .= '<div class="head-container">';
			$output .= $icon_html;
			$output .= $content_html;
		$output .= '</div>';
		$output .= '<div class="title-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
		$output .= '</div>';
	}else{
		$output .= $icon_html;
		$output .= $content_html;
		$output .= '<div class="title-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
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