<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*Single product title*/
$output .= '.type-product .summary .product_title,'
		. '.dfd-single-product-module .product_title.entry-title {'
				. 'font-family: '.$vars['single_product_title-font-family'].';'
				. 'font-size: '.$vars['single_product_title-font-size'].';'
				. 'font-style: '.$vars['single_product_title-font-style'].';'
				. 'font-weight: '.$vars['single_product_title-font-weight'].';'
				. 'text-transform: '.$vars['single_product_title-text-transform'].';'
				. 'line-height: '.$vars['single_product_title-line-height'].';'
				. 'letter-spacing: '.$vars['single_product_title-letter-spacing'].';'
				. 'color: '.$vars['single_product_title-color'].';'
			. '}';

/*Single product subtitle*/
$output .= 'h4.dfd-woocommerce-subtitle {'
				. 'font-family: '.$vars['single_product_subtitle-font-family'].';'
				. 'font-size: '.$vars['single_product_subtitle-font-size'].';'
				. 'font-style: '.$vars['single_product_subtitle-font-style'].';'
				. 'font-weight: '.$vars['single_product_subtitle-font-weight'].';'
				. 'text-transform: '.$vars['single_product_subtitle-text-transform'].';'
				. 'line-height: '.$vars['single_product_subtitle-line-height'].';'
				. 'letter-spacing: '.$vars['single_product_subtitle-letter-spacing'].';'
				. 'color: '.$vars['single_product_subtitle-color'].';'
			. '}';

/*Single product price*/
$output .= '.single-product .dfd-single-price-wrap .price,'
		. '.single-product .single_variation_wrap .single_variation .price,'
		. '.single-product .single_variation_wrap .single_variation .stock {'
				. 'font-family: '.$vars['single_product_price-font-family'].';'
				. 'font-size: '.$vars['single_product_price-font-size'].';'
				. 'font-style: '.$vars['single_product_price-font-style'].';'
				. 'font-weight: '.$vars['single_product_price-font-weight'].';'
				. 'text-transform: '.$vars['single_product_price-text-transform'].';'
				. 'line-height: '.$vars['single_product_price-line-height'].';'
				. 'letter-spacing: '.$vars['single_product_price-letter-spacing'].';'
				. 'color: '.$vars['single_product_price-color'].';'
			. '}';

/*Single product price del*/
$output .= '.single-product .dfd-single-price-wrap .price del {'
				. 'color: '.Dfd_Theme_Helpers::adjustBrightness($vars['single_product_price-color'], 50).';'
			. '}';

