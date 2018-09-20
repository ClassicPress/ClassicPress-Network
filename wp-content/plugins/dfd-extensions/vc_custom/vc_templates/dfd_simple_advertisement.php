<?php
if (!defined('ABSPATH')) {exit;}

$output = $style = $image = $image_html = $el_class = $css_rules = $title_font_options = $subtitle_font_options = $info_font_options = $use_google_fonts_title = '';
$custom_fonts_title = $use_google_fonts_subtitle = $custom_fonts_subtitle = $title_html = $subtitle_html = $link = $portfolio_hover_enable = $style_box = '';
$portfolio_hover_mask_color = $hover_style_html = $hover_effect_classes = $info_block_background_color = $image_effect = $shadow_class = '';
$info_html = $use_google_fonts_info = $custom_fonts_info = $img_width = $img_height = $animation_data = $link_title = $link_rel = $link_target = $shadow = $sa_box_shadow = '';
$info_block_border_radius = $info_text_transform = $info_block_left_right_padding = '';

$atts = vc_map_get_attributes('dfd_simple_advertisement', $atts);
extract($atts);

$uniqid = uniqid('dfd-simple_adv-');
 
if (!( $module_animation == '' )) {
	$el_class .= ' cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}
/* * ************************
 * Image HTML.
 * *********************** */
$img_width = $img_width ? $img_width : 400;
$img_height = $img_height ? $img_height : 350;

if (!empty($image)) {
	$image_src = wp_get_attachment_image_src($image, 'full');
	$image_url = dfd_aq_resize($image_src[0], $img_width, $img_height, true, true, true);
	if(!$image_url) {
		$image_url = $image_src[0];
	}
} else {
	$image_url = Dfd_Theme_Helpers::default_noimage_url("rect_med_300");
}

$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_url, $image, $img_width, $img_height, esc_html__('Banner image', 'dfd-native'));

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$el_class .= ' dfd-img-lazy-load ';
	$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $img_width $img_height'%2F%3E";
	$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($image_url).'" width="'.esc_attr(floor($img_width)).'" height="'.esc_attr(floor($img_height)).'" class="simple-banner-image" '.$img_atts.' />';
} else {
	$img_html = '<img src="'.esc_url($image_url).'" width="'.esc_attr(floor($img_width)).'" height="'.esc_attr(floor($img_height)).'" class="simple-banner-image" '.$img_atts.' />';
}

$image_html .=  '<div class="image-cover">'
					. '<span class="img_wrapper">'
						. $img_html
					. '</span>'
				. '</div>';

/* * ************************
 * Title / Subtitle HTML.
 * *********************** */
if (!empty($title)) {
	// Title name HTML.
	$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'feature-title', $use_google_fonts_title, $custom_fonts_title);
	$title_html .= '<'.$title_options['tag'].' class="box-title '.$title_options['class'].'" '.$title_options['style'].'>'.(strip_tags($title, "<br>")).'</'.$title_options['tag'].'>';
}

// Subtitle HTML.
if (!empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle', $use_google_fonts_subtitle, $custom_fonts_subtitle);
	$subtitle_html .= '<'.$subtitle_options['tag'].' class="box-subtitle '.$subtitle_options['class'].'" '.$subtitle_options['style'].'>'.esc_html($subtitle).'</'.$subtitle_options['tag'].'>';
}

/* * ************************
 * Info HTML.
 * *********************** */
if (!empty($info)) {
	$content_font_options = _dfd_parse_text_shortcode_params($info_font_options, 'info', $use_google_fonts_info, $custom_fonts_info);
	$content_style = $content_font_options['style'];
	if (!empty($info_block_background_color)) {
		$content_style_bg = 'background-color: '.esc_attr($info_block_background_color).';';
		if (empty($content_style)) {
			$content_style .= "style='".$content_style_bg."'";
		} else {
			$content_style[strlen($content_style) - 1] = " ";
			$content_style .= $content_style_bg . "\"";
		}
	}

	$info_html .= '<'.$content_font_options['tag'].' class="box-info" '.$content_style.'>'.esc_html($info).'</'.$content_font_options['tag'].'>';
}

/**
 *  Link
 */
if (trim($link) != "") {
	$link = vc_build_link($link);
	if (!empty($link['url'])) {
		$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
		$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
		$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
		$link = '<a href="'.$link['url'].'" '.$link_title.' '.$link_target.' '.$link_rel.' class="full-box-link"></a>';
	} else {
		$link = "";
	}
}

/**
 *  Shadow
 */
if(substr_count($sa_box_shadow, 'disable') == 0) {
	$sa_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($sa_box_shadow);
}
if(isset($shadow) && $shadow =='permanent') {
	$shadow_class = esc_attr($shadow);
	$css_rules .= '#'.esc_js($uniqid).'.dfd-simple-advertisement .cover.permanent:before {'.esc_attr($sa_box_shadow).'}';
} elseif(isset($shadow) && $shadow =='on-hover') {
	$shadow_class = esc_attr($shadow);
	$css_rules .= '#'.esc_js($uniqid).'.dfd-simple-advertisement:hover .cover.on-hover:before {'.esc_attr($sa_box_shadow).'}';
}

$hover_style_html .= '<div class="entry-thumb"><div class="entry-hover"></div></div>';

if ('panr' === $image_effect) {
	wp_enqueue_script('dfd-tween-max');
}

$el_class .= ' '.$image_effect;

$hover_effect_classes .= $portfolio_hover_enable == "on" ? " hover_enable " : " ";

$hover_effect_classes .= $portfolio_hover_appear_effect ? $portfolio_hover_appear_effect : " ";

