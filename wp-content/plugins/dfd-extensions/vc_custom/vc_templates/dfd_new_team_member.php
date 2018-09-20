<?php
if (!defined('ABSPATH')) {
	exit;
}

$main_layout = $image_style = $thumb_radius = $gradient_color1 = $gradient_color2 = $soc_icons_hover = $output = $gradient_style = $shadow_class = $module_animation = '';
$team_member_photo = $team_member_img_width = $team_member_img_height = $team_member_name = $team_member_job_position = $team_member_description = $el_class = '';
$title_font_options = $subtitle_font_options = $icon_size = $icon_color = $show_overlay = $overlay_output = $font_options = $use_google_fonts = $custom_fonts = '';
$shadow = $shadow_style = $enable_custom_link = $apply_link_to = $custtom_link_url = $align = $image_output = $title_html = $subtitle_html = $content_output = $open_soc_custom_link = $soc_link_target = '';

$soc_network_options = array ();

foreach (Dfd_Theme_Helpers::social_networks() as $key => $value) {
	$soc_network_options[$key] = '';
}

extract(shortcode_atts(array_merge(array (
	'main_layout' => 'layout-11',
	'gradient_color1' => '',
	'gradient_color21' => '',
	'gradient_color2' => '',
	'gradient_color22' => '',
	'team_member_photo' => '',
	'team_member_img_width' => '400',
	'team_member_img_height' => '400',
	'team_member_name' => esc_html__('Title', 'dfd-native'),
	'team_member_job_position' => esc_html__('Subtitle', 'dfd-native'),
	'team_member_description' => esc_html__('Description', 'dfd-native'),
	'enable_custom_link' => '',
	'apply_link_to' => 'image-link',
	'custtom_link_url' => '',
	'title_font_options' => '',
	'subtitle_font_options' => '',
	'font_options' => '',
	'use_google_fonts' => '',
	'icon_color' => '',
	'icon_size' => '',
	'custom_fonts' => '',
	'align' => '',
	'show_overlay' => 'show',
	'show_overlay2' => 'show',
	'soc_icons_hover' => '1',
	'thumb_radius' => '',
	'shadow' => '',
	'shadow_style' => 'permanent',
	'module_animation' => '',
	'el_class' => '',
	'open_soc_custom_link' => 'new_tab',
), $soc_network_options), $atts));

$images_lazy_load = false;

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$images_lazy_load = true;
	$el_class .= ' dfd-img-lazy-load ';
	$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $team_member_img_width $team_member_img_height'%2F%3E";
}

/* * ************************
 * Appear Animation
 * *********************** */

$animation_data = '';

