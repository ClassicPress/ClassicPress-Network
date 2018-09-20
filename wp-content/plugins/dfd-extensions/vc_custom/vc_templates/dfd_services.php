<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$main_style = $animation_data = $el_class = $list_fields = $block_title = $block_subtitle = $block_content = $title_options = $hor_content_offset = '';
$uniqid = $title_font_options = $use_google_fonts = $custom_fonts = $subtitle_options = $subtitle_font_options = $content_font_options = '';
$font_options = $content_style = $link_css = $columns_width = $output = $icon_type = $select_icon = $ic_dfd_icons = $ic_fontawesome = $ic_openiconic = '';
$ic_typicons = $ic_entypo = $ic_linecons = $icon_image_id = $icon_text = $module_animation = $vertical_content_offset = $connector_style = $connector_color = '';
$icon_color = $icon_bg_size = $border_radius = $background_color = $border_color = $border_width = $hover_style = $hover_direction = $front_bg_color = '';
$back_bg_color = $hor_offset = $icon_size_st1 = $icon_size_st23 = $icon_size_st4 = $dark_bg_front = $dark_bg_back = $front_block_class = $back_block_class = '';

$atts = vc_map_get_attributes('dfd_services', $atts);
extract($atts);

$uniqid = uniqid('dfd-services-').'-'.rand(1,9999);

$el_class .= ' '.$main_style;

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-item=".dfd-service-item" data-animate-type = "'.esc_attr($module_animation).'"';
}

if(isset($hover_style) && !empty($hover_style)) {
	$el_class .= ' '.$hover_style.' '.$hover_direction;
}
if(isset($dark_bg_front) && strcmp($dark_bg_front, 'bg_front') == 0) {
	$front_block_class = 'dfd-background-dark';
}
if(isset($dark_bg_back) && strcmp($dark_bg_back, 'bg_back') == 0) {
	$back_block_class = 'dfd-background-dark';
}

$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
$subtitle_options = _dfd_parse_text_shortcode_params( $subtitle_font_options, 'dfd-content-subtitle' );
$content_font_options = _dfd_parse_text_shortcode_params($font_options);
$content_style = $content_font_options['style'];

