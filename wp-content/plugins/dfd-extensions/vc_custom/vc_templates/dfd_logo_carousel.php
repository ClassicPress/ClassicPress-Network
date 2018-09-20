<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$main_style = $uniqid = $el_class = $module_animation = $data_atts = $output = $css_rules = $title_font_options = $use_google_fonts = $custom_fonts = $dots_style = '';
$list_fields = $thumb_radius = $link_css = $desc_color = $mask_background = $opacity_before = $opacity_after = $description = $enable_slides = $enable_main_border = '';

$atts = vc_map_get_attributes('dfd_logo_carousel', $atts);
extract($atts);

$images_lazy_load = false;

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$images_lazy_load = true;
	$el_class .= ' dfd-img-lazy-load ';
}

$uniqid = uniqid('dfd-logo-carousel-').'-'.rand(1,9999);

$el_class .= ' '.$main_style;

if(!($module_animation == '')) {
	$data_atts = ' data-animate="1" data-animate-type = "'.esc_attr($module_animation).'"';
}

/********************
 * Settings Carousel
 ********************/
if(empty($slides_to_show)) {
	$slides_to_show = 1;
}
$data_atts .= ' data-slide="'.esc_attr($slides_to_show).'"';

if(empty($slides_to_scroll)) {
	$slides_to_scroll = 1;
}
$data_atts .= ' data-scroll="'.esc_attr($slides_to_scroll).'"';

if(empty($slideshow_speed)) {
	$slideshow_speed = 3000;
}
$data_atts .= ' data-speed="'.esc_attr($slideshow_speed).'"';

if(isset($auto_slideshow) && strcmp($auto_slideshow, 'auto_slid') === 0) {
	$data_atts .= ' data-autoplay="1"';
}

if(isset($enable_dots) && strcmp($enable_dots, 'dots') === 0) {
	$data_atts .= ' data-dots="1"';
	$el_class .= ' dots-enable';
}
if(isset($dots_style) && !empty($dots_style)) {
	$el_class .= ' '.esc_attr($dots_style);
}

/*********************
 * Settings delimiter
 *********************/
if(isset($enable_delimiter) && $enable_delimiter == 'on') {
	$el_class .= ' enable-delimiter';
}

if(isset($enable_slides) && $enable_slides == 'slides') {
	$el_class .= ' dfd-slide-images';
}

$title_font_options = _dfd_parse_text_shortcode_params( $title_font_options, '', $use_google_fonts, $custom_fonts, true );
if(isset($title_font_options['style']) && $title_font_options['style'] != '') {
	$link_css .= '#'. esc_js($uniqid).' .dfd-logo-carousel-item .thumb-wrap .thumb-wrap-back .desc-text .text-overflow {'.esc_js($title_font_options['style']).'}';
}

if(! empty($thumb_radius)){
	$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item {border-radius: '.esc_attr($thumb_radius).'px;}';
}
if(isset($mask_background) && ! empty($mask_background)){
	$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item .thumb-wrap-back {background: '.esc_attr($mask_background).';}';
}

if(isset($main_style) && $main_style == 'style-1'){
	if(isset($opacity_before) && $opacity_before !== ''){
		if($opacity_before < 0) {
			$opacity_before = 0;
		}
		if($opacity_before > 100) {
			$opacity_before = 100;
		}
		$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item .thumb-wrap {opacity: '.esc_attr($opacity_before) / 100 .';}';
	}
	if(isset($opacity_after) && $opacity_after !== ''){
		if($opacity_after < 0) {
			$opacity_after = 0;
		}
		if($opacity_after > 100) {
			$opacity_after = 100;
		}
		$link_css .= '#'.esc_js($uniqid).' .dfd-logo-carousel-item:hover .thumb-wrap {opacity: '.esc_attr($opacity_after) / 100 .';}';
	}
}

if(isset($list_fields) && !empty($list_fields) && function_exists('vc_param_group_parse_atts')) {
	$list_fields = (array) vc_param_group_parse_atts($list_fields);

	if($columns == 'default') {
		$columns_count = count($list_fields);

		if($columns_count > 4) {
			if($columns_count % 3 == 0 && $columns_count % 4 != 0) {
				$columns_count = 3;
			} else {
				$columns_count = 4;
			}
		}
		$num = (int)$columns_count;
		$columns_class = Dfd_Theme_Helpers::dfd_num_to_string($columns_count);
	} else {
		$columns_class = 'columns-'.$columns;
		$num = (int)$columns;
	}
	
	$data_atts .= ' data-count="'.esc_attr($num).'"';

	$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-logo-carousel-wrap '.esc_attr($el_class).'" '.$data_atts.'>';
		
		$output .= '<div class="dfd-logo-carousel-list row">';

			foreach($list_fields as $fields) {

				$image_url = $img_src = $img_html = $desc_html = $link_title = $link_rel = $link_target = $link_html = $thumb = '';
				$width = 675;
				$height = 450;

				if(isset($fields['description']) && !empty($fields['description'])){
					$desc_html = '<span class="desc-text"><span class="text-overflow">'.esc_html($fields['description']).'</span></span>';
				}

				if(isset($fields['icon_image_id']) && !empty($fields['icon_image_id'])) {
					$thumb = $fields['icon_image_id'];
					$image_url = wp_get_attachment_image_src($fields['icon_image_id'], 'full');

					$img_src = $image_url[0];
					$width = $image_url[1];
					$height = $image_url[2];
				} else {
					$img_src = Dfd_Theme_Helpers::default_noimage_url();
				}
				
				$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_src, $thumb, $width, $height, esc_attr__('Client logo','dfd-native'));
				
				if($images_lazy_load) {
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
					$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($img_src).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" '.$img_atts.' />';
				} else {
					$img_html = '<img src="'.esc_url($img_src).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" '.$img_atts.' />';
				}

				if(isset($fields['link_box']) && $fields['link_box'] == 'link_b' && isset($fields['link'])) {
					$link = vc_build_link($fields['link']);
					$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
					$link_rel = !empty($link['rel']) ? 'rel="'.esc_attr($link['rel']).'"' : '';
					$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
					$link_html = '<a href="'.esc_url($link['url']).'" class="full-box-link" '.$link_title.' '.$link_target.' '.$link_rel.'></a>';
				}

				$output .= '<div class="dfd-item-offset columns columns-with-border logo-carousel '.esc_attr($columns_class).'">';
					$output .= '<div class="dfd-logo-carousel-item">';
						$output .= '<div class="thumb-wrap dfd-equalize-height">';
							if(isset($main_style) && $main_style == 'style-3'){
								$output .= '<div class="thumb-wrap-front dfd-equalize-height">';
									$output .= $img_html;
								$output .= '</div>';
								$output .= '<div class="thumb-wrap-back dfd-equalize-height">';
									$output .= '<div class="content-wrap">'; 
										$output .= $desc_html;
									$output .= '</div>'; 
								$output .= '</div>';
							} else {
								$output .= $img_html;
							}
						$output .= '</div>';

					$output .= $link_html;	
					$output .= '</div>';
				$output .= '</div>';
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
