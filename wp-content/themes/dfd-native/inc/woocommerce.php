<?php
/**
 * Woocommerce support
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

if (!function_exists('dfd_woocommerce_disable_styles')) {
	/*
	 * Disable default WooCommerce styles
	 */
	function dfd_woocommerce_disable_styles() {
		add_filter( 'woocommerce_enqueue_styles', 'dfd_woocommerce_disable_styles_filter', 11 );
	}
}

if (!function_exists('dfd_woocommerce_disable_styles_filter')) {
	/*
	 * Disable WooCommerce styles filter
	 */
	function dfd_woocommerce_disable_styles_filter($in) {
		return array();
	}
}

// Override woocommerce_output_related_products()
function woocommerce_output_related_products() {
	$args = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);
	woocommerce_related_products($args); // Display 4 products in rows of 4
}

if ( ! function_exists( 'wc_product_rating_overview' ) ) {
	/*
	 * Product price wrapper
	 */
	function wc_product_rating_overview() {
		global $product;
		if(isset($product) && method_exists($product,'get_rating_html')) {
			echo '<span class="show">' . $product->get_rating_html() . '</span>';
		}
	}
}

if(!function_exists('dfd_woocommerce_image_size_options')) {
	/*
	 * WooCommerce default image dimentions
	 */
	function dfd_woocommerce_image_size_options() {
		$image_dimenions = array();
		$image_dimenions['catalog'] = array(
			'width' 	=> '450',	// px
			'height'	=> '650',	// px
			'crop'		=> 1 		// true
		);

		$image_dimenions['single'] = array(
			'width' 	=> '762',	// px
			'height'	=> '1100',	// px
			'crop'		=> 1 		// true
		);

		$image_dimenions['thumbnail'] = array(
			'width' 	=> '140',	// px
			'height'	=> '140',	// px
			'crop'		=> 1 		// true
		);
		return $image_dimenions;
	}
}

if (!function_exists('dfd_kadabra_woocommerce_image_dimensions')) {
	/**
	 * Define image sizes
	 */
	function dfd_kadabra_woocommerce_image_dimensions() {
		
		$image_dimentions = dfd_woocommerce_image_size_options();

		// Image sizes
		update_option( 'shop_catalog_image_size', $image_dimentions['catalog'] ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $image_dimentions['single'] ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $image_dimentions['thumbnail'] ); 	// Image gallery thumbs
	}
}

/*
 * Override WooCommerce default function
 */
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	$fragments['a.woo-cart-contents'] = dfd_a_woo_cart_contents();

	return $fragments;

}

if(!function_exists('dfd_a_woo_cart_contents')) {
	/*
	 * WooCommerce header cart button
	 */
	function dfd_a_woo_cart_contents() {
		global $woocommerce;
		if(function_exists('wc_get_cart_url')) {
			$href = wc_get_cart_url();
		} else {
			$href = $woocommerce->cart->get_cart_url();
		}
		$html = $title = '';

		$items_count = $woocommerce->cart->cart_contents_count;

		$html .= '<a class="woo-cart-contents" href="'. esc_url($href) .'" title="'. esc_attr($title) .'">';
			$html .= '<span class="woo-cart-items">';
				$html .= '<i class="dfd-socicon-icon-ios7-cart"></i>';
				$html .= '<!-- <span class="dfd-header-cart-handle"></span> -->';
			$html .= '</span>';
			$html .= '<span class="woo-cart-details">';
				$html .= $items_count;
			$html .= '</span>';
		$html .= '</a>';

		return $html;
	}
}

if(!function_exists('dfd_woocommerce_total_cart')) {
	/*
	 * WooCommerce cart content in header
	 */
	function dfd_woocommerce_total_cart($simple = false) {
		if (!class_exists('WooCommerce')) {
			return;
		}

		$html = '';

		$html .= '<div class="total_cart_header">';
			$html .= dfd_a_woo_cart_contents();
			if(!$simple) {
				$html .= '<div class="shopping-cart-box">';
					$html .= '<div class="shopping-cart-box-content">';
						$html .= '<div class="widget_shopping_cart_content"></div>';
					$html .= '</div>';
				$html .= '</div>';
			}
		$html .= '</div>';

		return $html;
	}
}

