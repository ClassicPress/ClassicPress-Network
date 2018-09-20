<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! $order = wc_get_order( $order_id ) ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();
$columns_classes = array('twelve', 'twelve');
if ( $show_downloads ) {
	wc_get_template( 'order/order-downloads.php', array( 'downloads' => $downloads, 'show_title' => true ) );
}
if($show_customer_details) {
	$columns_classes = array('six', 'six');
}
?>
<div class="row">
	<div class="<?php echo esc_attr($columns_classes[0]) ?> columns">
		<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>
		<h2><?php esc_html_e( 'Order Details', 'dfd-native' ); ?></h2>
		<table class="shop_table order_details">
			<thead>
				<tr>
					<th class="woocommerce-table__product-name product-name"><?php esc_html_e( 'Product', 'dfd-native' ); ?></th>
					<th class="woocommerce-table__product-table product-total"><?php esc_html_e( 'Total', 'dfd-native' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				do_action( 'woocommerce_order_details_before_order_table_items', $order );
				
				foreach ( $order->get_items() as $item_id => $item ) {
					$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

					wc_get_template( 'order/order-details-item.php', array(
						'order'			     => $order,
						'item_id'		     => $item_id,
						'item'			     => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'	     => $product ? $product->get_purchase_note() : '',
						'product'	         => $product,
					) );
				}
				
				do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
			<?php do_action( 'woocommerce_order_items_table', $order ); ?>
			</tbody>
			<tfoot>
				<?php
					foreach ( $order->get_order_item_totals() as $key => $total ) {
						?>
						<tr>
							<th scope="row"><?php echo $total['label']; ?></th>
							<td><?php echo $total['value']; ?></td>
						</tr>
						<?php
					}
				?>
				<?php if ( $order->get_customer_note() ) : ?>
					<tr>
						<th><?php _e( 'Note:', 'dfd-native' ); ?></th>
						<td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
					</tr>
				<?php endif; ?>
			</tfoot>
		</table>
	</div>
	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
	<div class="<?php echo esc_attr($columns_classes[1]) ?> columns">
		<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

		<?php 
		if ( $show_customer_details ) {
			wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
		}
		?>
	</div>
</div>

