<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$output = $list_class = $pagination_html = $data_atts = $css_rules = '';

$uniqid = uniqid('dfd-products_list-');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

/*Product item object inited*/
get_template_part('inc/loop/posts/product_loop_shortcode');

$product = new Dfd_Product_Loop_Shortcode($atts);

extract($atts);

if(!isset($columns) || $columns == '') {
	$columns = 3;
}
/*Loop settings*/
$sticky = get_option('sticky_posts');

$args = array(
	'post_type' => 'product',
	'posts_per_page' => $posts_to_show,
	'ignore_sticky_posts' => 1,
	'post__not_in' => $sticky,
);

if(!isset($display) || $display == '') {
	$display = 'all';
}

switch($display) {
	case 'recent':
		$args['meta_query'] = WC()->query->get_meta_query();
		break;
	case 'featured':
		if(function_exists('wc_get_product_visibility_term_ids')) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['featured'],
			);
		} else {
			$args['meta_query'] = array(
				array(
					'key' 		=> '_visibility',
					'value' 	  => array('catalog', 'visible'),
					'compare'	=> 'IN'
				),
				array(
					'key' 		=> '_featured',
					'value' 	  => 'yes'
				)
			);
		}
		break;
	case 'on_sale':
		global $woocommerce;
		if(function_exists('wc_get_product_ids_on_sale')) {
			$sale_product_ids = wc_get_product_ids_on_sale();
		} else {
			$sale_product_ids = woocommerce_get_product_ids_on_sale();
		}
		$meta_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
	    $meta_query[] = $woocommerce->query->stock_status_meta_query();
		$args['meta_query'] = $meta_query;
		$args['post__in'] = $sale_product_ids;
		break;
	case 'top_rated':
		$args['no_found_rows'] = 1;
		$args['meta_key'] = '_wc_average_rating';
		$args['orderby'] = 'meta_value_num';
		$args['order'] = 'DESC';
		$args['meta_query'] = WC()->query->get_meta_query();
		$args['tax_query'] = WC()->query->get_tax_query();
		break;
	case 'top_sales':
		$args['meta_key'] = 'total_sales';
		$args['orderby'] = 'meta_value_num';
		$args['meta_query'] = array(
				array(
					'key' 		=> '_visibility',
					'value' 	=> array( 'catalog', 'visible' ),
					'compare' 	=> 'IN'
				)
			);
		break;
	case 'categories':
		if (!empty($post_categories)) {
			$post_categories_array = explode(',', $post_categories);
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $post_categories_array,
				)
			);
		}
		break;
}

if(isset($post_content_alignment) && $post_content_alignment != '') {
	$el_class .= ' '.$post_content_alignment;
}

if(isset($carousel_mode) && $carousel_mode == 'on') {
	$el_class .= ' swiper-container';
	$list_class .= ' swiper-wrapper';
	$data_atts .= ' data-slides="'.esc_attr($columns).'"';
	if(isset($dots_style) && $dots_style != '') {
		$el_class .= ' above ' . $dots_style; 
		$pagination_html = '<ul class="dfd-slick-dots"></ul>';
	}
}


if(isset($items_offset) && $items_offset != '') {
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode:not(.swiper-container) .products,'
				. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.swiper-container {margin: -'. esc_js((int)$items_offset/2) .'px;}';
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode .products > li.product {padding: '. esc_js((int)$items_offset/2) .'px;}';
}

$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);

$subtitle_css = _dfd_parse_text_shortcode_params($subtitle_font_options, '', $subtitle_google_fonts, $subtitle_custom_fonts, true);

$price_css = _dfd_parse_text_shortcode_params($price_font_options, '', $price_google_fonts, $price_custom_fonts, true);

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode .products > li.product h3.dfd-shop-loop-title {'.$title_css['style'].'}';
}

if(isset($subtitle_css['style']) && !empty($subtitle_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode .products > li.product h4.dfd-woocommerce-subtitle {'.$subtitle_css['style'].'}';
}

if(isset($price_css['style']) && !empty($price_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode .products > li.product .woo-title-wrap .price {'.$price_css['style'].'}';
}

if(isset($thumb_radius) && $thumb_radius != '') {
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode .products > li.product .woo-cover .woo-entry-thumb,'
				. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-3 .products > li.product .prod-wrap .woo-cover,'
				. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-4 .products > li.product .prod-wrap .woo-cover,'
				. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-loop-shortcode .products > li.product .prod-wrap .woo-cover:before {border-radius: '.$thumb_radius.'px;}';
}

if(substr_count($box_shadow, 'disable') == 0 || substr_count($hover_box_shadow, 'disable') == 0 && isset($thumb_radius) && $thumb_radius != '') {
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-1 .products > li.product .prod-wrap,'
				. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-2 .products > li.product .prod-wrap,'
				. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-3 .products > li.product .prod-wrap {border-radius: '.$thumb_radius.'px;}';
	
	$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-1 .products > li.product .woo-cover .woo-entry-thumb,'
				. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-2 .products > li.product .woo-cover .woo-entry-thumb {border-bottom-left-radius: 0; border-bottom-right-radius: 0;}';
}

if(substr_count($box_shadow, 'disable') == 0) {
	$box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($box_shadow);
	if($box_shadow != '') {
		$el_class .= ' dfd-shadow-idle';
		$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode:not(.dfd-products-style-4) .products > li.product:not(:hover) .prod-wrap,'
					. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-4 .products > li.product:not(:hover) .prod-wrap .woo-cover {'.esc_attr($box_shadow).'}';
	}
}
if(substr_count($hover_box_shadow, 'disable') == 0) {
	$hover_box_shadow = Dfd_Box_Shadow_Param::box_shadow_css($hover_box_shadow);
	if($hover_box_shadow != '') {
		$el_class .= ' dfd-shadow-hover';
		$css_rules .= '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode:not(.dfd-products-style-4) .products > li.product:hover .prod-wrap,'
					. '#'.esc_js($uniqid).'.woocommerce .dfd-woo-category-wrap.dfd-shop-archive.dfd-shop-loop-shortcode.dfd-products-style-4 .products > li.product:hover .prod-wrap .woo-cover {'.esc_attr($hover_box_shadow).'}';
	}
}

/*Data attributes generated*/
if(isset($module_animation) && $module_animation != '') {
	$data_atts .= ' data-animate="1" data-animate-type="'.esc_attr($module_animation).'" data-animate-item=".product"';
}

$wp_query = new WP_Query($args);

echo '<div id="'.esc_attr($uniqid).'" class="woocommerce">';
	
	echo '<div class="dfd-woo-category-wrap dfd-shop-archive dfd-shop-loop-shortcode dfd-shop-columns-'.esc_attr($columns).' dfd-products-'.esc_attr($post_content_style).' '.esc_attr($el_class).'" '.$data_atts.'>';

		echo '<ul class="products '.esc_attr($list_class).'">';
	
			while ($wp_query->have_posts()) : $wp_query->the_post();
				$product->post();
			endwhile;
		
		echo '</ul>';

		echo $pagination_html;
			
	echo '</div>';
	
	if($css_rules != '') {
		echo '<script type="text/javascript">'
				. '(function($) {'
					. '$("head").append("<style>'.$css_rules.'</style>");'
				. '})(jQuery);'
			. '</script>';
	}
	
echo '</div>';

wp_reset_postdata();