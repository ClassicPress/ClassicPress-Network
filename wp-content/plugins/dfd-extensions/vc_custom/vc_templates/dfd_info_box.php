<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$unique_id = $main_style = $main_layout = $module_animation = $el_class = $animation_data = $title = $subtitle = $output = $main_content = $read_more = $link = '';
$readmore_show = $more_show = $readmore_style = $readmore_text = $icon_number = $icon_number_text = $number_color = $number_bg_color = $link_css = $link_target = '';
$title_options = $title_font_options = $use_google_fonts = $custom_fonts = $title_html = $subtitle_options = $subtitle_font_options = $subtitle_html = $title_responsive = '';
$content_font_options = $font_options = $content_style = $content_html = $read_more_html = $content_alignment = $content_two_alignment = $title_wrap_html = '';
$content_wrap_html = $head_html = $icon_bg_size = $border_radius = $background_color = $border_color = $border_width = $content_only_hover = $icon_size = $icon_html = '';
$hover_border_radius = $hover_background_color = $hover_border_color = '';

$atts = vc_map_get_attributes( 'dfd_info_box', $atts );
extract( $atts );

$unique_id = uniqid('dfd-info-box-').'-'.rand(1,9999);

$el_class .= ' '.esc_attr($main_style).' '.esc_attr($main_layout);

if(isset($content_only_hover) && strcmp($content_only_hover, 'only_hover') == 0) {
	$el_class .= ' content-only-hover';
}
if(isset($readmore_show) && strcmp($readmore_show, 'show') == 0) {
	$el_class .= ' show-readmore '.esc_attr($readmore_style);
}
if(isset($main_layout) && strcmp($main_layout, 'layout-1') == 0) {
	$el_class .= ' '.esc_attr($content_alignment);
}else{
	$el_class .= ' '.esc_attr($content_two_alignment);
}

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'" ';
}

if (isset($more_show) && strcmp($more_show, 'hover') == 0) {
	$el_class .= ' more-hover';
}

if(isset($number_color) && !empty($number_color)) {
	$link_css .= '#'.esc_js($unique_id).' .icon-wrapper .info-box-icon-text {color: '.esc_js($number_color).';}';
}
if(isset($number_bg_color) && !empty($number_bg_color)) {
	$link_css .= '#'.esc_js($unique_id).' .icon-wrapper .info-box-icon-text {background: '.esc_js($number_bg_color).';}';
}
if(isset($icon_bg_size) && !empty($icon_bg_size)) {
	$link_css .= '#'.esc_js($unique_id).' .icon-wrapper .module-icon {width: '.esc_js($icon_bg_size).'px; height: '.esc_js($icon_bg_size).'px; line-height: '.esc_js($icon_bg_size).'px;}';
	$link_css .= '#'.esc_js($unique_id).'.style-2.layout-2.text-left .content-cell, #'.esc_js($unique_id).'.style-3.layout-2.text-left .content-cell, #'.esc_js($unique_id).'.style-4.layout-2.text-left .content-cell {padding-left: '.esc_js($icon_bg_size + 20).'px;}';
	$link_css .= '#'.esc_js($unique_id).'.style-2.layout-2.text-right .content-cell, #'.esc_js($unique_id).'.style-3.layout-2.text-right .content-cell, #'.esc_js($unique_id).'.style-4.layout-2.text-right .content-cell {padding-right: '.esc_js($icon_bg_size + 20).'px;}';
}
if(isset($icon_size) && $icon_size != '') {
	$link_css .= '#'.esc_js($unique_id).'.style-1.layout-2.text-left .content-cell {padding-left: '.esc_js($icon_size + 20).'px;}';
	$link_css .= '#'.esc_js($unique_id).'.style-1.layout-2.text-right .content-cell {padding-right: '.esc_js($icon_size + 20).'px;}';
	$link_css .= '#'.esc_js($unique_id).'.style-5 {min-height: '.esc_js($icon_size).'px;}';
	$link_css .= '#'.esc_js($unique_id).'.style-1.layout-2 .module-icon, #'.esc_js($unique_id).'.style-1.layout-3 .module-icon {width: '.esc_js($icon_size).'px; height: '.esc_js($icon_size).'px;}';
}
if(isset($border_radius) && !empty($border_radius) || strcmp($border_radius, 0) === 0) {
	$link_css .= '#'.esc_js($unique_id).' .icon-wrapper .module-icon {border-radius: '.esc_js($border_radius).'px;}';
}
if(isset($hover_border_radius) && $hover_border_radius != '') {
	$link_css .= '#'.esc_js($unique_id).':hover .icon-wrapper .module-icon {border-radius: '.esc_js($hover_border_radius).'px;}';
}
if(isset($background_color) && !empty($background_color)) {
	$link_css .= '#'.esc_js($unique_id).'.style-2 .icon-wrapper .module-icon, #'.esc_js($unique_id).'.style-4 .icon-wrapper .module-icon:after {background: '.esc_js($background_color).';}';
}
if(isset($hover_background_color) && !empty($hover_background_color)) {
	$link_css .= '#'.esc_js($unique_id).'.style-2:hover .icon-wrapper .module-icon, #'.esc_js($unique_id).'.style-4:hover .icon-wrapper .module-icon:after {background: '.esc_js($hover_background_color).';}';
}
if(isset($border_color) && !empty($border_color)) {
	$link_css .= '#'.esc_js($unique_id).' .icon-wrapper .module-icon:before {border-color: '.esc_js($border_color).';}';
}
if(isset($hover_border_color) && !empty($hover_border_color)) {
	$link_css .= '#'.esc_js($unique_id).':hover .icon-wrapper .module-icon:before {border-color: '.esc_js($hover_border_color).';}';
}
if(isset($border_width) && $border_width != '') {
	$link_css .= '#'.esc_js($unique_id).' .icon-wrapper .module-icon:before {border-width: '.  esc_js($border_width).'px;}';
	$link_css .= '#'.esc_js($unique_id).'.style-4 .icon-wrapper .module-icon:after {margin: '.esc_js($border_width + 5).'px;}';
}
if(isset($title_responsive) && $title_responsive != '') {
	$link_css .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#'.esc_js($unique_id).' .title-wrap .info-box-title ');
}

