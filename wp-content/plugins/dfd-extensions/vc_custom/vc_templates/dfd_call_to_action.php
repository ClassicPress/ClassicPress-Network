<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $uniqid = $link_css = $main_style = $el_class = $title_font_options = $use_google_fonts = $custom_fonts = $subtitle_font_options = $module_animation = '';
$animation_data = $main_content_html = $button_content_html = $show_icon = $icon_type = $select_icon = $ic_dfd_icons = $ic_fontawesome = $ic_openiconic = '';
$ic_typicons = $ic_entypo = $ic_linecons = $icon_image_id = $icon_text = $icon_size = $icon_color = $block_title = $button_text = $button_link = $show_bt_icon = '';
$select_bt_icon = $bt_dfd_icons = $bt_fontawesome = $bt_openiconic = $bt_typicons = $bt_entypo = $bt_linecons = $main_border_radius = $horizontal_padding = '';
$vertical_padding = $main_bg_color = $button_block_bg = $button_bg = $button_border_radius = $button_font_options = $block_subtitle = $bt_text_color = '';
$icon_html = $title_html = $subtitle_html = $bt_icon_html = $link = $bg_size_image = $width_icon = $bt_icon_color = $bt_icon_size = $bt_hover_text_color = '';
$button_hover_bg = $bt_icon_hover_color = $link_title = $link_rel = $link_target = $button_padding_left = $button_padding_right = '';

$atts = vc_map_get_attributes('dfd_call_to_action', $atts);
extract($atts);

$uniqid = uniqid('dfd-call-to-action-').'-'.rand(1,9999);

$el_class .= ' '.$main_style;

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'"';
}

