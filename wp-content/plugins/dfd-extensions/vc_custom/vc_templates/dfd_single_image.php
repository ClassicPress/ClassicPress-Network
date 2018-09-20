<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $image_url = $el_class = $image_dimention = $width = $height = $animation_data = $thumb_data_attr = $large_image_url = $retina_atts = $img_rounded = $link_css = '';
$box_shadow = $hover_box_shadow = $image_html = '';

$atts = vc_map_get_attributes( 'dfd_single_image', $atts );
extract( $atts );

$el_class .= ' '.$image_alignment.' '.$hover_style;

$unique_id = uniqid('dfd-single-image-').'-'.rand(1,9999);

if ( ! ( $module_animation == '' ) ) {
	$el_class .= ' cr-animate-gen';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

if(isset($image_type) && $image_type == 'media_library' && isset($image) && !empty($image)) {
	if(!isset($image_size) || empty($image_size)) {
		$image_size = 'full';
	}

	$image_dimention = $image_size;

	if($image_size == 'custom') {
		$image_dimention = 'full';
	}

	$image_src = wp_get_attachment_image_src($image, $image_dimention);

	if(isset($enable_retina) && !empty($enable_retina) && isset($retina_image_size) && !empty($retina_image_size)) {
		$retina_img_id = 'retina_image_'.$retina_image_size;
		if($$retina_img_id && !empty($$retina_img_id)) {
			$retina_img_src = wp_get_attachment_image_src($$retina_img_id, 'full');
			if(isset($retina_img_src[0]) && $retina_img_src[0])
				$retina_atts .= 'data-retina-img="'.esc_url($retina_img_src[0]).'"';
		}
	}

	if(isset($image_src[0]) && !empty($image_src[0])) {
		$large_image_url = $image_src[0];

		$thumb_url = wp_get_attachment_image_src($image, 'thumbnail');

		if(!empty($thumb_url[0])) {
			$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
		}

		if($image_size == 'custom') {
			if(!isset($image_width) || empty($image_width))
				$image_width = 600;
			if(!isset($image_height) || empty($image_height))
				$image_height = 550;

			$image_url = dfd_aq_resize($image_src[0], $image_width, $image_height, true, true, true);
			
			if(!$image_url) {
				$image_url = $image_src[0];
			}

			$width = floor($image_width);
			$height = floor($image_height);
		} else {
			$image_url = $image_src[0];

			$width = floor($image_src[1]);
			$height = floor($image_src[2]);
		}
		
		$default_alt = esc_attr__('Image module','dfd-native');
		
		$img_atts = Dfd_Theme_Helpers::get_image_attrs($image_src[0], $image, $width, $height, $default_alt);
		
		global $dfd_native;

		if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
			$el_class .= ' dfd-img-lazy-load';
			$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
			$image_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($image_url).'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" '.$retina_atts.' '.$img_atts.' />';
		} else {
			$image_html = '<img src="'.esc_url($image_url).'" '.$width.' '.$height.' '.$retina_atts.' '.$img_atts.' />';
		}
	}
} elseif(isset($image_type) && $image_type == 'external_link' && isset($external_link_url) && !empty($external_link_url)) {
	$image_url = $large_image_url = $external_link_url;
	$thumb_data_attr = 'data-thumb="'.esc_url($image_url).'"';
	$image_html = '<img src="'.esc_url($image_url).'" alt="'.esc_attr__('Image module','dfd-native').'" />';
} elseif(isset($image_type) && $image_type == 'featured_image' && has_post_thumbnail()) {
	$thumb = get_post_thumbnail_id();
	$image_url = $large_image_url = wp_get_attachment_url($thumb);
	$thumb_data_attr = 'data-thumb="'.esc_url($image_url).'"';
	$image_html = '<img src="'.esc_url($image_url).'" alt="'.esc_attr__('Image module','dfd-native').'" />';
} else {
	$image_url = Dfd_Theme_Helpers::default_noimage_url();
	$image_html = '<img src="'.esc_url($image_url).'" alt="'.esc_attr__('Image module','dfd-native').'" />';
}

if(isset($enable_link) && !empty($enable_link)) {
	switch($link_object) {
		case 'lightbox':
			$image_html = '<a href="'.esc_url($large_image_url).'" title="'.esc_attr__('Open in lightbox', 'dfd-native').'" class="prettyPhoto" '.$thumb_data_attr.' data-rel="prettyPhoto[]">'.$image_html.'</a>';
			break;
		case 'link':
			if(isset($image_ext_link_url) && !empty($image_ext_link_url))
				$image_html = '<a href="'.esc_url($image_ext_link_url).'" title="">'.$image_html.'</a>';
			break;
		case 'onepage':
			if(isset($onepage_navigate) && !empty($onepage_navigate))
				$image_html = '<a href="#" class="dfd-one-page-nav" data-dir="'.esc_attr($onepage_navigate).'" title="'.esc_attr($onepage_navigate).'">'.$image_html.'</a>';
			break;
	}
}

if(isset($img_rounded) && $img_rounded != '') {
	$link_css .= '#'.esc_js($unique_id).' {border-radius: '.esc_js($img_rounded).'px;}';
}
if(isset($hover_style) && $hover_style == 'dfd-image-shadow') {
	if(substr_count($box_shadow, 'disable') == 0) {
		$box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
		$link_css .= '#'.esc_js($unique_id).'.dfd-image-shadow img {'.esc_attr($box_shadow).'}';
	}
	if(substr_count($hover_box_shadow, 'disable') == 0) {
		$hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
		$link_css .= '#'.esc_js($unique_id).'.dfd-image-shadow:hover img {'.esc_attr($hover_box_shadow).'}';
	}
}
$output .= '<div id="'.esc_attr($unique_id).'" class="dfd-single-image-module '.esc_attr($el_class).'" '.$animation_data.'>';
	$output .= $image_html;

	if(!empty($link_css)) {
		$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$link_css.'</style>");'
						. '})(jQuery);'
					. '</script>';
	}

$output .= '</div>';

echo $output;