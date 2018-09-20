<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$main_layout = $thumb_color = $line_width = $line_hide = $line_border = $line_color = $bg_block_color = $bg_radius = $quote_color = $align = $image = $author = '';
$subtitle = $description = $content_font_options = $use_google_fonts = $custom_fonts = $title_font_options = $subtitle_font_options = $thumb_radius = $thumb_size = '';
$thumb_border_width = $avatar_html = $avatar_style = $author_style = $subtitle_html = $subtitle_style = $content_style = $delimiter_html = $delimiter_style = $content_bg = '';
$bg_style = $quote_style = $quote_size = $quote_margin = $icon_html = $content_html = $output = $el_class = $use_google_fonts_testimonial = $use_google_fonts_subtitle = '';
$module_animation = $custom_fonts_testimonial = $custom_fonts_subtitle = $hide_shadow = $show_triangle = $css_rules = $title_subtitle_nowrap = '';

//new_testimonials

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$uniqid = uniqid('dfd-ttestimonials-module-');

if(!isset($main_layout) || $main_layout == '') {
	$main_layout = 'layout-1';
}
	
$el_class .= ' style-1 '.$main_layout;

if(isset($title_subtitle_nowrap) && $title_subtitle_nowrap == 'nowrap') {
	$el_class .= ' title-subtitle-nowrap';
}

if(!isset($align) || $align == '') {
	$align = 'align-center';
}

if(!isset($thumb_size) || $thumb_size == '') {
	$thumb_size = '90';
}

if($main_layout == 'layout-17' || $main_layout == 'layout-19') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-testimonial-item.has_bg.show_triangle.layout-17 .content-wrap-bg span.triangle,'
				. '#' . esc_js($uniqid) . '.dfd-testimonial-item.has_bg.show_triangle.layout-19 .content-wrap-bg span.triangle {right: '.esc_js( $thumb_size / 2 ).'px;}';
} elseif($main_layout == 'layout-18' || $main_layout == 'layout-20') {
	$css_rules .= '#' . esc_js($uniqid) . '.dfd-testimonial-item.has_bg.show_triangle.layout-18 .content-wrap-bg span.triangle,'
				. '#' . esc_js($uniqid) . '.dfd-testimonial-item.has_bg.show_triangle.layout-20 .content-wrap-bg span.triangle {left: '.esc_js( $thumb_size / 2 ).'px;}';
}

$show_triangle = $show_triangle == "show" ? true : false;
/* * ************************
 * Appear Animation
 * *********************** */

$animation_data = '';

if (!( $module_animation == '' )) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

// Create parts of module according to parameters.
// Avatar HTML.
if (!empty($image)) {
	$image_src = wp_get_attachment_image_src($image, 'full');
	$avatar = dfd_aq_resize($image_src[0], $thumb_size * 1.5, $thumb_size * 1.5, true, true, true);
	if(!$avatar) {
		$avatar = $image_src[0];
	}
} else {
	$avatar = Dfd_Theme_Helpers::default_noimage_url("rect_small_140");
}

if ((!empty($thumb_radius) ) || $thumb_radius!="" || (!empty($thumb_border_width) || $thumb_border_width!="" )) {
	$avatar_style .= 'style="';
	if ($thumb_radius!="") {
		$avatar_style .= 'border-radius:' . esc_html($thumb_radius) . 'px; ';
	}
	if ($thumb_border_width!="") {
		$avatar_style .= 'border:' . esc_html($thumb_border_width) . 'px solid ';
	}
	if ($thumb_color!="") {
		$avatar_style .= esc_html($thumb_color) . '; ';
	}
	$avatar_style .= '"';
}

$img_atts = Dfd_Theme_Helpers::get_image_attrs($avatar, $image, $thumb_size, $thumb_size, esc_html__('Testimonial', 'dfd-native') . ' ' . esc_html__('by', 'dfd-native') . ' ' . esc_html($author));

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$el_class .= ' dfd-img-lazy-load ';
	$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $thumb_size $thumb_size'%2F%3E";
	$img_html = '<img ' . $avatar_style . ' src="'.$loading_img_src.'" data-src="' . esc_url($avatar) . '" width="'.esc_attr(floor($thumb_size)).'" height="'.esc_attr(floor($thumb_size)).'" '.$img_atts.'/>';
} else {
	$img_html = '<img ' . $avatar_style . ' src="' . esc_url($avatar) . '" width="'.esc_attr(floor($thumb_size)).'" height="'.esc_attr(floor($thumb_size)).'" '. $img_atts .' />';
}

$avatar_html = '<div class="image-wrap">';
$avatar_html .= $img_html;
$avatar_html .= '</div>';

// Author name HTML.
$author_font_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
$author_style .= $author_font_options['style'];

$author_html = '<' . $author_font_options['tag'] . ' class="' . $author_font_options['class'] . ' testimonial-title" ' . $author_style . '>' . esc_html($author) . '</' . $author_font_options['tag'] . '>';

// Subtitle HTML.
if (!empty($subtitle)) {
	$subtitle_font_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle', $use_google_fonts_subtitle, $custom_fonts_subtitle);
	$subtitle_style .= $subtitle_font_options['style'];

	$subtitle_html = '<' . $subtitle_font_options['tag'] . ' class=" '.$subtitle_font_options['class'].' testimonial-subtitle" ' . $subtitle_style . '>' . esc_html($subtitle) . '</' . $subtitle_font_options['tag'] . '>';
}
// Content HTML.
$content_font_options = _dfd_parse_text_shortcode_params($content_font_options, 'dfd-testimonial-content', $use_google_fonts_testimonial, $custom_fonts_testimonial);
$content_style .= $content_font_options['style'];

