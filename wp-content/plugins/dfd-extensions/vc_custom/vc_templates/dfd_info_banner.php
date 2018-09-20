<?php
if (!defined('ABSPATH')) {exit;}

$style = $title = $subtitle = $image = $image_hover = $img_width = $img_height = $more_show = $readmore_style = $readmore_text = $read_more = $link = $content_alignment = '';
$shadow = $shadow_style = $el_class = $output = $module_animation = $thumb_radius = $link_css = $box_shadow = $hover_box_shadow = $image_effect = $show_number_block = '';
$title_font_options = $subtitle_font_options = $font_options = $use_google_fonts = $custom_fonts = $link_rel = $link_target = $link_title = $n_b_background_color = '';
$title_html = $subtitle_html = $image_html = $banner_content = $content = $content_html = $read_more_html = $shadow_class = $overlay_output = $n_b_text_color = '';
$n_b_number = $number_block = $animation_data = $n_b_number_size = '';

$atts = vc_map_get_attributes( 'dfd_info_banner', $atts );
extract( $atts );

$images_lazy_load = false;

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$images_lazy_load = true;
	$el_class .= ' dfd-img-lazy-load ';
	$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $img_width $img_height'%2F%3E";
	
}

if (empty($title) && empty($subtitle) && empty($banner_content)) {
	$el_class .= ' no_content';
}

$uniqid = uniqid('dfd-info-banner-').'-'.rand(1,9999);

if (!( $module_animation == '' )) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

/* * ************************
 * Shadow options.
 * *********************** */

if (isset($shadow) && ( 'show' === $shadow )) {
	if (isset($shadow_style) && ( 'hover' === $shadow_style )) {
		$shadow_class .= ' module-shadow-hover';
		if(substr_count($hover_box_shadow, 'disable') == 0) {
			$hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
			$link_css .= '#'.esc_js($uniqid).':hover .module-shadow-hover {'.esc_attr($hover_box_shadow).'}';
		}
	} else {
		$shadow_class .= ' module-shadow-permanent';
		if(substr_count($box_shadow, 'disable') == 0) {
			$box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
			$link_css .= '#'.esc_js($uniqid).' .module-shadow-permanent {'.esc_attr($box_shadow).'}';
		}
	}
}

/* * ************************
 * Title / Subtitle HTML.
 * *********************** */
if (!empty($title)) {
	$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
	if ($link && 'title' === $read_more) {
		$link = vc_build_link($link);
		$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
		$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
		$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
		$title_html .= '<' . $title_options['tag'] . ' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '><a href="'.$link['url'].'" '.$link_title.' '.$link_rel.' '.$link_target.'>' . esc_html($title) . '</a></' . $title_options['tag'] . '>';
	} else {
		$title_html .= '<' . $title_options['tag'] . ' class="info-box-title no_hover ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html($title) . '</' . $title_options['tag'] . '>';
	}
}

if (!empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
	$subtitle_html .= '<' . $subtitle_options['tag'] . ' class="info-box-subtitle widget-sub-title ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html($subtitle) . '</' . $subtitle_options['tag'] . '>';
}

/* * ************************
 * Block width number.
 * *********************** */
if ($show_number_block == 'show' && isset($n_b_number) && !empty($n_b_number)) {
	$el_class .= ' show-banner-number';
	$number_block = '<span class="number_block">'.$n_b_number.'</span>';
	if(isset($n_b_number_size) && $n_b_number_size != '') {
		$link_css .= '#'.esc_js($uniqid).' .number_block {font-size: '.esc_js($n_b_number_size).'px;}';
	}
	if(isset($n_b_background_color) && !empty($n_b_background_color)) {
		$link_css .= '#'.esc_js($uniqid).' .number_block {background-color: '.esc_js($n_b_background_color).';}';
	}
	if(isset($n_b_text_color) && !empty($n_b_text_color)) {
		$link_css .= '#'.esc_js($uniqid).' .number_block {color: '.esc_js($n_b_text_color).';}';
	}
}