if(!function_exists('dfd_wishlist_button')) {
	/*
	 * Wishlist button
	 */
	function dfd_wishlist_button() {
		if (!defined('YITH_WCWL')) {
			return;
		}

		global $yith_wcwl;

		$items_in_wishlist = $yith_wcwl->count_products();

		$html = '';

		$href = $yith_wcwl->get_wishlist_url();
		$title = esc_html__('View your wishlist', 'dfd-native');

		$html .= '<a class="header-wishlist-button dfd-tablet-hide" href="'. esc_url($href) .'" title="'. esc_attr($title) .'">';
			$html .= '<i class="dfd-socicon-icon-ios7-heart"></i>';
			$html .= '<span class="wishlist-details">'. esc_html($items_in_wishlist) .'</span>';
		$html .= '</a>';

		return $html;
	}
}

/*
 * Override default WooCommerce function
 */
function woocommerce_template_loop_product_thumbnail() {
	global $dfd_native;
	
	echo '<div class="woo-cover">';
	
		Dfd_Theme_Helpers::dfd_woo_product_thumbs();
		
		wc_get_template('loop/share.php');
		
		if(method_exists('Dfd_Theme_Helpers','dfd_woocommerce_loop_button_wrap') && (!isset($dfd_native['woo_products_loop_style']) || $dfd_native['woo_products_loop_style'] == 'style-1') || !is_archive()) {
			Dfd_Theme_Helpers::dfd_woocommerce_loop_button_wrap();
		}
	echo '</div>';
}

/*
 * WooCommerce Actions
 */
/* Shop category page */

// product link removed and inside content wrapped