if(!empty($title)) {
	$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
	if(isset($link) && strcmp($read_more, 'title') == 0) {
		$link = vc_build_link($link);
		$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
		$title_html .= '<'.$title_options['tag'].' class="info-box-title '.$title_options['class'].'" '.$title_options['style'].'><a href="'.esc_url($link['url']).'" title="'.esc_attr($link['title']).'" '.$link_target.' rel="'.esc_attr($link['rel']).'">'.wp_kses($title, array('span' => array(),'br' => array())).'</a></'.$title_options['tag'].'>';
	}else{
		$title_html .= '<'.$title_options['tag'].' class="info-box-title '.$title_options['class'].'" '.$title_options['style'].'>'.wp_kses($title, array('span' => array(), 'br' => array())).'</'.$title_options['tag'].'>';
	}
}
if(!empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
	$subtitle_html .= '<'.$subtitle_options['tag'].' class="info-box-subtitle '.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($subtitle).'</'.$subtitle_options['tag'].'>';
}

if(isset($title) &&!empty($title) || isset($subtitle) && !empty($subtitle)) {
	$title_wrap_html .= '<div class="title-wrap">';
		$title_wrap_html .= $title_html;
		$title_wrap_html .= $subtitle_html;
	$title_wrap_html .= '</div>';
}

$content_font_options = _dfd_parse_text_shortcode_params($font_options);
$content_style = $content_font_options['style'];
$content_html .= '<div class="description" '.$content_style.'>'.strip_tags($main_content,'<br><br/>').'</div>';

if(isset($icon_type) && $icon_type == 'selector' || $icon_type == 'custom' && !empty($icon_image_id) || $icon_type == 'text' && !empty($icon_text)) {
	$icon_html = '<div class="icon-wrapper">';
		$icon_html .= '<div class="module-icon">';
			$icon_html .= '<div class="icon-container">';
				$icon_html .= dfd_icon_render($atts);
			$icon_html .= '</div>';
			if(isset($icon_number) && strcmp($icon_number, 'yes') == 0 && isset($icon_number_text) && !empty($icon_number_text)) {
				$icon_html .= '<span class="info-box-icon-text">'.esc_html($icon_number_text).'</span>';
				$el_class .= ' with-number';
			}
		$icon_html .= '</div>';
	$icon_html .= '</div>';
}else{
	$link_css .= '#'.esc_js($unique_id).'.style-5 {padding-top: 0; min-height: initial;}';
}

$read_more_html .= dfd_module_read_more($atts);

$head_html .= '<div class="head-wrap">';
$content_wrap_html .= '<div class="container-info">';
if(isset($content_two_alignment) && strcmp($content_two_alignment, 'text-left') == 0) {
	$head_html .= $icon_html;
	$head_html .= $title_wrap_html;
	$content_wrap_html .= '<div class="empty-cell"></div>';
	$content_wrap_html .= '<div class="content-cell">';
		$content_wrap_html .= $content_html;
		$content_wrap_html .= $read_more_html;
	$content_wrap_html .= '</div>';
}else{
	$head_html .= $title_wrap_html;
	$head_html .= $icon_html;
	$content_wrap_html .= '<div class="content-cell">';
		$content_wrap_html .= $content_html;
		$content_wrap_html .= $read_more_html;
	$content_wrap_html .= '</div>';
	$content_wrap_html .= '<div class="empty-cell"></div>';
}
$head_html .= '</div>';
$content_wrap_html .= '</div>';

$output .= '<div id="'.esc_attr($unique_id).'" class="dfd-info-box '.esc_attr($el_class).'" '.$animation_data.'>';

	if(isset($main_style) && strcmp($main_style, 'style-5') !== 0) {
		if(!empty($icon_html) || !empty($title_wrap_html)) {
			$output .= $head_html;
		}
		if(isset($main_content) && !empty($main_content) || isset($readmore_show) && $readmore_show == 'show') {
			$output .= $content_wrap_html;
		}
	}else{
		$output .= $icon_html;
		$output .= $title_wrap_html;
		if(isset($main_content) && !empty($main_content) || isset($readmore_show) && $readmore_show == 'show') {
			$output .= '<div class="container-info">';
				$output .= '<div class="content-cell">';
					$output .= $content_html;
					$output .= $read_more_html;
				$output .= '</div>';
			$output .= '</div>';
		}
	}

	if(isset($link) && strcmp($read_more, 'box') == 0) {
		$link = vc_build_link( $link );
		$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
		$output .= '<a href="'.esc_url($link['url']).'" class="full-box-link" title="'.esc_attr($link['title']).'" '.$link_target.' rel="'.esc_attr($link['rel']).'"></a>';
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