/*Loop product title*/
$output .= '.dfd-shop-loop-title,'
		. 'body.checkout #main-content .dfd-content-wrap .checkout.woocommerce-checkout h3,'
		. 'body.checkout #main-content .dfd-content-wrap .checkout.woocommerce-checkout .woocommerce-checkout-review-order-table thead th,'
		. 'body.checkout #main-content .dfd-content-wrap .checkout.woocommerce-checkout .woocommerce-checkout-review-order-table tbody td,'
		. 'body.checkout #main-content .dfd-content-wrap .checkout.woocommerce-checkout .woocommerce-checkout-review-order-table tfoot .cart-subtotal,'
		. 'body.checkout #main-content .dfd-content-wrap .checkout.woocommerce-checkout .woocommerce-checkout-review-order-table tfoot .cart-subtotal,'
		. 'body.checkout #main-content .dfd-content-wrap .checkout.woocommerce-checkout .woocommerce-checkout-review-order-table tfoot .shipping th,'
		. 'body.checkout #main-content .dfd-content-wrap .checkout.woocommerce-checkout .woocommerce-checkout-review-order-table tfoot .order-total,'
		. '.woocommerce-cart .woocommerce > form table.shop_table thead tr th,'
		. '.woocommerce-cart .woocommerce > form table.shop_table tbody tr td,'
		. '.woocommerce-cart .woocommerce .cart-collaterals h2,'
		. '.woocommerce-cart .woocommerce .cart-collaterals table.shop_table tbody tr th,'
		. '.woocommerce-cart .woocommerce .cart-collaterals table.shop_table tbody tr td,'
		. 'body.woocommerce-cart .dfd-content-wrap table.shop_table td.actions .coupon label,'
		. 'body.woocommerce-cart .shipping-calculator-button,'
		. '#yith-wcwl-form .shop_table thead th,'
		. 'body.woocommerce-wishlist #yith-wcwl-form .shop_table tbody td,'
		. '.dfd-woo-empty-content p.cart-empty,'
		. 'body.woocommerce-order-received .woocommerce ul li,'
		. 'body.woocommerce-order-received .woocommerce h2,'
		. 'body.woocommerce-order-received .woocommerce h3,'
		. 'body.woocommerce-order-received p.woocommerce-thankyou-order-received,'
		. 'body.woocommerce-order-received .woocommerce .shop_table:not(.customer_details) tfoot tr:first-child th,'
		. 'body.woocommerce-order-received .woocommerce .shop_table:not(.customer_details) tfoot tr:last-child th,'
		. 'body.woocommerce-order-received .woocommerce .shop_table:not(.customer_details) thead th,'
		. 'body.woocommerce-order-received .woocommerce .shop_table:not(.customer_details) tbody tr th,'
		. 'body.woocommerce-order-received .woocommerce .shop_table:not(.customer_details) tbody tr td,'
		. 'body.woocommerce-order-received .woocommerce .shop_table:not(.customer_details) tfoot tr th,'
		. '.woocommerce-MyAccount-content .woocommerce-MyAccount-orders tbody tr td.order-number,'
		. '.woocommerce-MyAccount-content .woocommerce-MyAccount-orders tbody tr td.order-status,'
		. '.woocommerce-MyAccount-content .woocommerce-MyAccount-orders tbody tr td.order-total .amount,'
		. '.woocommerce-account form.woocommerce-EditAccountForm legend,'
		. '.woocommerce-view-order .woocommerce-MyAccount-content .order_details tfoot tr:first-child th,'
		. '.woocommerce-view-order .woocommerce-MyAccount-content .order_details tfoot tr:last-child th {'
				. 'font-family: '.$vars['loop_product_title-font-family'].';'
				. 'font-size: '.$vars['loop_product_title-font-size'].';'
				. 'font-style: '.$vars['loop_product_title-font-style'].';'
				. 'font-weight: '.$vars['loop_product_title-font-weight'].';'
				. 'text-transform: '.$vars['loop_product_title-text-transform'].';'
				. 'line-height: '.$vars['loop_product_title-line-height'].';'
				. 'letter-spacing: '.$vars['loop_product_title-letter-spacing'].';'
				. 'color: '.$vars['loop_product_title-color'].';'
			. '}';

/*Loop product price*/
$output .= '.products .product .woo-title-wrap .price {'
				. 'font-family: '.$vars['loop_product_price-font-family'].';'
				. 'font-size: '.$vars['loop_product_price-font-size'].';'
				. 'font-style: '.$vars['loop_product_price-font-style'].';'
				. 'font-weight: '.$vars['loop_product_price-font-weight'].';'
				. 'text-transform: '.$vars['loop_product_price-text-transform'].';'
				. 'line-height: '.$vars['loop_product_price-line-height'].';'
				. 'letter-spacing: '.$vars['loop_product_price-letter-spacing'].';'
				. 'color: '.$vars['loop_product_price-color'].';'
			. '}';

/*Loop product title*/
$output .= 'body.woocommerce-cart .dfd-content-wrap > .woocommerce .cart-collaterals table.shop_table tbody tr.shipping .shipping-calculator-button:hover,'
		. 'body.woocommerce-cart .dfd-content-wrap > .woocommerce > form table.shop_table tbody tr td.actions .coupon + .button:hover {'
				. 'color: '.$vars['main_site_color'].';'
			. '}';

/*Loop product title*/
$output .= '.single-product .woocommerce-tabs .tabs.wc-tabs > li.active,'
		. 'body.checkout #main-content .dfd-content-wrap > .woocommerce input[type="radio"]:after {'
				. 'background: '.$vars['main_site_color'].';'
			. '}';

/*Stars*/
$output .= '.woocommerce .star-rating span:before,'
		. '.woocommerce-page .star-rating span:before,'
		. '.woocommerce-page #reviews #review_form #respond .comment-form-rating p span a:after {'
				. 'color: '.$vars['woo_star_rating_color'].';'
			. '}';

/*Sale badge*/
if($vars['woo_products_sale_badge_position'] == 'right') {
	$output .= '.yith-wcwl-message, .onsale {'
					. 'left: auto;'
					. 'right: 15px;'
				. '}';
}

$output .= '.yith-wcwl-message, .onsale {'
				. 'background: '.$vars['woo_products_sale_badge_bg'].';'
				. 'border-radius: '.$vars['woo_products_sale_badge_border_radius'].'px;'
			. '}';