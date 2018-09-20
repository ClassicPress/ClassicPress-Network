<?php
if ( ! defined( 'ABSPATH' ) || !class_exists('WC_Widget_Products') ) { exit; }

$output = $pagination_html = $data_atts = $css_rules = '';

$uniqid = uniqid('dfd-products_list-');

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

/*Product item object inited*/
get_template_part('inc/loop/posts/product_loop_small_shortcode');

$product = new Dfd_Product_Loop_Small_Shortcode($atts);

extract($atts);

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

$title_css = _dfd_parse_text_shortcode_params($title_font_options, '', $title_google_fonts, $title_custom_fonts, true);

$subtitle_css = _dfd_parse_text_shortcode_params($subtitle_font_options, '', $subtitle_google_fonts, $subtitle_custom_fonts, true);

$price_css = _dfd_parse_text_shortcode_params($price_font_options, '', $price_google_fonts, $price_custom_fonts, true);

if(isset($title_css['style']) && !empty($title_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-shop-loop-small-shortcode .dfd-product-small-list .dfd-loop-product-small-item .woo-title-wrap .dfd-shop-loop-title {'.$title_css['style'].'}';
}

if(isset($subtitle_css['style']) && !empty($subtitle_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-shop-loop-small-shortcode .dfd-product-small-list .dfd-loop-product-small-item .woo-title-wrap .dfd-woocommerce-subtitle {'.$subtitle_css['style'].'}';
}

if(isset($price_css['style']) && !empty($price_css['style'])) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-shop-loop-small-shortcode .dfd-product-small-list .dfd-loop-product-small-item .woo-title-wrap .price {'.$price_css['style'].'}';
}

if(isset($thumb_radius) && !empty($thumb_radius)) {
	$css_rules .= '#'.esc_js($uniqid).' .dfd-shop-loop-small-shortcode .dfd-product-small-list .dfd-loop-product-small-item .thumb-wrap {border-radius: '.$thumb_radius.'px;}';
}

/*Data attributes generated*/
if(isset($module_animation) && $module_animation != '') {
	$data_atts .= ' data-animate="1" data-animate-type="'.esc_attr($module_animation).'" data-animate-item=".product"';
}

$wp_query = new WP_Query($args);

echo '<div id="'.esc_attr($uniqid).'" class="woocommerce">';
	
	echo '<div class="dfd-shop-loop-small-shortcode '.esc_attr($el_class).'" '.$data_atts.'>';

		echo '<div class="dfd-product-small-list products">';
	
			while ($wp_query->have_posts()) : $wp_query->the_post();
				$product->post();
			endwhile;
		
		echo '</div>';

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