/* * ************************
 * Image.
 * *********************** */
if (!empty($thumb_radius)) {
	$image_style = 'style="border-radius:' . $thumb_radius . 'px"';
	$link_css .= '#'.esc_js($uniqid).'.style-29 .title-wrap:before, #'.esc_js($uniqid).'.style-28 .shadow_ov {border-bottom-left-radius: '.esc_js($thumb_radius).'px; border-bottom-right-radius: '.esc_js($thumb_radius).'px;}';
} else {
	$image_style = '';
}

if (!empty($image)) {
	$image_src = wp_get_attachment_image_src($image, 'full');
	$image_url = dfd_aq_resize($image_src[0], $img_width, $img_height, true, true, true);
	if (!$image_url) {
		$image_url = $image_src[0];
	}
} else {
	$image_url = Dfd_Theme_Helpers::default_noimage_url("rect_med_300");
}

$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_url, $image, $img_width, $img_height, esc_attr__('Banner image','dfd-native'));

/**
 * Hover Image style
 */
$image_html_hover = "";
$has_hover_img = "";
if (!empty($image_hover)) {
	$image_src_hover = wp_get_attachment_image_src($image_hover, 'full');
	$image_url_hover = dfd_aq_resize($image_src_hover[0], $img_width, $img_height, true, true, true);
	if (!$image_url_hover) {
		$image_url_hover = $image_src_hover[0];
	}
	$atts_hover = Dfd_Theme_Helpers::get_image_attrs($image_src_hover[0], $image_hover, $img_width, $img_height, esc_attr__('Banner image','dfd-native'));
	
	$has_hover_img = "has_hover_img";
	if($images_lazy_load) {
		$image_html_hover = '<img src="'.$loading_img_src.'" data-src="' . esc_url($image_url_hover) . '" class="info-banner-image image_hover" '.$atts_hover.' ' . $image_style . '/>';
	} else {
		$image_html_hover = '<img src="' . esc_url($image_url_hover) . '" class="info-banner-image image_hover" '.$atts_hover.' ' . $image_style . '/>';
	}
}

if($images_lazy_load) {
	$image_html .= '<div class="image-cover"><span class="img_wrapper ' . esc_attr($shadow_class) . '" ' . $image_style . '><span class="shadow_ov_wrapper"><span class="shadow_ov"></span></span>' . $number_block . '<span class="img_overflow"><img src="'.$loading_img_src.'" data-src="' . esc_url($image_url) . '" '.$img_atts.' class="info-banner-image  ' . $has_hover_img . '" ' . $image_style . '/>' . $image_html_hover . '</span></span></div>';
} else {
	$image_html .= '<div class="image-cover"><span class="img_wrapper ' . esc_attr($shadow_class) . '" ' . $image_style . '><span class="shadow_ov_wrapper"><span class="shadow_ov"></span></span>' . $number_block . '<span class="img_overflow"><img src="' . esc_url($image_url) . '" '.$img_atts.' class="info-banner-image  ' . $has_hover_img . '" ' . $image_style . '/>' . $image_html_hover . '</span></span></div>';
}

if (!empty($gradient_color1) || !empty($gradient_color2) || !empty($thumb_radius)) {

	$gradient_style = 'style="';

	if (!empty($gradient_color1) && !empty($gradient_color2)) {
		$gradient_style .= 'background: linear-gradient(to bottom, ' . $gradient_color1 . ', ' . $gradient_color2 . ');';
		$link_css .= '#'.esc_js($uniqid).'.style-28 .shadow_ov {display: none;}';
	} elseif (!empty($gradient_color1) || !empty($gradient_color2)) {
		$link_css .= '#'.esc_js($uniqid).'.style-28 .shadow_ov {display: none;}';
		if (!empty($gradient_color1)) {
			$gradient_style .= 'background:' . $gradient_color1 . ';';
		} elseif (!empty($gradient_color2)) {
			$gradient_style .= 'background:' . $gradient_color2 . ';';
		}
	}
	if (!empty($thumb_radius)) {
		$gradient_style .= ' border-radius:' . $thumb_radius . 'px;';
	}

	$gradient_style .= '"';
} else {
	$gradient_style = '';
}
$overlay_output = '<div class="overlay" ' . $gradient_style . '></div>';