remove_action('woocommerce_before_main_content','woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

//products archive page
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_action('woocommerce_before_shop_loop_item', 'dfd_woocommerce_template_loop_product_wrapper_opened', 10);

add_action('woocommerce_shop_loop_item_title', 'dfd_before_shop_loop_title', 4);
add_action('woocommerce_shop_loop_item_title', 'dfd_woocommerce_template_loop_product_subtitle', 15);

add_action('woocommerce_after_shop_loop_item_title', 'dfd_woocommerce_template_loop_price', 5);
add_action('woocommerce_after_shop_loop_item_title', 'dfd_woocommerce_template_loop_rating', 10);
add_action('woocommerce_after_shop_loop_item_title', 'dfd_after_shop_loop_title', 15);

add_action('woocommerce_after_shop_loop_item_title', 'dfd_woocommerce_template_loop_additional_buttons', 20);

add_action('woocommerce_after_shop_loop_item', 'dfd_woocommerce_template_loop_product_wrapper_closed', 5);

if(!function_exists('dfd_woocommerce_template_loop_additional_buttons')) {
	function dfd_woocommerce_template_loop_additional_buttons() {
		global $dfd_native;
		if(!is_archive()) {
			return;
		}
		if(method_exists('Dfd_Theme_Helpers', 'dfd_woocommerce_loop_button_wrap') && isset($dfd_native['woo_products_loop_style']) && $dfd_native['woo_products_loop_style'] != 'style-1') {
			Dfd_Theme_Helpers::dfd_woocommerce_loop_button_wrap();
		}
	}
}

if(!function_exists('dfd_woocommerce_template_loop_product_wrapper_opened')) {
	function dfd_woocommerce_template_loop_product_wrapper_opened() {
		echo '<div class="prod-wrap">';
	}
}

if(!function_exists('dfd_before_shop_loop_title')) {
	function dfd_before_shop_loop_title() {
		echo '<div class="woo-title-wrap">';
	}
}

function woocommerce_template_loop_product_title() {
	global $dfd_native;
	
	if(!isset($dfd_native['woo_products_loop_title']) || $dfd_native['woo_products_loop_title'] == 'on') {
		$title = get_the_title();
		if(!isset($dfd_native['woocommerce_catalogue_mode']) || $dfd_native['woocommerce_catalogue_mode'] != '1') {
			$title = '<a href="'.esc_url(get_permalink()).'" title="'.esc_attr($title).'">' . esc_html($title) . '</a>';
		}
		echo '<h3 class="dfd-shop-loop-title">'.$title.'</h3>';
	}
}

if(!function_exists('dfd_woocommerce_template_loop_product_subtitle')) {
	function dfd_woocommerce_template_loop_product_subtitle() {
		global $dfd_native;
		if(!isset($dfd_native['woo_products_loop_subtitle']) || $dfd_native['woo_products_loop_subtitle'] == 'on') {
			$subtitle = get_post_meta(get_the_ID(), 'dfd_product_product_subtitle', true);
			if(!empty($subtitle)) {
				echo '<h4 class="dfd-woocommerce-subtitle">' . esc_html($subtitle) . '</h4>';
			}
		}
	}
}

if(!function_exists('dfd_woocommerce_template_loop_price')) {
	function dfd_woocommerce_template_loop_price() {
		global $dfd_native;
		if(function_exists('woocommerce_template_loop_price') && (!isset($dfd_native['woo_products_loop_price']) || $dfd_native['woo_products_loop_price'] == 'on')) {
			woocommerce_template_loop_price();
		}
	}
}

if(!function_exists('dfd_woocommerce_template_loop_rating')) {
	function dfd_woocommerce_template_loop_rating() {
		global $dfd_native;
		if(function_exists('woocommerce_template_loop_rating') && (!isset($dfd_native['woo_products_loop_rating']) || $dfd_native['woo_products_loop_rating'] == 'on')) {
			echo '<div class="dfd-rating-wrap">';
				echo '<div class="inline-block">';
					woocommerce_template_loop_rating();
				echo '</div>';
			echo '</div>';
		}
	}
}

if(!function_exists('dfd_after_shop_loop_title')) {
	function dfd_after_shop_loop_title() {
		echo '</div>';
	}
}

if(!function_exists('dfd_woocommerce_template_loop_after_rating')) {
	function dfd_woocommerce_template_loop_after_rating() {
		
	}
}

if(!function_exists('dfd_woocommerce_template_loop_product_wrapper_closed')) {
	function dfd_woocommerce_template_loop_product_wrapper_closed() {
		echo '</div>';
	}
}

/* Single product */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
/*Open row before product*/
add_action( 'woocommerce_before_single_product', 'dfd_woocommerce_before_single_product_row_wrap', 15 );
/*Open column before product image*/
add_action( 'woocommerce_before_single_product_summary', 'dfd_woocommerce_before_single_product_summary_open_column', 5 );
/*Close column after product image*/
add_action( 'woocommerce_before_single_product_summary', 'dfd_woocommerce_before_single_product_summary_close_column', 25 );

/*Open column before product description*/
add_action( 'woocommerce_before_single_product_summary', 'dfd_woocommerce_after_single_product_summary_open_column', 30 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_before_single_summary', 4 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_template_single_product_subtitle', 8 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_before_single_price', 15 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_after_single_price', 25 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_before_single_excerpt', 28 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_after_single_excerpt', 33 );
add_action( 'woocommerce_before_add_to_cart_button', 'dfd_woocommerce_before_add_to_cart_button');
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 40 );
add_action( 'woocommerce_after_add_to_cart_button', 'dfd_woocommerce_wishlist_after_add_to_cart_button', 10);
add_action( 'woocommerce_after_add_to_cart_button', 'dfd_woocommerce_after_add_to_cart_button', 20);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 60 );
add_action( 'woocommerce_single_product_summary', 'dfd_woocommerce_template_single_sharing_bottom', 70 );
/*Close column after product description*/
add_action( 'woocommerce_after_single_product_summary', 'dfd_woocommerce_after_single_product_summary_close_column', 5 );

/*Show/hide replated products on single product page*/
add_action('init', 'dfd_woo_related_products_trigger');

