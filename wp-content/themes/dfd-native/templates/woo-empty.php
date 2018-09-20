<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

$empty_title = esc_html__('Your cart is currently empty.', 'dfd-native');
$icon_html = '<i class="dfd-socicon-icon-ios7-cart"></i>';

if (is_cart() != true) {
	$empty_title = esc_html__('Your wishlist is currently empty.', 'dfd-native');
	$icon_html = '<i class="dfd-socicon-icon-ios7-heart"></i>';
}

?>

<div class="dfd-woo-empty-content">
	<div class="dfd-cart-empty-content text-center">
		<div class="empty-content-wrap">
			<div class="icon-wrap left">
				<?php echo wp_kses($icon_html, array(
					'i' => array(
						'class' => array()
					)
				)); ?>
			</div>
			<div class="empty-title-content text-left">
				<p class="cart-empty">
					<?php //echo esc_html($empty_title); ?>
					<?php
					if (is_cart() == true) {
						do_action( 'woocommerce_cart_is_empty' );
					} else {
						echo esc_html($empty_title);
					}
					?>
				</p>
				<p class="subtitle">
					<?php esc_html_e('You may check out all the available products and buy some in the shop.', 'dfd-native'); ?>
				</p>
			</div>
		</div>


		<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<p class="return-to-shop">
				<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
					<?php esc_html_e( 'Return To Shop', 'dfd-native' ) ?>
				</a>
			</p>
		<?php endif; ?>
	</div>

	<div class="delimeter-empty text-center"><span class="dfd-widget-list-content"><?php esc_html_e('or', 'dfd-native') ?></span></div>

	<div class="dfd-top-rated-shortcodes twelve columns related products">
		<h3 class="dfd-shop-loop-title"><?php esc_html_e('Top Rated Products', 'dfd-native'); ?></h3>
		<?php echo do_shortcode('[top_rated_products per_page="4" columns="4"]') ?>
	</div>
</div>