if (!empty($bg_radius) || $bg_radius!="" || !empty($bg_block_color) || $bg_block_color!="") {
	$content_bg .= 'style="';
	if ($bg_radius !="") {
		$content_bg .= 'border-radius:' . $bg_radius . 'px;';
	}
	if ($bg_block_color!="") {
		$el_class .= ' has_bg';
		$css_rules .= '#' . esc_js($uniqid) . '.dfd-testimonial-item .content-wrap-bg,'
					. '#' . esc_js($uniqid) . '.dfd-testimonial-item .content-wrap-bg .triangle:before {background-color:' . $bg_block_color.';}';
	}
	$content_bg .= '"';
}

$content_html .= '<div class="content-wrap-bg" ' . $content_bg . '><span class="triangle hide"></span></div>';

$content_html .= '<div class="dfd-testimonial-content testimonial-content" ' . $content_style . '>';
$content_html .= strip_tags($description,"<br><br/>");
$content_html .= '</div>';
$hide_shadow = $hide_shadow ? "" : "hide_shadow";
$show_triangle = $show_triangle ? "show_triangle" : "";
if ($line_width || $line_border || $line_color) {
	$delimiter_style .= 'style="';
	if ($line_width) {
		$delimiter_style .= 'width:' . $line_width . 'px;';
	}
	if ($line_border) {
		$delimiter_style .= 'height:' . $line_border . 'px;';
	}
	if ($line_color) {
		$delimiter_style .= 'background:' . $line_color;
	}
	$delimiter_style .= '"';
}
if ('yes' !== $line_hide) {
	$delimiter_html .= '<div class="wrap-delimiter"><div class="testimonial-delimiter" ' . $delimiter_style . '></div></div>';
}

if ($quote_color || $quote_size || $quote_margin) {
	$quote_style .= 'style="';
	if (!empty($quote_color)) {
		$quote_style .= 'color:' . $quote_color . '; ';
	}
	if (!empty($quote_size)) {
		$quote_style .= 'font-size:' . $quote_size . 'px; ';
	}
	if (!empty($quote_margin)) {
		$quote_style .= 'margin-bottom:' . $quote_margin . 'px; display: inline-block;';
	}

	$quote_style .= '"';
}
//if ('yes' !== $quote_hide) {
//	$icon_html .= '<div class="icon-wrap">';
//	$icon_html .= '<i class="navicon-quote-right" ' . $quote_style . '></i>';
//	$icon_html .= '</div>';
//}
if ('layout-9' === $main_layout || 'layout-10' === $main_layout) {
	$align = '';
}

/*Title responsive css*/
if(isset($title_responsive) && $title_responsive != '') {
	$css_rules .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#' . esc_js($uniqid) . '.dfd-testimonial-item .dfd-testimonial-content');
}

/* * ************************
 * Module Generation.
 * *********************** */
$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-testimonial-item ' . $hide_shadow . ' '.$show_triangle. ' ' . $align . ' ' . $el_class . '" ' . $animation_data . '>';

switch ($main_layout) {
	case 'layout-11':

		$output .= '<div class="pos-rel">';
		$output .= $content_html;
		$output .= '</div>';
		$output .= $avatar_html;
		$output .= $author_html;
		$output .= $subtitle_html;
		break;
	case 'layout-12':
		$output .= $avatar_html;
		$output .= $author_html;
		$output .= $subtitle_html;
		$output .= '<div class="pos-rel">';
		$output .= $content_html;
		$output .= '</div>';
		break;
	case 'layout-13':
		$output .= $avatar_html;
		$output .= '<div class="pos-rel">';
		$output .= $content_html;
		$output .= '</div>';
		$output .= $author_html;
		$output .= $subtitle_html;
		break;
	case 'layout-14':
		$output .= '<div class="title-wrap">';
			$output .= $author_html;
			$output .= $subtitle_html;
		$output .= '</div>';
		$output .= '<div class="pos-rel">';
		$output .= $content_html;
		$output .= '</div>';
		$output .= $avatar_html;
		break;

	case 'layout-15':
	case 'layout-16':
		$output .= $avatar_html;
		$output .= '<div class="content-wrap">';
			$output .= '<div class="pos-rel">';
				$output .= $content_html;
			$output .= '</div>';
			$output .= '<div class="title-wrap">';
				$output .= $author_html;
				$output .= $subtitle_html;
			$output .= '</div>';
		$output .= '</div>';

		break;
	case 'layout-17':
	case 'layout-18':
		$output .= '<div class="pos-rel">';
		$output .= $content_html;
		$output .= '</div>';
		$output .= $avatar_html;
		$output .= $author_html;
		$output .= $subtitle_html;
		break;
	case 'layout-19':
	case 'layout-20':
		$output .= $avatar_html;
		$output .= '<div class="pos-rel">';
		$output .= $content_html;
		$output .= '</div>';
		$output .= $author_html;
		$output .= $subtitle_html;
		break;
}

if (!empty($css_rules)) {
	$output .= '<script type="text/javascript">'
					. '(function($) {'
						. '$("head").append("<style>'.$css_rules.'</style>");'
					. '})(jQuery);'
				. '</script>';
}

$output .= '</div>';

echo $output;