/* Title responsive css */
if (isset($title_responsive) && $title_responsive != '') {
	$css_rules .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#' . esc_js($uniqid) . '.dfd-simple-advertisement .box-title');
}

if (isset($portfolio_hover_mask_color) && $portfolio_hover_mask_color != '') {
	$css_rules .= '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .title-wrap h3.entry-title,'
			   . '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .title-wrap .entry-subtitle.dfd-content-subtitle,'
			   . '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .dfd-hover-buttons-wrap {color: ' . esc_js($portfolio_hover_mask_color) . ';}';

	$css_rules .= '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .title-wrap.diagonal-line:before,'
			   . '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .title-wrap.title-underline h3.entry-title:before,'
			   . '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .title-wrap.square-behind-heading:before { border-color: ' . Dfd_Theme_Helpers::dfd_hex2rgb($portfolio_hover_mask_color, .1) . ';}';

	$css_rules .= '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .dfd-hover-buttons-wrap > *:hover:after {background: ' . Dfd_Theme_Helpers::dfd_hex2rgb($portfolio_hover_mask_color, .15) . ';}';

	$css_rules .= '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-out,'
			   . '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover .plus-link .plus-link-container .plus-link-come,'
			   . '#' . esc_js($uniqid) . ' .entry-thumb:hover .entry-hover .dfd-dots-link span { background: ' . esc_js($portfolio_hover_mask_color) . ' !important;}';
}

if (isset($portfolio_hover_mask_background_opacity) && $portfolio_hover_mask_background_opacity != '') {
	$css_rules .= '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover:before,'
			   . '#' . esc_js($uniqid) . ' .dfd-3d-parallax:hover .cover .thumb-wrap:before {'
				   . 'opacity: ' . (int) $portfolio_hover_mask_background_opacity / 100 . ' !important;'
			   . '}';
}

if(isset($info_block_border_radius) && $info_block_border_radius != '') {
	$css_rules .= '#'.esc_js($uniqid).' .box-info {border-radius: '.esc_js($info_block_border_radius).'px;}';
}
if(isset($info_text_transform) && !empty($info_text_transform)) {
	$css_rules .= '#'.esc_js($uniqid).' .box-info {text-transform: '.esc_js($info_text_transform).';}';
}
if(isset($info_block_left_right_padding) && $info_block_left_right_padding != '') {
	$css_rules .= '#'.esc_js($uniqid).' .box-info {padding: 0 '.esc_js($info_block_left_right_padding).'px;}';
}

if (isset($portfolio_hover_mask_background_style) && $portfolio_hover_mask_background_style != '') {
	switch ($portfolio_hover_mask_background_style) {
		case 'gradient':
			if (isset($portfolio_hover_mask_bg_start_color) && $portfolio_hover_mask_bg_start_color != '' && isset($portfolio_hover_mask_bg_end_color) && $portfolio_hover_mask_bg_end_color != '') {
				$css_rules .= '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover:before,'
						   . '#' . esc_js($uniqid) . ' .dfd-3d-parallax:hover .cover .thumb-wrap:before {'
							   . 'background: -webkit-linear-gradient(left, ' . esc_js($portfolio_hover_mask_bg_start_color) . ',' . esc_js($portfolio_hover_mask_bg_end_color) . ') !important;'
							   . 'background: -moz-linear-gradient(left, ' . esc_js($portfolio_hover_mask_bg_start_color) . ',' . esc_js($portfolio_hover_mask_bg_end_color) . ') !important;'
							   . 'background: -o-linear-gradient(left, ' . esc_js($portfolio_hover_mask_bg_start_color) . ',' . esc_js($portfolio_hover_mask_bg_end_color) . ') !important;'
							   . 'background: -ms-linear-gradient(left, ' . esc_js($portfolio_hover_mask_bg_start_color) . ',' . esc_js($portfolio_hover_mask_bg_end_color) . ') !important;'
							   . 'background: linear-gradient(left, ' . esc_js($portfolio_hover_mask_bg_start_color) . ',' . esc_js($portfolio_hover_mask_bg_end_color) . ') !important;'
						   . '}';
			}
			break;
		case 'simple-color':
		default:
			if (isset($portfolio_hover_mask_background) && $portfolio_hover_mask_background != '') {
				$css_rules .= '#' . esc_js($uniqid) . ' .entry-thumb .entry-hover:before,'
						   . '#' . esc_js($uniqid) . ' .dfd-3d-parallax:hover .cover .thumb-wrap:before {'
							   . 'background: ' . esc_js($portfolio_hover_mask_background) . ' !important;'
						   . '}';
			}
			break;
	}
}

$output = '<div id="' . $uniqid . '" class="dfd-simple-advertisement ' . $hover_effect_classes . ' ' . esc_attr($style) . ' ' . esc_attr($el_class) . '" ' . $animation_data . ' ' . $style_box . '>';
	$output .= '<div class="cover '.$shadow_class.'">';
		$output .= '<div class="image-wrap">';
			$output .= $link;
			$output .= '<div class="content-wrap">';
				$output .= '<div class="content-level2">';
					$output .= '<div class="content-level3">';
						$output .= $subtitle_html;
						$output .= $title_html;
						$output .= $info_html;
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
			$output .= $image_html;
			$output .= $portfolio_hover_enable == "on" ? $hover_style_html : "";
		$output .= '</div>';
	$output .= '</div>';

	if ($css_rules != '') {
		$output .=  '<script type="text/javascript">'
						.'(function($) {'
							.'$("head").append("<style>'.$css_rules.'</style>");'
						.'})(jQuery);'
					.'</script>';
	}
$output .='</div>';

echo $output;