if (!( $module_animation == '' )) {
	$el_class .= ' cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

/* * ************************
 * Social icons.
 * *********************** */

if ($enable_custom_link) {
	$link = vc_build_link($custtom_link_url);
	$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
	$link_title = !empty($link['title']) ? 'title="' . esc_attr($link['title']) . '"' : '';
	$link_target = !empty($link['target']) ? 'target="' . esc_attr(preg_replace('/\s+/', '', $link['target'])) . '"' : '';
} else {
	$link = array ();
	$link_title = $link_target = $link_rel = '';
}

$soc_icons_hover_style = 'dfd-soc-icons-hover-style-' . esc_attr($soc_icons_hover);

$soc_networks_output = "";

$icon_style = " style='";
if ($icon_color) {
	$icon_style.= ' color:' . esc_attr($icon_color) . '; ';
}
if ($icon_size) {
	$icon_style.= ' font-size:' . esc_attr($icon_size) . 'px; ';
}
$icon_style.="'";
$has_one = false;
$soc_networks_list = "";


if (isset($open_soc_custom_link) && $open_soc_custom_link == 'new_tab') {
	$soc_link_target = 'target="_blank"';
}

foreach (Dfd_Theme_Helpers::social_networks() as $soc_network => $soc_name) {
	if (isset(${$soc_network}) && !empty(${$soc_network})) {
		$has_one = true;
		$soc_networks_list .= '<a href="' . ${$soc_network} . '" class="' . esc_attr($soc_name['icon']) . '" '.esc_attr($soc_link_target).'><span class="line-top-left ' . esc_attr($soc_name['icon']) . '"></span><span class="line-top-center ' . esc_attr($soc_name['icon']) . '"></span><span class="line-top-right ' . esc_attr($soc_name['icon']) . '"></span><span class="line-bottom-left ' . esc_attr($soc_name['icon']) . '"></span><span class="line-bottom-center ' . esc_attr($soc_name['icon']) . '"></span><span class="line-bottom-right ' . esc_attr($soc_name['icon']) . '"></span><i class="' . esc_attr($soc_name['icon']) . '" ' . $icon_style . ' ></i></a>';
	}
}
if ($has_one) {
	$soc_networks_output = '<div class="widget soc-icons ' . $soc_icons_hover_style . '">';
	$soc_networks_output .= $soc_networks_list;
	$soc_networks_output .= '</div>';
}

/* * ************************
 * Title / Subtitle HTML.
 * *********************** */
if (!empty($team_member_name)) {
	// Title name HTML.
	$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts);
	$title_html = '<' . $title_options['tag'] . ' class="team-member-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>';
	if ($enable_custom_link && ('title-link' === $apply_link_to) || $enable_custom_link && ('both-title-and-image' === $apply_link_to)) {
		$title_html .= '<a href="' . $link['url'] . '" '.$link_title.' '.$link_target.' '.$link_rel.'>';
		$title_html .= esc_html($team_member_name);
		$title_html .= '</a>';
	} else {
		$title_html .= esc_html($team_member_name);
	}

	$title_html .= '</' . $title_options['tag'] . '>';
}

// Subtitle HTML.
if (!empty($team_member_job_position)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle');
	$subtitle_html = '<' . $subtitle_options['tag'] . ' class="team-member-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html($team_member_job_position) . '</' . $subtitle_options['tag'] . '>';
}

/* * ************************
 * Other Block options.
 * *********************** */

if ('show' === $shadow) {
	if ('hover' === $shadow_style) {
		$shadow_class .= ' module-shadow-hover ';
	} else {
		$shadow_class .= ' module-shadow-permanent ';
	}
}

//content HTML
if (!empty($team_member_description)) {
	$content_font_options = _dfd_parse_text_shortcode_params($font_options, '');
	$content_style = $content_font_options['style'];
	$content_output = '<div class="team-member-description" ' . $content_style . '>' . $team_member_description . '</div>';
}else{
	if($has_one && ('layout-18' === $main_layout || 'layout-19' === $main_layout)){
		$content_output = '<div class="team-member-description" style="margin-top:12px;"> </div>';
	}else{
		$content_output = "";
	}
}

if (!empty($thumb_radius)) {
	$image_style .= 'style="border-radius:' . $thumb_radius . 'px"';
}

$shadow_block = "<div class='shadow-block' " . $image_style . "></div>";

if (isset($team_member_photo) && !( $team_member_photo == '' )) {
	$image_src = wp_get_attachment_image_src($team_member_photo, 'full');
	$image_url = dfd_aq_resize($image_src[0], $team_member_img_width, $team_member_img_height, true, true, true);
	if (!$image_url)
		$image_url = $image_src[0];
}else {
	$image_url = Dfd_Theme_Helpers::default_noimage_url("rect_med_300");
}

$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_url, $team_member_photo, $team_member_img_width, $team_member_img_height, esc_attr__('Team member','dfd-native'));

if($images_lazy_load) {
	$image_output = '<img src="'.$loading_img_src.'" data-src="' . esc_url($image_url) . '" class="team-member-photo ' . $shadow_class . '" '.$img_atts.' ' . $image_style . ' />';
} else {
	$image_output = '<img src="' . esc_url($image_url) . '" class="team-member-photo ' . $shadow_class . '" '.$img_atts.' ' . $image_style . ' />';
}

