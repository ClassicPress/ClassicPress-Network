<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$main_style = $uniqid = $el_class = $module_animation = $animation_data = $output = $css_rules = $title_font_options = $use_google_fonts = $custom_fonts = '';
$subtitle_font_options = $font_options = $list_fields = $icon_image_id = $block_title = $block_subtitle = $block_content = $link = '';
$title_options = $subtitle_options = $content_font_options = $content_style = '';
$disable_shadow = $link_box = $columns_class = '';
$images_lazy_load = false;

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$images_lazy_load = true;
	$columns_class .= ' dfd-img-lazy-load ';
}

$atts = vc_map_get_attributes('dfd_client_logo', $atts);
extract($atts);

$uniqid = uniqid('dfd-client-logo-').'-'.rand(1,9999);

$el_class .= ' '.$main_style;

if(!($module_animation == '')) {
	$animation_data = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
}

if(isset($disable_shadow) && strcmp($disable_shadow, 'shadow') == 0) {
	$el_class .= ' enable-shadow';
}

if(isset($enable_delimiter) && $enable_delimiter == 'on') {
	$el_class .= ' enable-delimiter';
}

if(isset($enable_main_border) && $enable_main_border == 'on') {
	$el_class .= ' enable-main-border';
}

$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
$content_font_options = _dfd_parse_text_shortcode_params($font_options);
$content_style = $content_font_options['style'];

if(isset($mask_content_color) && $mask_content_color != '') {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-client-logo-wrap .dfd-client-logo-item .title-wrap .dfd-content-title-big,'
				. '#'.esc_js($uniqid).'.dfd-client-logo-wrap .dfd-client-logo-item .description {color: '.esc_js($mask_content_color).';}';
	$css_rules .= '#'.esc_js($uniqid).'.dfd-client-logo-wrap .dfd-client-logo-item .title-wrap .subtitle {color: '.esc_js(Dfd_Theme_Helpers::dfd_hex2rgb($mask_content_color,.4)).';}';
}

if(isset($mask_background) && $mask_background != '') {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-client-logo-wrap.style-1.enable-shadow .dfd-client-logo-item:hover .dfd-shadow-wrap,'
				. '#'.esc_js($uniqid).'.dfd-client-logo-wrap.style-2.enable-shadow .dfd-client-logo-item:hover .dfd-shadow-wrap {background: '.esc_js($mask_background).';}';
}

if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
	$list_fields = (array) vc_param_group_parse_atts($list_fields);

	if($columns == 'default') {
		$columns_count = count($list_fields);

		if($columns_count > 4) {
			if($columns_count % 3 == 0 && $columns_count % 4 != 0) {
				$columns_count = 3;
			} else {
				$columns_count = 4;
			}
		}
		$num = (int)$columns_count;
		$columns_class .= Dfd_Theme_Helpers::dfd_num_to_string($columns_count);
	} else {
		$columns_class .= 'columns-'.$columns;
		$num = (int)$columns;
	}
	
	$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-client-logo-wrap '.esc_attr($el_class).'" data-count="'.esc_attr($num).'" '.$animation_data.'>';
		
		$output .= '<div class="dfd-client-logo-offset-wrap">';
			$output .= '<div class="dfd-client-logo-list row">';
			
				foreach($list_fields as $fields) {
					
					$title_html = $subtitle_html = $heading_html = $content_html = $image_url = $img_src = $img_html = $link_html = $field_class = '';
					$link_title = $link_rel = $link_target = '';
					
					if(isset($fields['block_title']) && !empty($fields['block_title'])) {
						$title_html = '<'.$title_options['tag'].' class="'.$title_options['class'].'" '.$title_options['style'].'>'.esc_html($fields['block_title']).'</'.$title_options['tag'].'>';
					}
					if(isset($fields['block_subtitle']) && !empty($fields['block_subtitle'])) {
						$subtitle_html = '<'.$subtitle_options['tag'].' class="'.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($fields['block_subtitle']).'</'.$subtitle_options['tag'].'>';
					}
					if(isset($fields['block_content']) && !empty($fields['block_content'])) {
						$content_html = '<div class="description" '.$content_style.'>'.esc_html($fields['block_content']).'</div>';
					}
					if($title_html != '' || $subtitle_html != '' || $content_html != '') {
						if($title_html != '' || $subtitle_html != '') {
							$heading_html .= '<div class="title-wrap">';
								$heading_html .= $title_html;
								$heading_html .= $subtitle_html;
							$heading_html .= '</div>';
						}
						$field_class = 'with-content';
					}
					if(isset($fields['icon_image_id']) && !empty($fields['icon_image_id'])) {
						$image_url = wp_get_attachment_image_src($fields['icon_image_id'], 'full');
						$img_src = dfd_aq_resize($image_url[0], 300, 200, true, true, false);

						if(!$img_src) {
							$img_src = $image_url[0];
						}

					} else {
						$img_src = Dfd_Theme_Helpers::default_noimage_url();
					}
					
					$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src, $fields['icon_image_id'], 300, 200, esc_attr__('Client logo','dfd-native'));
					
					if($images_lazy_load) {
						$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 300 200'%2F%3E";
						$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($img_src).'" '.$img_atts.' />';
					} else {
						$img_html = '<img src="'.esc_url($img_src).'" '.$img_atts.' />';
					}
					
					if(isset($fields['link_box']) && $fields['link_box'] == 'link_b' && isset($fields['link'])) {
						$link = vc_build_link($fields['link']);
						$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
						$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
						$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
						$link_html = '<a href="'.esc_url($link['url']).'" class="full-box-link" '.$link_title.' '.$link_target.' '.$link_rel.'></a>';
					}

					$output .= '<div class="dfd-item-offset columns columns-with-border '.esc_attr($columns_class).'">';
						$output .= '<div class="dfd-client-logo-item '.esc_attr($field_class).'">';
							if(isset($main_style) && ($main_style == 'style-1' || $main_style == 'style-2')) {
								$output .= '<span class="dfd-shadow-wrap"></span>';
							}
							if(!isset($main_style) || strcmp($main_style, 'style-1') == 0 || strcmp($main_style, 'style-3') == 0) {
								$output .= $heading_html;
							}
							$output .= '<div class="thumb-wrap">';
								$output .= $img_html;
							$output .= '</div>';
							if(!isset($main_style) || ($main_style != 'style-1' && $main_style != 'style-3')) {
								$output .= '<div class="content-wrap">';
									$output .= $heading_html;
							}
							$output .= $content_html;
							if(isset($main_style) && $main_style != 'style-1' && $main_style != 'style-3') {
								$output .= '</div>';
							}
						$output .= $link_html;
						$output .= '</div>';
					$output .= '</div>';
				}

			$output .= '</div>';
		$output .= '</div>';
		
		if($css_rules != '') {
			$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$css_rules.'</style>");'
						. '})(jQuery);'
					. '</script>';
		}
	
	$output .= '</div>';
}

echo $output;