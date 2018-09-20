<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $title_html = $subtitle_html = $category_html = $cat_url = $data_atts = $css_rules = $el_class = '';

$uniqid = uniqid('dfd-products-category');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract($atts);

if(!isset($content_style) || $content_style == '') {
	$content_style = 'style-1';
}

/*Class*/
$el_class .= ' dfd-'.$content_style;

/*Animation*/
if(isset($module_animation) && $module_animation != '') {
	$data_atts .= 'data-animate="1" data-animate-type="'.esc_attr($module_animation).'"';
}

/*Products category image*/
if(!isset($post_image_width) || $post_image_width == '') {
	$post_image_width = 600;
}

if(!isset($post_image_height) || $post_image_height == '') {
	$post_image_height = 600;
}

if(isset($enable_custom_image) && $enable_custom_image == 'yes' && isset($custom_image) && !empty($custom_image)) {
	$category_image_id = $custom_image;
	$category_image_src = wp_get_attachment_image_src($custom_image, 'full');
	$category_image_link = $category_image_src[0];
} else {
	$category_image_id = get_woocommerce_term_meta($category_id, 'thumbnail_id', true);
	$category_image_link = wp_get_attachment_url($category_image_id);
}
$category_image_url = dfd_aq_resize($category_image_link, $post_image_width, $post_image_height, true);

if(!$category_image_url) {
	$category_image_url = $category_image_link;
}

if($category_image_url == '') {
	$category_image_url = Dfd_Theme_Helpers::default_noimage_url();
}

$img_atts = Dfd_Theme_Helpers::get_image_attrs($category_image_url, $category_image_id, $post_image_width, $post_image_height, esc_html__('Products category image', 'dfd-native'));

global $dfd_native;

if(isset($dfd_native['enable_images_lazy_load']) && $dfd_native['enable_images_lazy_load'] == 'on') {
	$el_class .= ' dfd-img-lazy-load ';
	$loading_img_src = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 $post_image_width $post_image_height'%2F%3E";
	$img_html = '<img src="'.$loading_img_src.'" data-src="'.esc_url($category_image_url).'" '.$img_atts.' />';
} else {
	$img_html = '<img src="'.esc_url($category_image_url).'" '.$img_atts.' />';
}

/*Category url*/
$cat_src = get_term_link(intval($category_id), 'product_cat');
if($cat_src && !empty($cat_src) && !is_wp_error($cat_src)) {
	$cat_url = $cat_src;
}

/*Products category */
if(!isset($show_category) || $show_category == 'yes') {
	$term = get_term_by('id', $category_id, 'product_cat');
	if(isset($term->name) && !empty($term->name) && !is_wp_error($term)) {
		$category_html .= '<span class="byline category">';
		$category_html .= '<a href="'.esc_url($cat_url).'" title="'.esc_attr__('Product category link','dfd-native').'" class="fn">';
		$category_html .= '<span class="cat-name">';
		$category_html .= $term->name;
		$category_html .= '</span>';
		$category_html .= '</a>';
		$category_html .= '</span>';
	}
}

/*Title*/
if(isset($title_text) && $title_text != '') {
	$title_options = _dfd_parse_text_shortcode_params( $title_font_options, 'dfd-content-title-big', $title_google_fonts, $title_custom_fonts);
	$title_html .= '<'.$title_options['tag'].' class="product_title ' .$title_options['class'].'" ' . $title_options['style'] . '>'.strip_tags($title_text,'<br></br>').'</'.$title_options['tag'].'>';
}

/*Subtitle*/
if(isset($subtitle) && $subtitle != '') {
	$subtitle_options = _dfd_parse_text_shortcode_params( $subtitle_font_options, 'dfd-content-subtitle', $subtitle_google_fonts, $subtitle_custom_fonts);
	$subtitle_html .= '<'.$subtitle_options['tag'].' class="product_subtitle ' .$subtitle_options['class'].'" ' . $subtitle_options['style'] . '>'.esc_html($subtitle).'</'.$subtitle_options['tag'].'>';
}

/*Dynamic css styles*/
if(isset($mask_background_color) && $mask_background_color !== '') {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-product-category-module .dfd-product-category-module-wrap .entry-thumb:before {background: '.esc_js($mask_background_color).';}';
}

if(isset($category_background_color) && $category_background_color !== '') {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-product-category-module .dfd-product-category-module-wrap .content-wrap .byline.category {background: '.esc_js($category_background_color).';}';
}

if(isset($category_rounded) && $category_rounded !== '') {
	$css_rules .= '#'.esc_js($uniqid).'.dfd-product-category-module .dfd-product-category-module-wrap .content-wrap .byline.category {border-radius: '.esc_js($category_rounded).'px;}';
}

if(substr_count($box_shadow, 'disable') == 0) {
	$box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
	if($box_shadow != '') {
		$css_rules .= '#'.esc_js($uniqid).'.dfd-product-category-module:not(:hover) {'.esc_attr($box_shadow).'}';
	}
}
if(substr_count($hover_box_shadow, 'disable') == 0) {
	$hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
	if($hover_box_shadow != '') {
		$css_rules .= '#'.esc_js($uniqid).'.dfd-product-category-module:hover {'.esc_attr($hover_box_shadow).'}';
	}
}

/*Output*/
$output .= '<div id="'.esc_attr($uniqid).'" class="dfd-product-category-module">';
	$output .= '<div class="dfd-product-category-module-wrap '.esc_attr($el_class).'" '.$data_atts.'>';
		$output .= '<div class="entry-thumb">';
			$output .= $img_html;
		$output .= '</div>';
		$output .= '<div class="content-wrap">';
			$output .= $subtitle_html;
			$output .= $title_html;
			$output .= $category_html;
		$output .= '</div>';
		if($cat_url != '') {
			$output .= '<a href="'.esc_url($cat_url).'" title="'.esc_attr__('Product category link','dfd-native').'" class="dfd-product-cat-link"></a>';
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

echo $output;