if(!function_exists('dfd_woo_related_products_trigger')) {
	function dfd_woo_related_products_trigger() {
		global $dfd_native;
		if(isset($dfd_native['woo_single_show_related_products']) && $dfd_native['woo_single_show_related_products'] == 'off') {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
	}
}

/*Close row before product*/
add_action( 'woocommerce_after_single_product', 'dfd_woocommerce_after_single_product_row_wrap', 15 );

if(!function_exists('dfd_woocommerce_before_single_product_row_wrap')) {
	function dfd_woocommerce_before_single_product_row_wrap() {
		echo '<div class="row">';
	}
}

if(!function_exists('dfd_woocommerce_before_single_product_summary_open_column')) {
	function dfd_woocommerce_before_single_product_summary_open_column() {
		global $dfd_native;
		if(isset($dfd_native['product_single_columns_config']) && !empty($dfd_native['product_single_columns_config']) && $dfd_native['product_single_columns_config'] != 'default') {
			$columns = Dfd_Theme_Helpers::dfd_num_to_string_full((int)$dfd_native['product_single_columns_config']);
		} else {
			$columns = 'six';
		}
		echo '<div class="'.esc_attr($columns).' columns equalize-me">';
	}
}

//if(!function_exists('dfd_woocommerce_before_single_product_summary_close_column')) {
//	function dfd_woocommerce_before_single_product_summary_close_column() {
//		echo '</div>';
//	}
//}

if(!function_exists('dfd_woocommerce_before_single_summary')) {
	function dfd_woocommerce_before_single_summary() {
		global $dfd_native;
		if(isset($dfd_native['woo_single_show_product_breadcrumbs']) && $dfd_native['woo_single_show_product_breadcrumbs'] == 'on') {
			echo '<div class="breadcrumbs">';
				woocommerce_breadcrumb();
			echo '</div>';
		}
	}
}

if(!function_exists('dfd_woocommerce_after_single_product_summary_open_column')) {
	function dfd_woocommerce_after_single_product_summary_open_column() {
		global $dfd_native;
		if(isset($dfd_native['product_single_columns_config']) && !empty($dfd_native['product_single_columns_config']) && $dfd_native['product_single_columns_config'] != 'default') {
			$columns = Dfd_Theme_Helpers::dfd_num_to_string_full((int)$dfd_native['product_single_columns_config'], true);
		} else {
			$columns = 'five push-one';
		}
		echo '<div class="'.esc_attr($columns).' columns dfd-single-product-desc-wrap equalize-me">';
	}
}

if(!function_exists('dfd_woocommerce_after_single_product_summary_close_column')) {
	function dfd_woocommerce_after_single_product_summary_close_column() {
		echo '</div>';
		echo '<div class="clear"></div>';
	}
}

if(!function_exists('dfd_woocommerce_before_single_product_summary_close_column')) {
	function dfd_woocommerce_before_single_product_summary_close_column() {
		echo '</div>';
	}
}

if(!function_exists('dfd_woocommerce_after_single_product_row_wrap')) {
	function dfd_woocommerce_after_single_product_row_wrap() {
		echo '</div>';
	}
}

if(!function_exists('dfd_woocommerce_template_single_product_subtitle')) {
	function dfd_woocommerce_template_single_product_subtitle() {
		$subtitle = get_post_meta(get_the_ID(), 'dfd_product_product_subtitle', true);
		if(!empty($subtitle)) {
			echo '<h4 class="dfd-woocommerce-subtitle">' . esc_html($subtitle) . '</h4>';
		}
	}
}

if(!function_exists('dfd_woocommerce_before_single_price')) {
	function dfd_woocommerce_before_single_price() {
		echo '<div class="dfd-single-price-wrap">';
	}
}

if(!function_exists('dfd_woocommerce_after_single_price')) {
	function dfd_woocommerce_after_single_price() {
		echo '</div>';
	}
}

if(!function_exists('dfd_woocommerce_before_single_excerpt')) {
	function dfd_woocommerce_before_single_excerpt() {
		echo '<div class="dfd-single-description-wrap">';
	}
}

if(!function_exists('dfd_woocommerce_after_single_excerpt')) {
	function dfd_woocommerce_after_single_excerpt() {
		echo '</div>';
	}
}

if(!function_exists('dfd_woocommerce_wishlist_after_add_to_cart_button')) {
	function dfd_woocommerce_wishlist_after_add_to_cart_button() {
		if(function_exists('dfd_woocommerce_wishlist_size_quide')) {
			dfd_woocommerce_wishlist_size_quide();
		}
	}
}

if(!function_exists('sb_woocommerce_template_single_price_rating_wrap_end')) {
	function sb_woocommerce_template_single_price_rating_wrap_end() {
		echo '</div>';
	}
}

if(!function_exists('sb_woocommerce_template_single_rating')) {
	function sb_woocommerce_template_single_rating() {
		if ( function_exists('wc_get_template') ) {
			wc_get_template( 'loop/rating.php' );
		}
	}
}

if (!function_exists('dfd_woocommerce_before_add_to_cart_button')) {
	function dfd_woocommerce_before_add_to_cart_button() {
		echo '<div class="single-product-buttons">';
			echo '<div class="single_add_to_cart_button_wrap">';
	}
}

if (!function_exists('dfd_woocommerce_after_add_to_cart_button')) {
	function dfd_woocommerce_after_add_to_cart_button() {
			echo '</div>';
		echo '</div>';
	}
}

if (!function_exists('dfd_woocommerce_after_product_summary')) {
	function dfd_woocommerce_after_product_summary() {
			echo '</div>';
		echo '</div>';
	}
}

if (!function_exists('dfd_woocommerce_wishlist_size_quide')) {
	function dfd_woocommerce_wishlist_size_quide() {
		if (!defined('YITH_WCWL'))
			return;
		$position = get_option( 'yith_wcwl_button_position' );
		if($position == 'shortcode') {
			echo '<div class="single-product-wishlist-wrap">';
				wc_get_template_part('add-to-wishlist-button');
			echo '</div>';
		}
	}
}

if (!function_exists('dfd_woocommerce_after_wishlist_size_quide')) {
	function dfd_woocommerce_after_wishlist_size_quide() {
			echo '</div>';
		echo '</div>';
	}
}

if (!function_exists('dfd_woocommerce_template_single_sharing_bottom')) {
	/*
	 * WooCommerce single product share
	 */
	function dfd_woocommerce_template_single_sharing_bottom() {
		echo '<div class="dfd-share-cover dfd-woo-single-share-bottom">';
			get_template_part('templates/entry-meta/mini','share');
		echo '</div>';
	}
}

add_action('woocommerce_after_cart', 'dfd_cart_related_products', 15);

if(!function_exists('dfd_cart_related_products')) {
	/*
	 * WooCommerce cart top rated products
	 */
	function dfd_cart_related_products() {
		echo '<div class="clear"></div>';
		echo '<div class="dfd-cart-top-products text-center">';
			echo '<div class="twelve columns">';
				echo '<h3 class="dfd-shop-loop-title text-left">'.esc_html__('Top rated products', 'dfd-native').'</h3>';
				echo do_shortcode('[top_rated_products per_page="4" columns="4"]');
			echo '</div>';
		echo '</div>';
	}
}

add_filter('woocommerce_page_title', 'sb_woocommerce_page_title');

if (!function_exists('sb_woocommerce_page_title')) {
	/*
	 * WooCommerce page title filter
	 */
	function sb_woocommerce_page_title($page_title) {
		global $dfd_native;
		if (isset($dfd_native['shop_title']) && $dfd_native['shop_title']) {
			$page_title = $dfd_native['shop_title'];
		}

		return $page_title;
	}
}

add_filter( 'woocommerce_sale_flash', 'dfd_woocommerce_custom_sales_price', 10, 3 );

if(!function_exists('dfd_woocommerce_custom_sales_price')) {
	/*
	 * WooCommerce products Sale price filter
	 */
	function dfd_woocommerce_custom_sales_price($text, $post, $product ) {
		$percentage = '';
		if(!is_null($product->get_regular_price()) && $product->get_regular_price() != 0) {
			$percentage = '-'.round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ) . '%';
		}
		return sprintf( '<span class="onsale">' . esc_html__( '%s Sale!', 'dfd-native' ) . '</span>', $percentage );
	}
}