if(isset($hover_style) && strcmp($hover_style, 'sliding') == 0) {
	if(isset($connector_style) && !empty($connector_style)) {
		$link_css .= '#'.esc_js($uniqid).' .dfd-service-item {border-style: '.esc_attr($connector_style).';}';
	}
	if(isset($connector_color) && !empty($connector_color)) {
		$link_css .= '#'.esc_js($uniqid).' .dfd-service-item {border-color: '.esc_attr($connector_color).';}';
	}
}
if(isset($vertical_content_offset) && strcmp($vertical_content_offset, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front, #'.esc_js($uniqid).' .dfd-service-item .dfd-service-back {padding-top: '.esc_attr($vertical_content_offset).'px; padding-bottom: '.esc_attr($vertical_content_offset).'px;}';
}
if(isset($hor_content_offset) && strcmp($hor_content_offset, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front, #'.esc_js($uniqid).' .dfd-service-item .dfd-service-back {padding-left: '.esc_attr($hor_content_offset).'px; padding-right: '.esc_attr($hor_content_offset).'px;}';
}
if(isset($icon_size_st1) && strcmp($icon_size_st1, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).'.style-1 .dfd-service-item .dfd-service-front .icon-wrap {font-size: '.esc_attr($icon_size_st1).'px; width: '.esc_attr($icon_size_st1).'px; height: '.esc_attr($icon_size_st1).'px; line-height: '.esc_attr($icon_size_st1).'px;}';
	if(is_rtl()) {
		$link_css .= '#'.esc_js($uniqid).'.style-1 .dfd-service-item .dfd-service-front .title-wrap {margin-right: '.esc_attr($icon_size_st1 + 30).'px;}';
	}else {
		$link_css .= '#'.esc_js($uniqid).'.style-1 .dfd-service-item .dfd-service-front .title-wrap {margin-left: '.esc_attr($icon_size_st1 + 30).'px;}';
	}
}
if(isset($icon_size_st23) && strcmp($icon_size_st23, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).'.style-2 .dfd-service-item .dfd-service-front .icon-wrap, #'.esc_js($uniqid).'.style-3 .dfd-service-item .dfd-service-front .icon-wrap {font-size: '.esc_attr($icon_size_st23).'px;}';
}
if(isset($icon_size_st4) && strcmp($icon_size_st4, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).'.style-4 .dfd-service-item .dfd-service-front .icon-wrap {font-size: '.esc_attr($icon_size_st4).'px;}';
}
if(isset($icon_color) && !empty($icon_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front .icon-wrap {color: '.esc_attr($icon_color).';}';
}
if(isset($main_style) && strcmp($main_style, 'style-2') == 0 || isset($main_style) && strcmp($main_style, 'style-3') == 0) {
	if(isset($icon_bg_size) && !empty($icon_bg_size)) {
		$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front .icon-wrap {width: '.esc_attr($icon_bg_size).'px; height: '.esc_attr($icon_bg_size).'px; line-height: '.esc_attr($icon_bg_size).'px; margin-top: -'.esc_attr($icon_bg_size / 2).'px;}';
		if(is_rtl()) {
			$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front .title-wrap {margin-right: '.esc_attr($icon_bg_size + 30).'px;}';
		}else {
			$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front .title-wrap {margin-left: '.esc_attr($icon_bg_size + 30).'px;}';
		}
	}
	if(isset($border_radius) && !empty($border_radius) || strcmp($border_radius, 0) === 0) {
		$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front .icon-wrap {border-radius: '.esc_attr($border_radius).'px;}';
	}
}
if(isset($background_color) && !empty($background_color)) {
	$link_css .= '#'.esc_js($uniqid).'.style-2 .dfd-service-item .dfd-service-front .icon-wrap .icon-decoration:after, #'.esc_js($uniqid).'.style-3 .dfd-service-item .dfd-service-front .icon-wrap .icon-decoration:after {background: '.esc_attr($background_color).';}';
}
if(isset($border_color) && !empty($border_color)) {
	$link_css .= '#'.esc_js($uniqid).'.style-3 .dfd-service-item .dfd-service-front .icon-wrap .icon-decoration:after {border-color: '.esc_attr($border_color).';}';
}
if(isset($border_width) && strcmp($border_width, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).'.style-3 .dfd-service-item .dfd-service-front .icon-wrap .icon-decoration:after {border-width: '.esc_attr($border_width).'px;}';
}
if(isset($front_bg_color) && !empty($front_bg_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-front {background: '.esc_attr($front_bg_color).';}';
}
if(isset($back_bg_color) && !empty($back_bg_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-service-item .dfd-service-back {background: '.esc_attr($back_bg_color).';}';
}
if(isset($hover_style) && strcmp($hover_style, 'sliding') != 0) {
	if(isset($hor_offset) && strcmp($hor_offset, '') != 0) {
		$link_css .= '#'.esc_js($uniqid).' .dfd-service-item {border-left-width: '.esc_attr($hor_offset / 2).'px; border-right-width: '.esc_attr($hor_offset / 2).'px;}';
		$link_css .= '#'.esc_js($uniqid).' .dfd-service-item:first-child {border-left-width: '.esc_attr($hor_offset).'px;}';
		$link_css .= '#'.esc_js($uniqid).' .dfd-service-item:last-child {border-right-width: '.esc_attr($hor_offset).'px;}';
			/*responcive style*/
		$link_css .= '@media (max-width: 1023px) and (min-width: 799px) {'
						. '#'.esc_js($uniqid).' .dfd-service-list.quarter-width-elements .dfd-service-item {border-top-width: '.esc_attr($hor_offset).'px;}'
						. '#'.esc_js($uniqid).' .dfd-service-list.quarter-width-elements .dfd-service-item:nth-child(-n+2) {border-top-width: 0;}'
						. '#'.esc_js($uniqid).' .dfd-service-list.quarter-width-elements .dfd-service-item:nth-child(3n-1) {border-right-width: '.esc_attr($hor_offset).'px;}'
						. '#'.esc_js($uniqid).' .dfd-service-list.quarter-width-elements .dfd-service-item:nth-child(2n+1) {border-left-width: '.esc_attr($hor_offset).'px;}'
					. '}';
	}
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-services-wrap '.esc_attr($el_class).' responcive-class" '.$animation_data.'>';
	if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
		$list_fields = (array) vc_param_group_parse_atts($list_fields);
		
		$output .= '<ul class="dfd-service-list dfd-mobile-keep-height clearfix '.esc_attr($columns_width).'">';

			foreach($list_fields as $fields) {
				$title_html = $subtitle_html = $content_html = '';
				if(isset($fields['block_title']) && !empty($fields['block_title'])) {
					$title_html = '<'.$title_options['tag'].' class="'.$title_options['class'].'" '.$title_options['style'].'>'.strip_tags($fields['block_title'], '<br><br/>').'</'.$title_options['tag'].'>';
				}
				if(isset($fields['block_subtitle']) && !empty($fields['block_subtitle'])) {
					$subtitle_html = '<'.$subtitle_options['tag'].' class="'.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.strip_tags($fields['block_subtitle'], '<br><br/>').'</'.$subtitle_options['tag'].'>';
				}
				if(isset($fields['block_content']) && !empty($fields['block_content'])) {
					$content_html = '<div class="description" '.$content_style.'>'.strip_tags($fields['block_content'], '<br><br/>').'</div>';
				}
				$icon_html = dfd_icon_render($fields);
				
				$output .= '<li class="dfd-service-item">';
				
					$output .= '<div class="dfd-service-front dfd-equalize-height '.$front_block_class.'">';
						$output .= '<div class="icon-wrap">';
							$output .= '<span class="icon-decoration">';
								$output .= $icon_html;
							$output .= '</span>';
						$output .= '</div>';
						$output .= '<div class="title-wrap dfd-vertical-aligned">';
							$output .= $title_html;
							$output .= $subtitle_html;
						$output .= '</div>';
					$output .= '</div>';
					
					$output .= '<div class="dfd-service-back dfd-equalize-height '.$back_block_class.'">';
						$output .= $content_html;
					$output .= '</div>';
				
				$output .= '</li>';
			}
		$output .= '</ul>';
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