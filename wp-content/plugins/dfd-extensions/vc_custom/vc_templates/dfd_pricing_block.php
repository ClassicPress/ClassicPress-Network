<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$style = $title = $subtitle = $currency_symbol = $payment_amount = $time_interval = $el_class = $show_icon = $icon_type = $icon_size = $icon_color = $icon_image_id = '';
$content_description = $values = $feature_style = $label = $type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';
$button_text = $button_link = $feat_mark_text = $title_t_heading = $title_font_options = $use_google_fonts = $custom_fonts = $subtitle_t_heading = $subtitle_font_options = '';
$content_font_options = $features_font_options = $module_animation = $link_css = $icon_html = $animation_data = $title_html = $subtitle_html = $output = '';
$head_icon_fontawesome = $symbol_size = $amount_size = $interval_size = $price_letter_spacing = $delimeter_color = $dot_color = $price_color = $shadow_html = '';
$dot_style = $mark_color = $mark_bg_color = $mark_rounded = $icon_text = $icon_wrap_class = $icon_text_size = $icon_text_color = $content_options = $button_left_padding = '';
$head_type = $ic_fontawesome = $ic_openiconic = $ic_typicons = $ic_entypo = $ic_linecons = $icon_feature_size =	$icon_feature_color = $main_border_radius3 = '';
$main_border = $main_border_hover = $content_bg_color = $features_bg_color = $disable_shadow = $delimeter_style = $delimiter_feature_style = $delimiter_feature_color = '';
$button_color = $button_hover_color = $button_bg_color = $button_bg_hover_color = $button_border = $button_hover_button = $a_rel = $button_full_width = $button_right_padding = '';
$feature_top_bottom_offset = $general_bottom_offset = $general_top_offset = '';

$atts = vc_map_get_attributes( 'dfd_pricing_block', $atts );
extract( $atts );

$uniqid = uniqid('dfd-pricing-block-') .'-'.rand(1,9999);