if(isset($show_icon) && strcmp($show_icon, 'enable_icon') == 0) {
	$icon_html = dfd_icon_render($atts);
}
if(isset($show_bt_icon) && strcmp($show_bt_icon, 'enable_bt_icon') == 0) {
	$el_class .= ' with_icon';
}
if(isset($block_title) && !empty($block_title)) {
	$font_option = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
	$title_html = '<'.$font_option['tag'].' class="'.$font_option['class'].'" '.$font_option['style'].'>'.esc_html($block_title).'</'.$font_option['tag'].'>';
}
if(isset($block_subtitle) && !empty($block_subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
	$subtitle_html = '<'.$subtitle_options['tag'].' class="call-to-action-subtitle '.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($block_subtitle).'</'.$subtitle_options['tag'].'>';
}

if(isset($horizontal_padding) && !empty($horizontal_padding) || strcmp($horizontal_padding, 0) === 0) {
	$link_css .= '#'.esc_js($uniqid).'.style-1 .content-block {padding-left: '.esc_js($horizontal_padding).'px; padding-right: '.esc_js($horizontal_padding + 5).'px;}';
	$link_css .= '@media only screen and (max-width: 799px) {#'.esc_js($uniqid).'.style-1 .content-block {padding-right: '.esc_js($horizontal_padding).'px;}}';
	$link_css .= '#'.esc_js($uniqid).'.style-1 .button-block {padding-left: '.esc_js($horizontal_padding + 5).'px; padding-right: '.esc_js($horizontal_padding).'px;}';
	$link_css .= '@media only screen and (max-width: 799px) {#'.esc_js($uniqid).'.style-1 .button-block {padding-left: '.esc_js($horizontal_padding).'px;}}';
	$link_css .= '#'.esc_js($uniqid).'.style-2 .content-block {padding-left: '.esc_js($horizontal_padding + 5).'px; padding-right: '.esc_js($horizontal_padding).'px;}';
	$link_css .= '@media only screen and (max-width: 799px) {#'.esc_js($uniqid).'.style-2 .content-block {padding-left: '.esc_js($horizontal_padding).'px;}}';
	$link_css .= '#'.esc_js($uniqid).'.style-2 .button-block {padding-left: '.esc_js($horizontal_padding).'px; padding-right: '.esc_js($horizontal_padding + 5).'px;}';
	$link_css .= '@media only screen and (max-width: 799px) {#'.esc_js($uniqid).'.style-2 .button-block {padding-right: '.esc_js($horizontal_padding).'px;}}';
}
if(isset($vertical_padding) && !empty($vertical_padding) || strcmp($vertical_padding, 0) === 0) {
	$link_css .= '#'.esc_js($uniqid).' .content-block, #'.esc_js($uniqid).' .button-block {padding-top: '.esc_js($vertical_padding).'px; padding-bottom: '.esc_js($vertical_padding).'px;}';
}
if(isset($main_border_radius) && !empty($main_border_radius) || strcmp($main_border_radius, 0) === 0) {
	$link_css .= '#'.esc_js($uniqid).' {border-radius: '.esc_js($main_border_radius).'px;}';
}
if(isset($main_bg_color) && !empty($main_bg_color)) {
	$link_css .= '#'.esc_js($uniqid).' .main-tilted-decoration:before {background: '.esc_js($main_bg_color).';}';
}
if(isset($button_block_bg) && !empty($button_block_bg)) {
	$link_css .= '#'.esc_js($uniqid).' .button-tilted-decoration:before {background: '.esc_js($button_block_bg).';}';
}
if(isset($bt_text_color) && !empty($bt_text_color)) {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button {color: '.esc_js($bt_text_color).';}';
}
if(isset($bt_hover_text_color) && !empty($bt_hover_text_color)) {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button:hover {color: '.esc_js($bt_hover_text_color).';}';
}
if(isset($button_bg) && !empty($button_bg)) {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button {background: '.esc_js($button_bg).';}';
}
if(isset($button_hover_bg) && !empty($button_hover_bg)) {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button:hover {background: '.esc_js($button_hover_bg).';}';
}
if(isset($button_border_radius) && !empty($button_border_radius) || strcmp($button_border_radius, 0) === 0) {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button {border-radius: '.esc_js($button_border_radius).'px;}';
}
if(isset($icon_size) && strcmp($icon_size, '') != 0) {
	$width_icon = $icon_size + 30;
	$link_css .= '#'.esc_js($uniqid).' .icon-wrap.custom {min-width: '.esc_js($width_icon).'px;}';
}
if(isset($bt_icon_color) && !empty($bt_icon_color)) {
	$link_css .= '#'.esc_js($uniqid).' .button-container i {color: '.esc_js($bt_icon_color).';}';
}
if(isset($bt_icon_hover_color) && !empty($bt_icon_hover_color)) {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button:hover i {color: '.esc_js($bt_icon_hover_color).';}';
}
if(isset($bt_icon_size) && !empty($bt_icon_size)) {
	$link_css .= '#'.esc_js($uniqid).' .button-container i {font-size: '.esc_js($bt_icon_size).'px;}';
}
if(isset($button_padding_left) && $button_padding_left != '') {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button {padding-left: '.esc_js($button_padding_left).'px;}';
}
if(isset($button_padding_right) && $button_padding_right != '') {
	$link_css .= '#'.esc_js($uniqid).' .button-container .button {padding-right: '.esc_js($button_padding_right).'px;}';
}

$main_content_html .= '<div class="content-block">';
	$main_content_html .= '<span class="main-tilted-decoration"></span>';
	$main_content_html .= '<div class="main-alligned-container">';
		if(isset($show_icon) && strcmp($show_icon, 'enable_icon') == 0 ) {
			$main_content_html .= '<div class="icon-wrap '.esc_attr($icon_type).'">';
				$main_content_html .= $icon_html;
			$main_content_html .= '</div>';
		}
		$main_content_html .= '<div class="title-wrap">';
			$main_content_html .= $title_html;
			$main_content_html .= $subtitle_html;
		$main_content_html .= '</div>';
	$main_content_html .= '</div>';
$main_content_html .= '</div>';

$button_content_html .= '<div class="button-block">';
	$button_content_html .= '<span class="button-tilted-decoration"></span>';
	$button_content_html .= '<div class="button-container">';
		if(isset($show_bt_icon) && strcmp($show_bt_icon, 'enable_bt_icon') == 0 && $select_bt_icon != '') {
			if($select_bt_icon != 'dfd_icons') {
				vc_icon_element_fonts_enqueue($select_bt_icon);
			}
			$icon_class = ${'bt_'.$select_bt_icon};
			$bt_icon_html = '<span class="bt-icon-wrap"><i class="'.esc_attr($icon_class).'"></i></span>';
		}
		if(isset($button_text) && !empty($button_text)) {
			$button_text_option = _dfd_parse_text_shortcode_params($button_font_options, 'button');
		}
		if(isset($button_link) && !empty($button_link)) {
			$link = vc_build_link($button_link);
			$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
			$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
			$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
			$button_content_html .= '<a href="'.esc_url($link['url']).'" '.$link_title.' '.$link_target.' '.$link_rel.' class="'.$button_text_option['class'].'" '.$button_text_option['style'].'>'.$bt_icon_html.' '.esc_html($button_text).'</a>';
		}
	$button_content_html .= '</div>';
$button_content_html .= '</div>';

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-call-to-action-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
	$output .= '<div class="call-to-action-container">';
		if(isset($main_style) && strcmp($main_style, 'style-1') == 0) {
			$output .= $main_content_html;
			$output .= $button_content_html;
		}else{
			$output .= $button_content_html;
			$output .= $main_content_html;
		}
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