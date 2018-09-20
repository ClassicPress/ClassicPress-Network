<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if (isset($r->post->ID)) {
	$r_post_id = $r->post->ID;
} else {
	$r_post_id = null;
}

if(function_exists('wc_placeholder_img')) {
	$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail( $r_post_id, array(120, 120) ) : wc_placeholder_img( 'shop_thumbnail' );
} else {
	$thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail( $r_post_id, array(120, 120) ) : woocommerce_placeholder_img( 'shop_thumbnail' );
}

if (function_exists('dfd_aq_resize')) {
	if(function_exists('wc_placeholder_img_src')) {
		$thumbnail_src = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id($r_post_id) ) : wc_placeholder_img_src();
	} else {
		$thumbnail_src = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id($r_post_id) ) : woocommerce_placeholder_img_src();
	}
	$thumbnail_url = dfd_aq_resize($thumbnail_src, 80, 80, true, true);
	
	if(!$thumbnail_url) {
		$thumbnail_url = $thumbnail_src;
	}
}

?>
<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	<div class="product_thumbnail"><img src="<?php echo esc_url($thumbnail_url); ?>" alt="" /></div>
	<div class="product_summary">
		<a href="<?php the_permalink() ?>" title="<?php echo esc_attr($product->get_title()); ?>"><?php echo esc_html($product->get_title()); ?></a>
		<?php echo ( method_exists($product, 'get_price_html') ) ? $product->get_price_html() : '' ?>
		<?php if ( ! empty( $show_rating ) ) : ?>
			<?php 
				if(function_exists('wc_get_rating_html') && method_exists($product, 'get_average_rating')) {
					echo wc_get_rating_html( $product->get_average_rating() );
				} elseif(method_exists($product, 'get_rating_html')) {
					echo $product->get_rating_html();
				}
			?>
		<?php endif; ?>
	</div>
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>