/*Styles*/
if(isset($symbol_size) && !empty($symbol_size)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .price-wrap .currency-symbol {font-size: '.esc_attr($symbol_size).'px;}';
}
if(isset($amount_size) && !empty($amount_size)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .price-wrap .payment-amount {font-size: '.esc_attr($amount_size).'px;}';
}
if(isset($interval_size) && !empty($interval_size)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .price-wrap .time-interval {font-size: '.esc_attr($interval_size).'px;}';
}
if(isset($price_letter_spacing) && $price_letter_spacing != '') {
	$link_css .= '#'.esc_js($uniqid).' .block-head .price-wrap {letter-spacing: '.esc_attr($price_letter_spacing).'px;}';
}
if(isset($style) && strcmp($style, 'style-03') != 0) {
	if($main_border != '') {
		$main_border_css = Dfd_Border_Param::border_css($main_border);
		if(substr_count($main_border_css,'border-radius:') > 0) {
			$border_radius = substr($main_border_css,stripos($main_border_css,'border-radius:'));
			if($border_radius != '') {
				$link_css .= '#'.esc_js($uniqid).' {' . $border_radius . '}';
			}
		}
		$link_css .= '#'.esc_js($uniqid).'.style-01, #'.esc_js($uniqid).'.style-02 .block-bottom {' . $main_border_css . '}';
	}
	if($main_border_hover != '') {
		$main_border_hover_css = Dfd_Border_Param::border_css($main_border_hover);
		if(substr_count($main_border_hover_css,'border-radius:') > 0) {
			$border_radius = substr($main_border_hover_css,stripos($main_border_hover_css,'border-radius:'));
			if($border_radius != '') {
				$link_css .= '#'.esc_js($uniqid).':hover {' . $border_radius . '}';
			}
		}
		$link_css .= '#'.esc_js($uniqid).'.style-01:hover, #'.esc_js($uniqid).'.style-02:hover .block-bottom {' . $main_border_hover_css . '}';
	}
}else{
	if(isset($main_border_radius3) && strcmp($main_border_radius3, '') != 0) {
		$link_css .= '#'.esc_js($uniqid).' {border-radius: '.esc_attr($main_border_radius3).'px;}';
	}
}
if(isset($content_bg_color) && !empty($content_bg_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head {background: '.esc_attr($content_bg_color).';}';
	$link_css .= '#'.esc_js($uniqid).'.style-03 .block-bottom {background: '.esc_attr($content_bg_color).';}';
}
if(isset($general_bottom_offset) && $general_bottom_offset != '') {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom {padding-bottom: '.esc_attr($general_bottom_offset).'px;}';
}
if(isset($general_top_offset) && $general_top_offset != '') {
	$link_css .= '#'.esc_js($uniqid).' .block-head {padding-top: '.esc_attr($general_top_offset).'px;}';
}
if(isset($features_bg_color) && !empty($features_bg_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom {background: '.esc_attr($features_bg_color).';}';
}
if(isset($delimeter_style) && !empty($delimeter_style)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head {border-style: '.esc_attr($delimeter_style).';}';
}
if(isset($delimeter_color) && !empty($delimeter_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head {border-color: '.esc_attr($delimeter_color).';}';
}
if(isset($delimiter_feature_style) && !empty($delimiter_feature_style)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .options-list .option {border-style: '.esc_attr($delimiter_feature_style).';}';
}
if(isset($delimiter_feature_color) && !empty($delimiter_feature_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .options-list .option {border-color: '.esc_attr($delimiter_feature_color).';}';
}
if(isset($price_color) && !empty($price_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .price-wrap {color: '.esc_attr($price_color).';}';
}
if(isset($mark_color) && !empty($mark_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .feat-mark {color: '.esc_attr($mark_color).';}';
}
if(isset($mark_bg_color) && !empty($mark_bg_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .feat-mark {background: '.esc_attr($mark_bg_color).';}';
}
if(isset($mark_rounded) && !empty($mark_rounded)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .feat-mark {border-radius: '.esc_attr($mark_rounded).'px;}';
}
if(isset($icon_text_size) && !empty($icon_text_size)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .icon-wrap {font-size: '.esc_attr($icon_text_size).'px;}';
}
if(isset($icon_text_color) && !empty($icon_text_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-head .icon-wrap {color: '.esc_attr($icon_text_color).';}';
}
if(isset($icon_feature_size) && !empty($icon_feature_size)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .options-list .option i {font-size: '.esc_attr($icon_feature_size).'px;}';
}
if(isset($icon_feature_color) && !empty($icon_feature_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .options-list .option i {color: '.esc_attr($icon_feature_color).';}';
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .price-block-dot {background: '.esc_attr($icon_feature_color).';}';
}
if(isset($feature_top_bottom_offset) && $feature_top_bottom_offset != '') {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .options-list .option {padding: '.esc_attr($feature_top_bottom_offset).'px 0;}';
}
if(isset($button_color) && !empty($button_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button {color: '.esc_attr($button_color).';}';
}
if(isset($button_hover_color) && !empty($button_hover_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button:hover {color: '.esc_attr($button_hover_color).';}';
}
if(isset($button_bg_color) && !empty($button_bg_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button {background: '.esc_attr($button_bg_color).';}';
}
if(isset($button_bg_hover_color) && !empty($button_bg_hover_color)) {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button:hover {background: '.esc_attr($button_bg_hover_color).';}';
}
if($button_border != '') {
	$button_border_css = Dfd_Border_Param::border_css($button_border);
	if(substr_count($button_border_css,'border-radius:') > 0) {
		$border_radius = substr($button_border_css,stripos($button_border_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button {' . $border_radius . '}';
		}
	}
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button {' . $button_border_css . '}';
}
if($button_hover_button != '') {
	$button_hover_button_css = Dfd_Border_Param::border_css($button_hover_button);
	if(substr_count($button_hover_button_css,'border-radius:') > 0) {
		$border_radius = substr($button_hover_button_css,stripos($button_hover_button_css,'border-radius:'));
		if($border_radius != '') {
			$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button:hover {' . $border_radius . '}';
		}
	}
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button:hover {' . $button_hover_button_css . '}';
}
if(isset($button_full_width) && $button_full_width != 'button_width') {
	$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button {display: inline-block;}';
	if(isset($button_left_padding) && $button_left_padding != '') {
		$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button {padding-left: '.esc_attr($button_left_padding).'px;}';
	}
	if(isset($button_right_padding) && $button_right_padding != '') {
		$link_css .= '#'.esc_js($uniqid).' .block-bottom .pricing-button {padding-right: '.esc_attr($button_right_padding).'px;}';
	}
}

if(!($module_animation == '')) {
	$el_class       .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'" ';
}
if(isset($disable_shadow) && strcmp($disable_shadow, 'shadow') == 0) {
	$shadow_html = '<span class="shadow-box"></span>';
}

if(isset($icon_type) && strcmp($icon_type, 'text') == 0) {
	$icon_wrap_class = 'dfd-content-title-big';
}
if(isset($show_icon) && strcmp($show_icon, 'enable_icon') === 0) {
	$icon_html = '<div class="icon-wrap '.$icon_wrap_class.'">'.dfd_icon_render($atts).'</div>';
}

if(!empty($title)) {
	$title_options = _dfd_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts  );
	$title_html .= '<div class="block-title dfd-content-title-big"><' . $title_options['tag'] . ' class="' . $title_options['class'] . '" ' . $title_options['style'] . '>' . $title . '</' . $title_options['tag'] . '></div>';
}

if(!empty($subtitle)) {
	$subtitle_options = _dfd_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );
	$subtitle_html .= '<div class="block-subtitle dfd-content-subtitle"><' . $subtitle_options['tag'] . ' class="' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . $subtitle . '</' . $subtitle_options['tag'] . '></div>';
}

$attributes    = array();
if (function_exists('vc_build_link')) {
	$button_link = ( '||' === $button_link ) ? '' : $button_link;
	$button_link = vc_build_link( $button_link );

	$a_href   = $button_link['url'];
	$a_title  = $button_link['title'];
	$a_rel  = $button_link['rel'];
	$a_target = strlen($button_link['target']) > 0 ? $button_link['target'] : '_self';

	$attributes[] = 'href="' . esc_url( trim( $a_href ) ) . '"';
	$attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
	$attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
	$attributes[] = 'rel="' . esc_attr( trim( $a_rel ) ) . '"';
}

/**************************
 * Module.
 *************************/

$output .= '<div id="'.esc_js($uniqid).'" class="dfd-pricing-block '.$style.' '.$el_class.'" ' . $animation_data . '>';
	$output .= '<div class="block-head">';

		if(isset($feat_mark_text) && !empty($feat_mark_text) ) {
			$output .= '<span class="feat-mark dfd-content-title-small">' . $feat_mark_text . '</span>';
		}

		$output .= $icon_html;
		$output .= $title_html;
		$output .= $subtitle_html;

		$output .= '<div class="price-wrap dfd-content-title-big">';
			if ( ! empty( $currency_symbol ) ) {
				$output .= '<span class="currency-symbol">' . $currency_symbol . '</span>';
			}
			if ( ! empty( $payment_amount ) ) {
				$output .= '<span class="payment-amount">' . $payment_amount . '</span>';
			}
			if ( ! empty( $time_interval ) ) {
				$output .= '<span class="time-interval"> /'.$time_interval.'</span>';
			}
		$output .= '</div>';
		
		if(isset($content_description) && !empty($content_description)) {
			$content_options = _dfd_parse_text_shortcode_params( $content_font_options, '' );
			$output .= '<'.$content_options['tag'].' class="content-desc dfd-content-subtitle" '.$content_options['style'].'>'.$content_description.'</'.$content_options['tag'].'>';
		}

	$output .= '</div>';/*block-head*/

	$output .= '<div class="block-bottom">';
	
		if (function_exists('vc_param_group_parse_atts')) {
			$values = (array) vc_param_group_parse_atts($values);
		}
		if (is_array($values)) {
			$description_option = _dfd_parse_text_shortcode_params( $features_font_options, 'price-feature');

			$output .= '<ul class="options-list">';
				foreach ($values as $single_feature) {

					// Enqueue needed icon font.
					vc_icon_element_fonts_enqueue($single_feature['type']);

					$iconClass = isset( $single_feature{'icon_' . $single_feature['type']} ) ? esc_attr( $single_feature{'icon_' . $single_feature['type']} ) : '';

					$output .= '<li class="option">';
					if($single_feature['feature_style'] === 'dot') {
						if(isset($single_feature['dot_color']) && !empty($single_feature['dot_color'])) {
							$dot_style = 'style="background: '.esc_attr($single_feature['dot_color']).';"';
						}
						$output .= '<span class="pricing-dots-alignment"><span class="price-block-dot ' . $single_feature['feature_style'] . '" '.$dot_style.'></span></span>';
					} else {
						if (!empty($iconClass) && ($single_feature['feature_style'] !== 'text_only')) {
							$output .= '<span class="option-icon"><i class="' . $iconClass . '"></i></span>';
						}
						if (!empty($single_feature['label']) && ($single_feature['feature_style'] !== 'icon_only')) {
							$output .= '<' . $description_option['tag'] . ' class="pricing-feature-description" ' . $description_option['style'] . '>' . $single_feature['label'] . '</' . $description_option['tag'] . '>';
						}
					}
					$output .= '</li>';
				}

			$output .= '</ul>';
		}
		
		if(isset($button_text) && !empty($button_text) && !empty($button_link)) {
			$output .= '<div class="dfd-button-click-animated"><a class="pricing-button dfd-click-anim-button button" ' . implode( ' ', $attributes ) . '>' . $button_text . '</a></div>';
		}


	$output .= '</div>';/*block-bottom*/
	$output .= $shadow_html;

	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
	}
	
$output .= '</div>';/*dfd-pricing-block*/

echo $output;