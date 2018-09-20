<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $select_icon = $icon_style = $icon_color = $delim_line_color = $delimiter_style = "";
$center_arrow_style = $delimiter_height = $icon_class = $delimiter_styles = $icon_size_increse = "";
$text_delimiter = $el_class = $animation_data = $delim_circle_line_color= $content_bg_hover_color = $content_bg_color = $delimiter_border_style = $text_block_width = $delimiter_image_center_html = $background_gradient_style = $text_block_style = $image = "";
$start_color = $end_color = $el_class_anim = $svg = $delim_hover_circle_line_color =  $align_style = $repeat_image = $text_bg_color = $link_css = $module_animation = $delimiter_line_html = $text_color = $use_google_fonts = $icon_hover_color = $text_hover_color = $custom_fonts = "";
$atts = vc_map_get_attributes('dfd_delimiter', $atts);
extract($atts);
$atts["icon_type"] = "selector";
$uniqid = uniqid('dfd-delimiter-') . '-' . rand(1, 9999);
if (!empty($module_animation)) {
	$el_class_anim = 'cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

if (!empty($icon_size)) {
	$icon_size = esc_attr($icon_size);
}
$icon_size = (int) $icon_size < 10 ? 10 : (int) $icon_size;

switch ($delimiter_style) {
	case 'dfd-delimiter-with-arrow':
		$icon_size_increse = ($icon_size * 2) + 10;
		$icon_class = "dfd-socicon-chevron-arrow-up";
		break;
	case 'dfd-delimiter-with-icon':
		$icon_size_increse = ($icon_size * 2);
		$icon_class = "dfd-socicon-earth-globe";
		break;
}

if (!empty($icon_size) || !empty($icon_color)) {
	$icon_style = 'style="';
	if ($delimiter_style == "dfd-delimiter-with-arrow") {
		if ($icon_color) {
			$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow .inner-wrapper-icon i{'
					   . '    text-shadow: 0px 0px ' . $icon_color . ', 0px 150px ' . $icon_color . '; }';
		}
	} else {
		$icon_style .= $icon_color ? 'color:' . esc_attr($icon_color) . ';' : '';
	}
	$icon_style .= $icon_size ? 'font-size:' . esc_attr($icon_size) . 'px;' : '';
	$icon_style .= '"';
}

/**
 * delimiter styles
 */
if (!empty($delim_line_color) || !empty($delimiter_height) || !empty($delimiter_border_style)) {
	$delimiter_styles = 'style="';
	$delimiter_styles .= $delim_line_color ? 'border-bottom-color:' . esc_attr($delim_line_color) . ';' : '';
	$delimiter_styles .= $delimiter_height ? 'border-bottom-width:' . esc_attr($delimiter_height) . 'px; ' : '';
	$delimiter_styles .= $delimiter_border_style ? 'border-bottom-style:' . esc_attr($delimiter_border_style) . '; ' : '';
	$delimiter_styles .= '"';
}
if (!empty($delim_line_color) || !empty($icon_size)) {
	$center_arrow_style = 'style="';

	$center_arrow_style .= $icon_size ? 'width:' . $icon_size_increse . 'px; height:' . $icon_size_increse . 'px;' : '';
	if($delim_circle_line_color){
		$center_arrow_style .= $delim_circle_line_color ? 'border-color:' . esc_attr($delim_circle_line_color) . ';' : '';
	}else{
		$center_arrow_style .= $delim_line_color ? 'border-color:' . esc_attr($delim_line_color) . ';' : '';
	}
	$center_arrow_style .= '"';
}
if ($show_icon != "enable_icon") {
	$icon_html = '<i class="' . $icon_class . '" ' . $icon_style . '></i> ';
} else {
	$icon_html = dfd_icon_render($atts);
}

/**
 * Stytle with arrow and icon
 */
$delimiter_left_html = '<span class="delim-left">
		<span class="line" ' . $delimiter_styles . '></span>
	</span>';
$delimiter_center_html = '<span class="delim-center">
		<div class="center-arrow" ' . $center_arrow_style . '>
			<div class="inner-wrapper-icon">' . $icon_html . '</div>
		</div>
	</span>';

/**
 * Style with repeat image
 */
$image_url = "";
if (!empty($image)) {
	$image_src = wp_get_attachment_image_src($image, 'full');
	if ($repeat_image == "show") {
		
		$delimiter_image_style = 'style="background:url(' . $image_src[0] . '); height:' . $image_src[2] . 'px;"';
		$delimiter_image_center_html = '<div class="background-repeat" ' . $delimiter_image_style . '></div>';
	} else {
		$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_src[0], $image, $image_src[1], $image_src[2], esc_attr__('Delimiter','dfd-native'));
		$delimiter_image_center_html = '<img width="'.$image_src[1].'" height="'.$image_src[2].'" src="'.$image_src[0].'" '.$img_atts.' />';
	}
}else{
	if ($repeat_image == "show") {
		$image_src =  DFD_EXTENSIONS_PLUGIN_URL .'assets/img/delimiter_5.png';
		$delimiter_image_style = 'style="background:url(' .$image_src . '); height:5px;"';
		$delimiter_image_center_html = '<div class="background-repeat" ' . $delimiter_image_style . '></div>';
	} else {
		$image_src = Dfd_Theme_Helpers::default_noimage_url("rect_med_300");
		$delimiter_image_center_html = '<img width="300" height="300" src="'.$image_src.'"alt="'.esc_attr__('Delimiter','dfd-native').'" />';
	}
}
if($align_image){
	$align_style .= " style='";
	$align_style .= "text-align:".  esc_attr($align_image)."; ";
	$align_style .= "' ";
}
/**
 * Style with Text
 */
$text_delimiter = empty($text_delimiter) ? "Delimiter text" : esc_attr($text_delimiter);
/**
 * Text color
 */
$text_color_style = _dfd_parse_text_shortcode_params($title_font_options, 'feature-title', $use_google_fonts, $custom_fonts);


$content_style = $text_color_style['style'];

if (!empty($text_color)) {
	$content_style_bg = 'color:' . esc_attr($text_color) . ';';
	$content_style = _add_custom_param_to_text_shortcode_params($content_style, $content_style_bg);
}
if (!empty($text_bg_color)) {
	$content_style_bg = 'background-color:' . esc_attr($text_bg_color) . ';';
	$content_style_bg .= 'padding:8px;';
	$content_style = _add_custom_param_to_text_shortcode_params($content_style, $content_style_bg);
}
$delimiter_text_center_html = '<span class="delim-center">
		<span class="text dfd-content-title-small" ' . $content_style . '>' . $text_delimiter . '</span>
	</span>';
$delimiter_right_html = '<span class="delim-right">
		<span class="line" ' . $delimiter_styles . '></span>
	</span>';
$delimiter_line_html = '<span><span class="line" ' . $delimiter_styles . '></span></span>';

/**
 * Main html tempaletes
 */
$output .='<div class="dfd-delimier-main-wrapper ' . $el_class_anim . '" ' . $animation_data . '>';
$output.= '<div id="' . $uniqid . '"  class="dfd-delimier-wrapper ' . $delimiter_style . ' ' . $el_class . '" '.$align_style.'>';
switch ($delimiter_style) {
	case 'dfd-delimiter-with-arrow':
		if ($content_bg_color) {
			$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow{'
					   . 'background-color: ' . esc_attr($content_bg_color) . '; }';
		}
		if($delim_hover_circle_line_color){
			$link_css.='#' . esc_js($uniqid) .'.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow:hover{'
				   . ' border-color:'. esc_attr($delim_hover_circle_line_color) . ' !important; '
				   . '}';
		}
		
		if ($content_bg_hover_color) {
			$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow:hover{'
					   . 'background-color: ' . esc_attr($content_bg_hover_color) . '; }';
		}
		$output.= $delimiter_left_html;
		$output.= $delimiter_center_html;
		$output.= $delimiter_right_html;
		break;
	case 'dfd-delimiter-with-line':
		$output.= $delimiter_line_html;
		break;
	case 'dfd-delimiter-with-text':
		$link_css .= $delim_line_color ? 'border-bottom-color:' . esc_attr($delim_line_color) . '; ' : '';
		$link_css .= $delimiter_border_style ? 'border-bottom-style:' . esc_attr($delimiter_border_style) . '; ' : '';
		if ($delimiter_height) {
			$link_css .= 'height:' . (int) $delimiter_height . 'px; ';
			$link_css .= 'border-bottom-width:' . (int) $delimiter_height . 'px; ';
			$link_css .= 'margin-top: -' . (int) $delimiter_height / 2 . 'px; ';
		}
		$link_css = '#' . esc_js($uniqid) . ' .delim-center span:before, #' . esc_js($uniqid) . ' .delim-center span:after { ' . $link_css . '; } ';
		if(isset($delimiter_text_responsive) && $delimiter_text_responsive != '') {
			$link_css .= Dfd_Resposive_Text_Param::responsive_css($delimiter_text_responsive, '#'.esc_js($uniqid).'.dfd-delimiter-with-text .delim-center span ');
		}
		$output.= $delimiter_text_center_html;
		break;
	case 'dfd-delimiter-with-image':
		$output.= $delimiter_image_center_html;
		break;

	default:
		$output.= $delimiter_left_html;
		$output.= $delimiter_center_html;
		$output.= $delimiter_right_html;
}
if (!empty($icon_hover_color) && $icon_hover_color) {
	if ($delimiter_style == "dfd-delimiter-with-arrow") {
		$link_css .= '#' . esc_js($uniqid) . '.dfd-delimier-wrapper.dfd-delimiter-with-arrow .center-arrow:hover .inner-wrapper-icon i{'
				   . '    text-shadow: 0px -150px ' . $icon_hover_color . ', 0px 0px ' . $icon_hover_color . ' !important; }';
	} else {
		$link_css.='#' . esc_js($uniqid) . '.dfd-delimiter-with-icon .inner-wrapper-icon i:hover{color:' . esc_attr($icon_hover_color) . ' !important;}';
	}
}
if (!empty($link_css)) {
	$output .= '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$link_css.'</style>");'
				. '})(jQuery);'
			. '</script>';
}
$output.= '</div></div>';
echo $output;
