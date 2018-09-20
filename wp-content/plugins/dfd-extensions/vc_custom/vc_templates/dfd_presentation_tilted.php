<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$uniqid = $main_style = $el_class = $output = $title_font_options = $use_google_fonts = $custom_fonts = $subtitle_font_options = $font_options = $module_animation = '';
$animation_data = $columns_width = $list_fields = $icon_type = $select_icon = $ic_dfd_icons = $ic_fontawesome = $ic_openiconic = $ic_typicons = $ic_entypo = '';
$ic_linecons = $icon_image_id = $icon_text = $block_title = $block_subtitle = $block_content = $dark_bg = $title_options = $subtitle_options = $link_css = '';
$content_font_options = $content_style = $icon_size = $icon_color = $block_background = '';
$border_radius = $block_bg_style = $uniqid_before = '';

$atts = vc_map_get_attributes('dfd_presentation_tilted', $atts);
extract($atts);

$uniqid = uniqid('dfd-presentation-tilted-').'-'.rand(1,9999);

$el_class .= ' '.$main_style;

if(!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-item=".dfd-presentation-tilted-item" data-animate-type = "'.esc_attr($module_animation).'"';
}

$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
$subtitle_options = _dfd_parse_text_shortcode_params( $subtitle_font_options, 'dfd-content-subtitle' );
$content_font_options = _dfd_parse_text_shortcode_params($font_options);
$content_style = $content_font_options['style'];

if(isset($icon_size) && !empty($icon_size)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-presentation-tilted-item .head-container .icon-wrap {font-size: '.esc_js($icon_size).'px;}';
}
if(isset($border_radius) && !empty($border_radius) || strcmp($border_radius, 0) === 0) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-presentation-tilted-list {border-radius: '.esc_js($border_radius).'px;}';
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-presentation-tilted-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
	if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
		$list_fields = (array) vc_param_group_parse_atts($list_fields);

		$output .= '<ul class="dfd-presentation-tilted-list clearfix '.esc_attr($columns_width).'">';
			foreach($list_fields as $fields) {
				$title_html = $subtitle_html = $content_html = $icon_html = '';
				$item_class = 'dfd-background-light';
				if(isset($fields['dark_bg']) && strcmp($fields['dark_bg'], 'bg') == 0) {
					$item_class = 'dfd-background-dark';
				}
				if(isset($fields['block_title']) && !empty($fields['block_title'])) {
					$title_html = '<'.$title_options['tag'].' class="'.$title_options['class'].'" '.$title_options['style'].'>'.esc_html($fields['block_title']).'</'.$title_options['tag'].'>';
				}
				if(isset($fields['block_subtitle']) && !empty($fields['block_subtitle'])) {
					$subtitle_html = '<'.$subtitle_options['tag'].' class="'.$subtitle_options['class'].' block-subtitle" '.$subtitle_options['style'].'>'.esc_html($fields['block_subtitle']).'</'.$subtitle_options['tag'].'>';
				}
				if(isset($fields['block_content']) && !empty($fields['block_content'])) {
					$content_html = '<div class="description" '.$content_style.'>'.do_shortcode($fields['block_content']).'</div>';
				}

				$uniqid_before = uniqid('main-decoration-before').'-'.rand(1,9999);
				if(isset($fields['block_background']) && !empty($fields['block_background'])) {
					$link_css .= '#'.esc_attr($uniqid_before).' .main-decoration:before {background: '.esc_attr($fields['block_background']).';}';
				}
				if(isset($fields['icon_color']) && !empty($fields['icon_color'])) {
					$link_css .= '#'.esc_attr($uniqid_before).'.dfd-presentation-tilted-item .head-container .icon-wrap {color: '.esc_attr($fields['icon_color']).';}';
				}
					
				$icon_html = dfd_icon_render($fields);

				$output .= '<li id="'.esc_attr($uniqid_before).'" class="dfd-presentation-tilted-item dfd-equalize-height '.esc_attr($item_class).'">';
					$output .= '<span class="main-decoration"></span>';
					$output .= '<div class="head-container">';
						$output .= '<div class="icon-wrap">';
							$output .= '<span class="icon-decoration">';
								$output .= $icon_html;
							$output .= '</span>';
						$output .= '</div>';
						$output .= '<div class="title-wrap">';
							$output .= $title_html;
							$output .= $subtitle_html;
						$output .= '</div>';
					$output .= '</div>';
					$output .= $content_html;
				$output .= '</li>';
			}
		$output .= '</ul>';

		if(!empty($link_css)) {
			$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
		}
	}
	
$output .= '</div>';

echo $output;