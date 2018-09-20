<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $el_class = $data_atts = $css_rules = '';

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract( $atts );

if(isset($dfd_layer_image) && !empty($dfd_layer_image)) {
	global $dfd_native;
	
	$uniqid = uniqid('dfd-simple-image-gallery-');
	
	if(isset($module_animation) && !empty($module_animation)) {
		$data_atts .= ' data-animate="1"  data-animate-type="'.esc_attr($module_animation).'" data-animate-item=".cover"';
	}
	
	if(!isset($images_style) || empty($images_style)) {
		$images_style = 'fitRows';
	}
	
	$el_class .= ' layout-'.$images_style;
	
	if(isset($items_offset) && $items_offset != '') {
		$css_rules .= '#'.$uniqid.' .dfd-simple-image-gallery {margin: -'. $items_offset/2 .'px}';
		$css_rules .= '#'.$uniqid.' .dfd-simple-image-gallery .dfd-simple-image-gallery-item .cover {padding: '. $items_offset/2 .'px}';
	}
	
	if($images_style == 'carousel') {
		$el_class .= ' dfd-carousel-wrap';
		
		$data_atts .= ' data-infinite="true"';
		
		if(isset($autoplay) && $autoplay == 'true') {
			$data_atts .= ' data-autoplay="'.esc_attr($autoplay).'"';
			if(isset($carousel_slideshow_speed) && $carousel_slideshow_speed != '') {
				$data_atts .= ' data-speed="'.esc_attr($carousel_slideshow_speed).'"';
			}
		}
		
		if(!isset($slides_to_show) || $slides_to_show == '') {
			$slides_to_show = 3;
		}
		$columns = $slides_to_show;
		
		if(isset($slides_to_scroll) && $slides_to_scroll != '') {
			$data_atts .= ' data-scroll="'.esc_attr($slides_to_scroll).'"';
		}
		
		if(isset($use_dots) && $use_dots == 'show') {
			$data_atts .= ' data-dots="true"';
			$el_class .= ' text-center'; 
			if(isset($dots_style) && $dots_style != '') {
				$el_class .= ' above ' . $dots_style; 
			}
		}
		
		if(isset($crop_images) && $crop_images != 'true') {
			$data_atts .= ' data-varwidth="true"';
			$slides_to_show = 5;
		}
		
		$data_atts .= ' data-slides="'.esc_attr($slides_to_show).'"';
	} else {
		if(!isset($isotope_columns) || empty($isotope_columns)) {
			$isotope_columns = 3;
		}
		$columns = $isotope_columns;
		$el_class .= ' isotope-columns-'.esc_attr($columns);
		$data_atts .= ' data-enable-isotope="1"';
		$data_atts .= ' data-layout-type="'.esc_attr($images_style).'"';
		$data_atts .= ' data-columns="'.esc_attr($columns).'"';
	}
	
	if(!isset($image_width) || empty($image_width)) {
		$image_width = 900;
	}
	
	if(!isset($image_height) || empty($image_height)) {
		$image_height = 600;
	}
	
	$image_ids = explode(',', $dfd_layer_image);
	$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-simple-image-gallery-wrapper">';
		$output .= '<div class="dfd-simple-image-gallery '.esc_attr($el_class).'" '.$data_atts.'>';
			foreach($image_ids as $id) {
				$img_html = $item_class = '';
				
				$img_src = wp_get_attachment_image_src($id, 'full');
				
				$width = $image_width;
				$height = $image_height;
				
				if($images_style == 'carousel' && isset($crop_images) && $crop_images != 'true') {
					$width = $height * ($img_src[1] / $img_src[2]);
				}
				
				if($images_style == 'masonry') {
					$img_url = dfd_aq_resize($img_src[0], $width, false);
				} else {
					$img_url = dfd_aq_resize($img_src[0], $width, $height, true, true, true);
				}
				
				if(!$img_url) {
					$img_url = $img_src[0];
				}
				
				$img_atts = Dfd_Theme_Helpers::get_image_attrs($img_url, $id, $width, $height, '');
				
				if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
					$item_class .= ' dfd-img-lazy-load';
					$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $width $height'%2F%3E";
					$img_html .= '<img src="'.$loading_img_src.'" data-src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" '.$img_atts.' />';
				} else {
					$img_html .= '<img src="'. esc_url($img_url) .'" width="'.esc_attr(floor($width)).'" '.$img_atts.' />';
				}
				
				if(isset($lightbox) && $lightbox == 'true') {
					$thumb_src = wp_get_attachment_image_src($id, 'thumbnail');
					$img_html = '<a href="'.esc_url($img_src[0]).'" title="" data-rel="prettyPhoto[dfd-gallery-'.esc_attr($uniqid).']" data-thumb="'.esc_url($thumb_src[0]).'">'.$img_html.'</a>';
				}
				
				$output .= '<article class="dfd-simple-image-gallery-item">';
					$output .= '<div class="cover '.esc_attr($item_class).'">';
						$output .= $img_html;
					$output .= '</div>';
				$output .= '</article>';
			}
		$output .= '</div>';
		if($css_rules != '') {
			$output .= '<script type="text/javascript">'
						. '(function($) {'
							. '$("head").append("<style>'.$css_rules.'</style>");'
						. '})(jQuery);'
					. '</script>';
		}
	$output .= '</div>';
}

echo $output;