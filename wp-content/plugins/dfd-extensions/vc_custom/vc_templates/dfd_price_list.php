<?php

if ( !defined( 'ABSPATH' )) { exit; }

$main_style = $module_animation = $el_class = $list_fields = $delimeter_style = $delimeter_width = $color_delim = $symbol_under_price = '';
$title_font_options = $use_google_fonts = $custom_fonts = $subtitle_font_options = $subtitle_google_fonts = $subtitle_custom_fonts = '';
$animation_data = $output = $delimiter_html = $link_css = $box_width = $spacing_content = '';
$image_id = $img_html = $img_src = $img_url = $img_width = $img_height = $img_radius = '';

$atts = vc_map_get_attributes('dfd_price_list', $atts);
extract($atts);

$uniqid = uniqid('dfd-price-wrap-').'-'.rand(1,9999);

if(!($module_animation == '')) {
	$animation_data = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
}

$title_font_options = _dfd_parse_text_shortcode_params( $title_font_options, 'dfd-content-title-big', $use_google_fonts, $custom_fonts, true );
$subtitle_font_options = _dfd_parse_text_shortcode_params( $subtitle_font_options, 'dfd-content-subtitle', $subtitle_google_fonts, $subtitle_custom_fonts, true );

/**********************
 * Delimiter Settings
 *********************/
if(isset($delimeter_style) && !empty($delimeter_style)) {
	$link_css .= '#'. esc_js($uniqid).' .dfd-price-cover .price-delimeter {border-bottom-style: '.esc_attr($delimeter_style).';}';
}
if(isset($delimeter_width) && $delimeter_width != '') {
	$link_css .= '#'. esc_js($uniqid).' .dfd-price-cover .price-delimeter {border-bottom-width: '.esc_attr($delimeter_width).'px;}';
}
if(isset($color_delim) && !empty($color_delim)){
	$link_css .= '#'. esc_js($uniqid).' .dfd-price-cover .price-delimeter {border-color: '.esc_attr($color_delim).';}';
}


if(isset($box_width) && $box_width !== '') {
	if($box_width < 0) {
		$box_width = 0;
	}
	if($box_width > 100) {
		$box_width = 100;
	}
	$link_css .= '#'. esc_js($uniqid).'.dfd-price-wrap {width: '.esc_js($box_width).'%;}';
}

if(isset($spacing_content) && !empty($spacing_content)){
	$link_css .= '#'.esc_js($uniqid).' .dfd-price-block {margin-top: '.esc_attr($spacing_content).'px;}';
}

/**********************
 * Image Settings
 *********************/
if(!isset($img_width) || $img_width == '') {
	$img_width = 80;
}
// Setting max size for image
if($img_width < 0) {
	$img_width = 0;
}
if($img_width > 100) {
	$img_width = 100;
}
$link_css .= '#'. esc_js($uniqid).' .thumb-wrap img {width: '.esc_js($img_width).'px;}';
if(!isset($img_height) || $img_height == '') {
	$img_height = 80;
}
// Setting max size for image
if($img_height < 0) {
	$img_height = 0;
}
if($img_height > 100) {
	$img_height = 100;
}
$link_css .= '#'. esc_js($uniqid).' .thumb-wrap img {height: '.esc_js($img_height).'px;}';
if(isset($img_radius) && $img_radius !== '') {
	$link_css .= '#'. esc_js($uniqid).' .thumb-wrap img {border-radius: '.esc_js($img_radius).'px;}';
}

$output .= '<div id="'.  esc_attr($uniqid).'" class="dfd-price-wrap '.  esc_attr($el_class).'" '.$animation_data.'>';
	
	if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
		$list_fields = vc_param_group_parse_atts($list_fields);

		foreach ($list_fields as $fields) {
			$img_html = '';
			
			$output .= '<div class="dfd-price-block">';	
				if(isset($fields['image_id']) && !empty($fields['image_id'])) {
					$image_url = wp_get_attachment_image_src($fields['image_id'], 'full');
					$img_src = dfd_aq_resize($image_url[0], $img_width, $img_height, true, true, true);
					if(!$img_src) {
						$img_src = $img_url[0];
					}
					
					global $dfd_native;
					$thumb_class = '';
					
					$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src, $fields['image_id'], $img_width, $img_height, esc_html__('Pricing list', 'dfd-native'));

					if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
						$thumb_class .= ' dfd-img-lazy-load';
						$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $img_width $img_height'%2F%3E";
						$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($img_src).'" width="'.esc_attr($img_width).'" height="'.esc_attr($img_height).'" '.$img_atts.' />';
					} else {
						$img_html = '<img src="'.esc_url($img_src).'" width="'.esc_attr($img_width).'" height="'.esc_attr($img_height).'" '.$img_atts.' />';
					}
					$output .= '<div class="thumb-wrap '.esc_attr($thumb_class).'">'.$img_html.'</div>';
				}
				$output .= '<div class="text-wrap">';
					$output .= '<div class="dfd-price-cover clearfix">';
						if(isset($fields['title']) && !empty($fields['title'])){
							$output .= '<'.esc_attr($title_font_options['tag']).' class="price-title '.esc_attr($title_font_options['class']).'" style="'.$title_font_options['style'].'"> ' . esc_html($fields['title']) . ' </'.esc_attr($title_font_options['tag']).'>';
						}
						$output .= '<div class="price-delimeter"></div>';
						if(isset($fields['price']) && !empty($fields['price']) || isset($fields['currency_symbol']) && !empty($fields['currency_symbol'])){
							$echo_price = '';
							if(isset($symbol_under_price) && $symbol_under_price == 'after') {
								$echo_price = esc_html($fields['price']).''.esc_html($fields['currency_symbol']);
							}else{
								$echo_price = esc_html($fields['currency_symbol']).''.esc_html($fields['price']);
							}
							$output .= '<'.esc_attr($title_font_options['tag']).' class="amount-price amount '.esc_attr($title_font_options['class']).'" style="'.$title_font_options['style'].'"> '.$echo_price.' </'.esc_attr($title_font_options['tag']).'>';
						}
					$output .= '</div>';
					if(isset($fields['subtitle']) && !empty($fields['subtitle'])){
						$output .= '<div class="dfd-price-cover"><'.esc_attr($subtitle_font_options['tag']).' class="'.esc_attr($subtitle_font_options['class']).'" style="'.$subtitle_font_options['style'].'"> ' . wp_kses( $fields['subtitle'], array('br' => array()) ) . ' </'.esc_attr($subtitle_font_options['tag']).'></div>';
					}
				$output .= '</div>';	
			$output .= '</div>';	
		}

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

