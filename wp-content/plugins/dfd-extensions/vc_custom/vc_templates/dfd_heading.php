<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$front_template = 'vc_custom/templates/heading/';
$output = $title_html = $subtitle_html = $delimiter_html = $module_css = '';
$style = $subtitle = $enable_delimiter = $delimiter_settings = $title_font_options = $title_google_fonts = $title_custom_fonts = $subtitle_font_options = '';
$subtitle_google_fonts = $subtitle_custom_fonts = $module_animation = $el_class = $content_alignment = $heading_margin = $subheading_margin = '';
$delimiter_margin = $delimiter_style = $responsive_class = $icon = $padding_type='';

$atts = vc_map_get_attributes('dfd_heading', $atts);
extract($atts);

$animation_data = '';

$el_class .= ' ' . $content_alignment . ' ' . $style;

if (!($module_animation == '')) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

$uniqid = uniqid('dfd-heading-');

global $dfd_native;

/**
 * Padding
 */
switch ($style) {
	case "style_09":
		$padding_type = "padding-right:%el%px";
		break;
	case "style_07":
		$padding_type = "padding-left:%el%px";
		break;
	case "style_11":
		$padding_type = "padding:0px %el%px";
		break;

	default:
		break;
}
// Title HTML.
if (!empty($content)) {
	$title_options = _dfd_parse_text_shortcode_params($title_font_options, 'dfd-content-title-big', $title_google_fonts, $title_custom_fonts);
	$title_html .= '<' . $title_options['tag'] . ' class="dfd-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . wpb_js_remove_wpautop($content) . '</' . $title_options['tag'] . '>';
}

// Subtitle HTML.
if (!empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params($subtitle_font_options, 'dfd-content-subtitle', $subtitle_google_fonts, $subtitle_custom_fonts);
	$subtitle_html .= '<' . $subtitle_options['tag'] . ' class="dfd-sub-title ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html($subtitle) . '</' . $subtitle_options['tag'] . '>';
}

// Delimiter HTML.
if ($enable_delimiter == 'yes') {
	$delimiter_html .= '<div class="dfd-heading-delimiter">';
	if ($delimiter_style == 'icon') {
		$icon_config = dfd_icon_render($atts,true);
		$options = array (
				"icon_align" => $content_alignment,
				"icon_type" => $icon_type,
				"icon" => isset($icon_config["icon_class"]) ? $icon_config["icon_class"] : '',
				"icon_img" => $icon_img,
				"img_width" => $img_width,
				"icon_size" => $icon_size,
				"icon_color" => $icon_color,
				"icon_style" => $icon_style,
				"icon_color_bg" => $icon_color_bg,
				"icon_color_border" => $icon_color_border,
				"icon_border_style" => $icon_border_style,
				"icon_border_size" => $icon_border_size,
				"icon_border_radius" => $icon_border_radius,
				"icon_border_spacing" => $icon_border_spacing,
				"icon_animation" => "",
		);
		$oneIcon = new Dfd_OneIcon($options);
		$delimiter_html .=$oneIcon->toHtml();
	} elseif ($delimiter_style == 'image') {
		$delimiter_img_src = wp_get_attachment_image_src($delimiter_image, 'full');
		
		$img_atts = Dfd_Theme_Helpers::get_image_attrs($delimiter_img_src[0], $delimiter_image, $delimiter_img_src[1], $delimiter_img_src[2], esc_attr__('Delimiter','dfd-native'));
		
		if (isset($delimiter_img_src[0])) {
			$delimiter_html .= '<img src="' . esc_url($delimiter_img_src[0]) . '" '.$img_atts.' />';
		}
	} elseif ($delimiter_settings != '') {
		$delimiter_css_array = Dfd_Delimiter::get_only_style_css($delimiter_settings);
		$delimiter_width = isset($delimiter_css_array["delimiter_width"]) && !empty($delimiter_css_array["delimiter_width"]) ? $delimiter_css_array["delimiter_width"] : '';
		$delimiter_settings = Dfd_Delimiter::delimiter_css($delimiter_settings);
		if($delimiter_width){
			$delimiter_width = (int)$delimiter_width + 10;
			$padding_style = str_replace("%el%", $delimiter_width, $padding_type);
			$module_css .= '#' . esc_js($uniqid) . ' .dfd-heading-module {'.$padding_style.'}';
		}
		$module_css .= '#' . esc_js($uniqid) . ' .dfd-heading-delimiter {' . esc_js($delimiter_settings) . '}';
	}
	$delimiter_html .= '</div>';
}
if ($heading_margin != '') {
	$module_css .= '#' . esc_js($uniqid) . ' .dfd-title {' . esc_js(Dfd_VC_Param_Margin::margins_css($heading_margin)) . '}';
}
if ($subheading_margin != '') {
	$module_css .= '#' . esc_js($uniqid) . ' .dfd-sub-title{' . esc_js(Dfd_VC_Param_Margin::margins_css($subheading_margin)) . '}';
}
if ($delimiter_margin != '') {
	$module_css .= '#' . esc_js($uniqid) . ' .dfd-heading-delimiter {' . esc_js(Dfd_VC_Param_Margin::margins_css($delimiter_margin)) . '}';
}
if(isset($title_responsive) && $title_responsive != '') {
	$module_css .= Dfd_Resposive_Text_Param::responsive_css($title_responsive, '#' . esc_js($uniqid) . ' .dfd-title');
}
if(isset($subtitle_responsive) && $subtitle_responsive != '') {
	$module_css .= Dfd_Resposive_Text_Param::responsive_css($subtitle_responsive, '#' . esc_js($uniqid) . ' .dfd-sub-title');
}

$style_template = DFD_EXTENSIONS_PLUGIN_PATH. 'vc_custom/templates/heading/' . $style . '.php';

$output .= '<div class="dfd-heading-shortcode">';
$output .= '<div class="dfd-heading-module-wrap ' . esc_attr($el_class) . ' ' . esc_attr($responsive_class) . '" id="' . esc_attr($uniqid) . '" ' . $animation_data . '>';
$output .= '<div class="inline-block">';
$output .= '<div class="dfd-heading-module">';
if (file_exists($style_template))
	include($style_template);
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
if (!empty($module_css)) {
	$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$module_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
}

$output .= '</div>';
echo $output;