/* * ************************
 * Content HTML.
 * *********************** */
if (!empty($banner_content)) {
	$content_font_options = _dfd_parse_text_shortcode_params($font_options, '');
	$content_style = $content_font_options['style'];
	$content_html .= '<div class="description" ' . $content_style . '>' . $banner_content . '</div>';
}

$read_more_html .= dfd_module_read_more($atts);

/* * ************************
 * Hover styles.
 * *********************** */
if ('hover' === $more_show) {
	$el_class .= ' more-hover';
}

if ('' != $image_effect) {
	$el_class .= ' '.$image_effect;
}

if ('' != $content_alignment) {
	$el_class .= ' '.$content_alignment;
}

$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-info-banner ' . esc_attr($style) . ' ' . esc_attr($el_class) . '" ' . $animation_data . '>';

	switch ($style) {
		case 'style-21':
			$output .= $image_html;
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $content_html;
			$output .= $read_more_html;
			break;
		case 'style-22':
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $image_html;
			$output .= '<div class="content-wrap">';
			$output .= $content_html;
			$output .= $read_more_html;
			$output .= '</div>';
			break;
		case 'style-23':
			$output .= '<div class="image-wrap">';
			$output .= $image_html;
			$output .= $overlay_output;
			$output .= '<div class="title-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= '</div>';
			$output .= '</div>';
			$output .= $content_html;
			$output .= $read_more_html;
			break;
		case 'style-24':
			$output .= '<div class="image-wrap">';
			$output .= $image_html;
			$output .= $overlay_output;
			$output .= '<div class="content-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= '</div>';
			$output .= '</div>';
			$output .= $content_html;
			$output .= $read_more_html;
			break;
		case 'style-25':
			$output .= '<div class="image-wrap">';
			$output .= $image_html;
			$output .= $overlay_output;
			$output .= '<div class="content-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $content_html;
			$output .= '</div>';
			$output .= '</div>';
			$output .= $read_more_html;
			break;
		case 'style-26':
			$output .= $image_html;
			$output .= '<div class="content-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $content_html;
			$output .= $read_more_html;
			$output .= '</div>';
			break;
		case 'style-27':
			$output .= '<div class="content-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $content_html;
			$output .= $read_more_html;
			$output .= '</div>';
			$output .= $image_html;
			break;
		case 'style-28':
			$output .= '<div class="image-wrap">';
			$output .= $image_html;
			$output .= $overlay_output;
			$output .= '<div class="title-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="content-wrap">';
			$output .= $content_html;
			$output .= $read_more_html;
			$output .= '</div>';
			break;
		case 'style-29':
			$output .= '<div class="image-wrap">';
			$output .= $image_html;
			$output .= $overlay_output;
			$output .= '<div class="title-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="content-wrap">';
			$output .= $content_html;
			$output .= $read_more_html;
			$output .= '</div>';
			break;
		case 'style-30':
			$output .= '<div class="image-wrap">';
			$output .= $image_html;
			$output .= $overlay_output;
			$output .= '<div class="content-wrap">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $content_html;
			$output .= '</div>';
			$output .= '</div>';
			$output .= $read_more_html;
			break;
		case 'style-31':
			$output .= $image_html;
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $content_html;
			$output .= $read_more_html;
			break;

		default:
			$output .= $image_html;
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= $content_html;
			$output .= $read_more_html;
	}

	if ($link && 'box' === $read_more) {
		$link = vc_build_link($link);
		$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
		$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
		$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
		$output .= '<a href="'.$link['url'].'" class="full-box-link" '.$link_title.' '.$link_rel.' '.$link_target.'></a>';
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