if ($main_layout == "layout-18" || $main_layout == "layout-19") {
	$gradient_color1 = $gradient_color21;
	$gradient_color2 = $gradient_color22;
}
if (!empty($gradient_color1) || !empty($gradient_color2) || !empty($thumb_radius)) {

	$gradient_style .= 'style="';

	if (isset($gradient_color1) && !empty($gradient_color1) && isset($gradient_color2) && !empty($gradient_color2)) {
		$gradient_style .= 'background: linear-gradient(to bottom, ' . $gradient_color1 . ', ' . $gradient_color2 . ');';
	} elseif (isset($gradient_color1) && !empty($gradient_color1) || isset($gradient_color2) && !empty($gradient_color2)) {
		if (isset($gradient_color1) && !empty($gradient_color1)) {
			$gradient_style .= 'background-color:' . $gradient_color1 . ';';
		} elseif (isset($gradient_color2) && !empty($gradient_color2)) {
			$gradient_style .= 'background-color:' . $gradient_color2 . ';';
		}
	}
	if (!empty($thumb_radius)) {
		$gradient_style .= ' border-radius:' . $thumb_radius . 'px;';
	}

	$gradient_style .= '"';
}

if (
   'layout-13' === $main_layout ||
   'layout-17' === $main_layout ||
   'layout-18' === $main_layout ||
   'layout-19' === $main_layout) {
	$overlay_output .= '<div class="overlay" ' . $gradient_style . '></div>';
}
$show_overlay = $show_overlay == "show" ? "show_overlay" : "";
$show_overlay2 = $show_overlay2 == "show" ? "show_overlay2" : "";
if ($enable_custom_link && ('image-link' === $apply_link_to) || $enable_custom_link && ('both-title-and-image' === $apply_link_to)) {

	$overlay_output .= '<a class="image-custom-link" href="'.$link['url'].'" '.$link_title.' '.$link_target.' '.$link_rel.'></a>';
}

$output .= '<div class="dfd-team-member ' . $main_layout . ' ' . $show_overlay . ' ' . $show_overlay2 . ' ' . $align . ' ' . $el_class . '" ' . $animation_data . '>';
switch ($main_layout) {
	case 'layout-11':
		$output .= '<div class="image-wrap ' . $shadow_class . '">';
		$output .= $shadow_block;
		$output .= '<span class="overlay_wrap">';
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= '</span>';
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		break;
	case 'layout-14':
		$output .= '<div class="content-wrap">';
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		$output .= '<div class="image-wrap ' . $shadow_class . '" style="width:' . $team_member_img_width . 'px;">';
		$output .= '<span class="overlay_wrap">';
		$output .= $shadow_block;
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= '</span>';
		$output .= '</div>';

		break;
	case 'layout-15':
		$output .= '<div class="image-wrap ' . $shadow_class . '" style="width:' . $team_member_img_width . 'px;">';
		$output .= '<span class="overlay_wrap">';
		$output .= $shadow_block;
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= '</span>';
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';

		break;
	case 'layout-12':
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= '<div class="image-wrap ' . $shadow_class . '">';
		$output .= $shadow_block;
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		break;
	case 'layout-13':
		$output .= '<div class="image-wrap ' . $shadow_class . '">';
		$output .= $shadow_block;
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		break;
	case 'layout-16':
		$output .= '<div class="image-wrap ' . $shadow_class . '">';
		$output .= $shadow_block;
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= '</div>';
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		break;
	case 'layout-17':
		$output .= '<div class="image-wrap ' . $shadow_class . '">';
		$output .= $shadow_block;
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		break;
	case 'layout-18':
	case 'layout-19':
		$output .= '<div class="image-wrap ' . $shadow_class . '">';
		$output .= $shadow_block;
		$output .= "<span class='wrap_img'>";
		$output .= $image_output;
		$output .= $overlay_output;
		$output .= "</span>";
		$output .= '<div class="title-wrap level_one">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		$output .= '<div class="ovh">';
		$output .= $overlay_output;
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= $content_output;
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
		$output .= '<div class="title-wrap">';
		$output .= $title_html;
		$output .= $subtitle_html;
		$output .= '</div>';
		$output .= $content_output;
		$output .= $soc_networks_output;
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		break;

	default:
		break;
}

$output .= '</div>';

echo $output;