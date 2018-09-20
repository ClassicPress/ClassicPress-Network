<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $module_animation = $main_style = $dfd_social_networks = $dfd_social_networks_sel = $soc_url = $link = $link_atts = $el_class = $standard_icon_color = '';
$info_alignment = $icon_font_size = $border_radius = $icon_border = $border_width = $icon_margin = $link_css = $icon_color = $style_two_hover = '';
$icon_hover_color = $icon_background_color = $icon_hover_background_color = $general_class = $line_height_height = $line_height_ofset = $line_height = '';
$a_style = $a_before_style = $i_style = $i_before_style = $customizable_hover_colors = $sliding_direction = $icon_style_html = $border_color = '';
$animation_data = $prefix_html = $sufix_html = '';

$atts = vc_map_get_attributes('dfd_social_accounts', $atts);
extract( $atts );

$uniqid = uniqid('dfd-soc-icon-').'-'.rand(1,9999);

if (!($module_animation == '')) {
	$el_class        .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}
$el_class .= ' '.esc_attr($info_alignment).' '.esc_attr($main_style);

if(isset($main_style) && strcmp($main_style, 'style-1') == 0 || strcmp($main_style, 'style-2') == 0 || strcmp($main_style, 'style-7') == 0) {
	$el_class .= ' '.esc_attr($sliding_direction);
}
if(isset($standard_icon_color) && strcmp($standard_icon_color, 'standard_color') == 0) {
	$el_class .= ' standard-color';
}
if(isset($icon_font_size) && !empty($icon_font_size)) {
	$a_style .= 'font-size: '.esc_attr($icon_font_size).'px; ';
	$line_height_height = esc_attr($icon_font_size) * 2.5;
}else{
	$line_height_height = 50;
}
if(isset($border_radius) && !empty($border_radius)) {
	$a_style .= 'border-radius: '.esc_attr($border_radius).'px; ';
}
if(is_rtl()){
	if(isset($icon_margin) && !empty($icon_margin)) {
		$a_style .= 'margin-left: '.esc_attr($icon_margin).'px; ';
		if(isset($main_style) && strcmp($main_style, 'style-7') == 0) {
			$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon .container-3d {margin-left: '.esc_attr($icon_margin).'px;}';
		}
	}
}else{
	if(isset($icon_margin) && !empty($icon_margin)) {
		$a_style .= 'margin-right: '.esc_attr($icon_margin).'px; ';
		if(isset($main_style) && strcmp($main_style, 'style-7') == 0) {
			$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon .container-3d {margin-right: '.esc_attr($icon_margin).'px;}';
		}
	}
}
if(isset($icon_border) && strcmp($icon_border, 'ic_border') == 0) {
	$el_class .= ' with-border';
	if(isset($border_width) && !empty($border_width)) {
		$a_before_style .= 'border-width: '.esc_attr($border_width).'px; ';
		$line_height_ofset = esc_attr($border_width) * 2;
	}
	if(isset($border_color) && !empty($border_color)) {
		$link_css .= '#'.$uniqid.'.dfd-soc-icon a {border-color: '.esc_attr($border_color).'}';
	}
	$line_height = $line_height_height - $line_height_ofset;
	$a_before_style .= 'line-height: '.$line_height.'px; ';
}
if(isset($icon_color) && !empty($icon_color)) {
	$a_style .= 'color: '.esc_attr($icon_color).'; ';
}
if(isset($icon_background_color) && !empty($icon_background_color)) {
	if(isset($main_style) && strcmp($main_style, 'style-7') == 0) {
		$a_before_style .= 'background: '.esc_attr($icon_background_color).'; ';
	}else{
		$a_style .= 'background: '.esc_attr($icon_background_color).'; ';
	}
}
if(isset($customizable_hover_colors) && strcmp($customizable_hover_colors, 'custom_hover') == 0) {
	if(isset($icon_hover_color) && !empty($icon_hover_color)) {
		$i_style .= 'color: '.esc_attr($icon_hover_color).'; ';
		$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon.style-2 a:hover {color: '.esc_js($icon_hover_color).';}';
		$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon.style-3 a:hover:before {color: '.esc_js($icon_hover_color).';}';
		$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon.style-4 a:hover:before {color: '.esc_js($icon_hover_color).';}';
	}
	if(isset($icon_hover_background_color) && !empty($icon_hover_background_color)) {
		$i_style .= 'background: '.esc_js($icon_hover_background_color).'; ';
		$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon.style-3 a:hover:before {background: '.esc_js($icon_hover_background_color).'; border-color: '.esc_js($icon_hover_background_color).';}';
	}
}
if(isset($main_style) && strcmp($main_style, 'style-2') == 0 && empty($icon_hover_color)) {
	$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon.style-2 a:hover {color: #ffffff;}';
}
if(!empty($a_style)) {
	$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon a {'.$a_style.'}';
}
if(!empty($a_before_style)) {
	$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon a:before {'.$a_before_style.'}';
}
if(!empty($i_style)) {
	$link_css .= '#'.esc_js($uniqid).'.dfd-soc-icon a i {'.$i_style.'}';
}

if(isset($main_style) && strcmp($main_style, 'style-7') == 0) {
	$prefix_html = '<span class="container-3d">';
	$sufix_html = '</span>';
}

if(isset($dfd_social_networks) && !empty($dfd_social_networks) && function_exists('vc_param_group_parse_atts')) {
	$dfd_social_networks = (array) vc_param_group_parse_atts( $dfd_social_networks );

	$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-soc-icon '.esc_attr($el_class).'" '.$animation_data.'>';
		$output .= '<div class="soc-icon-container clearfix">';

			foreach($dfd_social_networks as $network) {
				
				$icon_style_html = $single_icon = $link_atts_url = $link_atts_title = $link_atts_target = $link_atts_rel = '';

				if(isset($network['dfd_social_networks_sel']) && isset($network['soc_url'])) {
					if(isset($network['dfd_social_networks_sel'])) {
						$single_icon = $network['dfd_social_networks_sel'];
					}
					if(isset($network['soc_url'])) {
						$link = vc_build_link($network['soc_url']);
					}
					if(isset($link['url']) && !empty($link['url'])) {
						$link_atts_url = 'href="'.esc_url($link['url']).'"';
					}
					if(isset($link['title']) && !empty($link['title'])) {
						$link_atts_title = 'title="'.esc_attr($link['title']).'"';
					}
					if(isset($link['target']) && !empty($link['target'])) {
						$link_atts_target = 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"';
					}
					if(isset($link['rel']) && !empty($link['rel'])) {
						$link_atts_rel = 'rel="'.esc_attr($link['rel']).'"';
					}

					$icon_style_html = '<i class="'.esc_attr($single_icon).'"></i>';

					$output .= $prefix_html.'<a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.' '.$link_atts_rel.' class="'.esc_attr($single_icon).'">'.$icon_style_html.'</a>'.$sufix_html;
				}
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
}

echo $output;