add_filter( 'loop_shop_per_page', 'dfd_woocommerce_custom_products_number', 20 );

if(!function_exists('dfd_woocommerce_custom_products_number')) {
	/*
	 * WooCommerce products loop number filter
	 */
	function dfd_woocommerce_custom_products_number() {
		global $dfd_native;
		$products_number = 9;
		if(isset($dfd_native['woo_category_products_number']) && !empty($dfd_native['woo_category_products_number'])) {
			$products_number = $dfd_native['woo_category_products_number'];
		}
		return $products_number;
	}
}

add_filter('yith_wcwl_add_to_cart_label', 'dfd_wishlist_add_to_cart', 10);
add_filter('variable_add_to_cart_text', 'dfd_wishlist_add_to_cart', 10);

if(!function_exists('dfd_wishlist_add_to_cart')) {
	function dfd_wishlist_add_to_cart($label) {
		return '<i class="dfd-socicon-icon-ios7-cart"></i><span>'.$label.'</span>';
	}
}

add_action( 'wp_ajax_dfd_update_wishlist_count', 'dfd_update_wishlist_count' );
add_action( 'wp_ajax_nopriv_dfd_update_wishlist_count', 'dfd_update_wishlist_count' );

if(!function_exists('dfd_update_wishlist_count')) {
	/*
	 * Update wishlist counter
	 */
	function dfd_update_wishlist_count(){
		if( function_exists( 'YITH_WCWL' ) ){
			wp_send_json( YITH_WCWL()->count_products() );
		}
	}
}