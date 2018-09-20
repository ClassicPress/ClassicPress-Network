<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$module_animation = $animation_data = $output = $main_style = $el_class = $list_fields = $icon_type = $select_icon = $ic_fontawesome = $ic_openiconic = '';
$ic_typicons = $ic_entypo = $ic_linecons = $icon_image_id = $icon_text = $text_content = $content_typo = $icon_class = $icon_size = $icon_color = $font_options = '';
$use_google_fonts = $custom_fonts =	$link_css = $icon_border = $icon_background = $del_height = $del_style = $del_color = $del_html = $link_box = $link = '';
$background_size = $icon_margin = $icon_bottom_spase = $icon_align = '';

$atts = vc_map_get_attributes( 'dfd_icon_list', $atts );
extract( $atts );

$uniqid = uniqid('dfd-icon-list-') .'-'.rand(1,9999);

$el_class .= ' '.esc_attr($main_style).' ';

if (!($module_animation == '')) {
	$el_class .= ' cr-animate-gen ';
	$animation_data = 'data-animate-item=".dfd-icon-list li" data-animate-type="'.esc_attr($module_animation).'" ';
}

$el_class .= ' '.esc_attr($icon_align);

if(isset($icon_size) && !empty($icon_size)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {font-size: '.esc_js($icon_size).'px;}';
}
if(isset($icon_color) && !empty($icon_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {color: '.esc_js($icon_color).';}';
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap .none {background: '.esc_js($icon_color).';}';
}
if(isset($icon_background) && !empty($icon_background)) {
	if(isset($icon_align) && $icon_align == 'icon-right') {
		$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {text-align: center; margin-left: 18px;}';
	}else{
		$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {text-align: center; margin-right: 18px;}';
	}
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap:before {background: '.esc_js($icon_background).';}';
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap .none {left: 50%; margin-left: -3px;}';
}
if($icon_border != '') {
	$icon_border_css = Dfd_Border_Param::border_css($icon_border);
	if(substr_count($icon_border_css,'border-radius:') > 0) {
		$border_radius = substr($icon_border_css,stripos($icon_border_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap:before {'.$border_radius.'}';
		}
	}
	if(strpos($icon_border_css, 'none') == false) {
		if(isset($icon_align) && $icon_align == 'icon-right') {
			$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {text-align: center; margin-left: 18px;}';
		}else{
			$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {text-align: center; margin-right: 18px;}';
		}
		$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap .none {left: 50%; margin-left: -3px;}';
	}
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap:before {'.$icon_border_css.'}';
}
if(isset($del_height) && !empty($del_height)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .delimeter {border-bottom-width: '.esc_js($del_height).'px;}';
}
if(isset($del_style) && !empty($del_style)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .delimeter {border-bottom-style: '.esc_js($del_style).';}';
}
if(isset($del_color) && !empty($del_color)) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .delimeter {border-bottom-color: '.esc_js($del_color).';}';
}
if(isset($background_size) && strcmp($background_size, '') != 0) {
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {width: '.esc_js($background_size).'px; height: '.esc_js($background_size).'px; line-height: '.esc_js($background_size).'px;}';
}
if(isset($icon_align) && $icon_align == 'icon-right') {
	if(isset($icon_margin) && !empty($icon_margin)) {
		$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {margin-left: '.esc_js($icon_margin).'px;}';
	}
}else{
	if(isset($icon_margin) && !empty($icon_margin)) {
		$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .icon-wrap {margin-right: '.esc_js($icon_margin).'px;}';
	}
}
if(isset($icon_bottom_spase) && $icon_bottom_spase != '') {
	$link_css .= '#'.esc_js($uniqid).' .dfd-icon-list .delimeter, #'.esc_js($uniqid).' .dfd-icon-list li {padding-top: '.esc_js($icon_bottom_spase).'px;}';
}

if(isset($main_style) && strcmp($main_style, 'style-1') !== 0) {
	$del_html = '<div class="delimeter"></div>';
}

$output .= '<div id="'.esc_js($uniqid).'" class="dfd-icon-list-wrap '.esc_attr($el_class).'" '.$animation_data.'>';
	if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
		$list_fields = (array) vc_param_group_parse_atts( $list_fields );
		
		$content_typo = _dfd_parse_text_shortcode_params($font_options, 'dfd-content-title-small', $use_google_fonts, $custom_fonts);

		$output .= '<ul class="dfd-icon-list">';

			foreach($list_fields as $fields) {
				
				$icon_html = $content_html = $link_attr = $link_html = $link_class = '';

				if(isset($fields['link_box']) && $fields['link_box'] == 'link_b') {
					$link_class = 'with-link';
					$link_src = vc_build_link($fields['link']);

					if(isset($link_src['url']) && !empty($link_src['url'])) {
						$link_attr .= 'href="'.esc_url($link_src['url']).'" ';
					}else{
						$link_attr .= 'href="#" ';
					}
					if(isset($link_src['title']) && !empty($link_src['title'])) {
						$link_attr .= 'title="'.esc_attr($link_src['title']).'" ';
					}
					if(isset($link_src['target']) && !empty($link_src['target'])) {
						$link_attr .= 'target="'.esc_attr(preg_replace('/\s+/', '', $link_src['target'])).'" ';
					}
					if(isset($link_src['rel']) && !empty($link_src['rel'])) {
						$link_attr .= 'rel="'.esc_attr($link_src['rel']).'"';
					}
					$link_html = '<a '.$link_attr.' class="icon-item-link"></a>';
				}

				if(isset($fields['text_content']) && !empty($fields['text_content'])) {
					$content_html .= '<div class="content-wrap">';
						$content_html .= '<'.$content_typo['tag'].' class="'.$content_typo['class'].'" '.$content_typo['style'].'>'.$fields['text_content'].'</'.$content_typo['tag'].'>';
					$content_html .= '</div>';
				}
				
				if(isset($fields['icon_type']) && strcmp($fields['icon_type'], 'selector') === 0) {
					$icon_html .= '<div class="icon-wrap">';
						$icon_html .= dfd_icon_render($fields);
					$icon_html .= '</div>';
				} elseif(isset($fields['icon_type']) && strcmp($fields['icon_type'], 'without') === 0) {
					$icon_html .= '<div class="icon-wrap without-icon">';
						$icon_html .= '<i class="none"></i>';
					$icon_html .= '</div>';
				}

				$output .= '<li class="'.esc_attr($link_class).'">';
					$output .= '<div class="list-container '.esc_attr($fields['icon_type']).'">';
						if(isset($icon_align) && $icon_align == 'icon-left' || $icon_align == 'icon-center') {
							$output .= $icon_html;
							$output .= $content_html;
						}else{
							$output .= $content_html;
							$output .= $icon_html;
						}
					$output .= '</div>';
					$output .= $del_html;
					$output .= $link_html;
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